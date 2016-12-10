<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Purchasemst
 * ----For Purchasemst Purchase
 * ----Important Function index,add,edit,delete,findbarcode
 * -----------------------------
 */

class Purchasemst extends My_operator {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'purchasemst';
        $this->load->model('purchasemst_m');
    }

    public function index() {
        //echo base_url('quotation/' . $this->encryptionk->encodeData(1) . '/' . $this->encryptionk->encodeData(2)); die;
        $view = 'purchase/index';
        $this->metas['title'] = array('Operator | Purchase List');
        $this->data['allpurchases'] = $this->purchasemst_m->getAllPurchase();
        //print_r($this->data['allpurchases']); die;
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('operator', $view, $this->data);
    }

    public function ajaxform() {
        $barc = $this->input->get('barc');
        if ($barc != '') {
            $parts = $this->purchasemst_m->getDataBySrNo($barc);
            if (!empty($parts)) {
                $chckmate = $this->purchasemst_m->checkDataBySrNo($barc);
                if ($chckmate > 0) {
                    $data['BarcodeNo'] = $barc;
                    $data['machineparts'] = $this->purchasemst_m->getDetailDataBySrNo($barc);
                    $data['part'] = $this->purchasemst_m->getPart($data['machineparts']->refMachID);
                    $data['subpart'] = $this->purchasemst_m->getSubPart($data['machineparts']->refMachPartID);
                    $data['mfg'] = $this->purchasemst_m->getMfgByPartsID($data['machineparts']->refMachPartID);
                    $data['JobID'] = $parts->refJobID;
                    $data['purchasemst'] = $parts;
                    if ($data['machineparts']->refMachSubPartID != '' || $data['machineparts']->refMachSubPartID != NULL) {
                        $data['mfg'] = $this->purchasemst_m->getMfgBySubPartsID($data['machineparts']->refMachSubPartID);
                    }
                    if ($data['machineparts']->SubPartName == NULL) {
                        $data['machineparts']->ProductName = $data['machineparts']->PartName;
                    } else {
                        $data['machineparts']->ProductName = $data['machineparts']->SubPartName;
                    }
                    $data['provider'] = $this->purchasemst_m->getProvider();
                    $view = 'purchase/ajaxform';
                    $response['res'] = 'success';
                    $response['msg'] = $this->load->view('operator/' . $view, $data, true);
                } else {
                    $response['res'] = 'alert';
                    $response['msg'] = 'Part Already In Service';
                }
            } else {
                $response['res'] = 'error';
                $response['msg'] = 'Invalid Barcode';
            }
        } else {
            $response['res'] = 'error';
            $response['msg'] = 'Wrong Method';
        }
        echo json_encode($response);
        die;
    }

    function checkserialparts($MachPartID = '') {
        $name = $this->input->get('SerialNo');
        $category = $this->purchasemst_m->checkserialparts($name, $MachPartID);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    public function add() {
        $view = 'purchase/add';
        $this->metas['title'] = array('Operator | Purchase | Add');
        $config = array(
            array('field' => 'refMachPartID', 'label' => 'refMachPartID', 'rules' => 'required'),
            array('field' => 'refMachSubPartID', 'label' => 'refMachSubPartID', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'SerialNo', 'label' => 'SerialNo', 'rules' => 'required|is_unique[cmpmachpartmst.SerialNo]'),
            array('field' => 'refMfgID', 'label' => 'refMfgID', 'rules' => 'required'),
            array('field' => 'Remarks', 'label' => 'Remarks', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'refProviderID', 'label' => 'refProviderID', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);

        $product = $data = array();

        if ($this->form_validation->run()) {
            $data['refCompID'] = $this->session->userdata(SITE_NAME . '_operator_data')['CompID'];
            $data['refJobID'] = $this->input->post('refJobID');
            $data['refPOID'] = $this->input->post('refPOID');
            $data['refProviderID'] = $this->form_validation->set_value('refProviderID');
            $data['PurAmt']= $this->input->post('PurAmt');
            $data['Status'] = 'Purchase';
            $data['InsUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();

            $product['refCompID'] = $this->session->userdata(SITE_NAME . '_operator_data')['CompID'];
            $product['refMachID'] = $this->input->post('refMachID');
            $product['refMachPartID'] = $this->form_validation->set_value('refMachPartID');
            $product['refMachSubPartID'] = $this->form_validation->set_value('refMachSubPartID');
            $product['refMfgID'] = $this->form_validation->set_value('refMfgID');
            $product['SerialNo'] = $this->form_validation->set_value('SerialNo');
            $product['Remarks'] = $this->form_validation->set_value('Remarks');
            $b_data = $this->_get_auto_id();
            $product['autoserialno'] = $b_data['barcode'];
            if ($this->input->post('WarrantyFrom') != '' && $this->input->post('WarrantyTo') != '') {
                $old = $this->input->post('WarrantyFrom');
                $new = explode('/', $old);
                $product['WarrantyFrom'] = $new[2] . '-' . $new[1] . '-' . $new[0];

                $old = $this->input->post('WarrantyTo');
                $new = explode('/', $old);
                $product['WarrantyTo'] = $new[2] . '-' . $new[1] . '-' . $new[0];
            }
            $product['InsDateTime'] = date("Y:m:d H:i:s");
            $product['InsTerminal'] = $this->input->ip_address();
            $product['UpdDateTime'] = date("Y:m:d H:i:s");
            $product['UpdTerminal'] = $this->input->ip_address();

            $account['InvoiceNo'] = $this->input->post('InvoiceNo');
            try {
                if (isset($_FILES['file']['tmp_name'])) {
                    $uploaddir = './uploads/account/';
                    $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                    $file_name = md5(preg_replace('/[\s]+/', '_', strtolower(trim($_FILES['file']['name']))) . date('Ymdhis')) . '.' . $ext;
                    $uploadfile = $uploaddir . $file_name;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                        $account['InvoiceImage'] = $file_name;
                    } else {
                        $this->_show_message('File Not Uploaded', 'error');
                        redirect('operator/purchasemst/add/');
                    }
                }
            } catch (Exception $e) {
                $this->_show_message('Something Went Wrong, Try Again', 'error');
                redirect('operator/purchasemst/add/');
            }
            $account['refCompID'] = $this->session->userdata(SITE_NAME . '_operator_data')['CompID'];
            $account['refJobID'] = $data['refJobID'];
            $account['refPurchaseID'] = 0;
            $account['Amount'] =$data['PurAmt'];
            $account['Status'] = 'Pending';
            $account['InsUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $account['InsDateTime'] = date("Y:m:d H:i:s");
            $account['InsTerminal'] = $this->input->ip_address();
            $account['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $account['UpdDateTime'] = date("Y:m:d H:i:s");
            $account['UpdTerminal'] = $this->input->ip_address();
                    
            if ($refCmpMachPartID = $this->purchasemst_m->insert_part($product)) {
                $data['refCmpMachPartID'] = $refCmpMachPartID;
                if ($this->purchasemst_m->insert($data,$account)) {
                    $this->_show_message('Purchase Is Created Successfully', 'success');
                } else {
                    $this->_show_message('Purchase Is Not Created', 'error');
                }
                redirect('operator/purchasemst');
            } else {
                $this->_show_message('Something Went Wrong, Try Again', 'error');
                redirect('operator/purchasemst/add');
            }
        }
        $this->display_view('operator', $view, $data);
    }

//    public function edit($PurchaseID = '') {
//        if (!$PurchaseID)
//            show_404();
//
//        $view = 'purchase/edit';
//        $this->metas['title'] = array('Operator | Purchase | Add');
//        $config = array(
//            array('field' => 'refMachID', 'label' => 'refMachID', 'rules' => 'trim|required'),
//            array('field' => 'BarcodeNo', 'label' => 'BarcodeNo', 'rules' => 'trim|required'),
//            array('field' => 'refProviderID', 'label' => 'refProviderID', 'rules' => 'trim'),
//            array('field' => 'refEmpID', 'label' => 'refEmpID', 'rules' => 'trim|required|xss_clean'),
//            array('field' => 'Issue', 'label' => 'Issue', 'rules' => 'trim|required|xss_clean|strip_tags'),
//            array('field' => 'Remarks', 'label' => 'Remarks', 'rules' => 'trim|xss_clean|strip_tags'),
//            array('field' => 'QuotAmt', 'label' => 'QuotAmt', 'rules' => 'trim|xss_clean|strip_tags'),
//        );
//        $this->form_validation->set_rules($config);
//
//        $this->data['purchasemst'] = $this->purchasemst_m->getPurchaseByID($PurchaseID);
//        $this->data['quotationlist'] = $this->purchasemst_m->getQuotationByPurchaseId($PurchaseID);
////        $this->data['machine'] = $this->purchasemst_m->getPurchasemst();
//        $this->data['provider'] = $this->purchasemst_m->getProvider();
//        $this->data['employee'] = $this->purchasemst_m->getEmployee();
//
//        $data = array();
//        if ($this->form_validation->run()) {
//            $data = array();
//            $data['refEmpID'] = $this->form_validation->set_value('refEmpID');
//            $data['refProviderID'] = $this->form_validation->set_value('refProviderID');
//            $data['Issue'] = $this->form_validation->set_value('Issue');
//            $data['Remarks'] = $this->form_validation->set_value('Remarks');
//            $data['QuotAmt'] = $this->form_validation->set_value('QuotAmt');
//            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
//            $data['UpdDateTime'] = date("Y:m:d H:i:s");
//            $data['UpdTerminal'] = $this->input->ip_address();
////            if($this->data['purchasemst']->Status == 'Quotation Applied'){
////                
////            }else if($this->data['purchasemst']->Status == 'Quotation Request Sent'){
////                $data['Status'] = '';
////            }else if($this->data['purchasemst']->Status == 'Pending'){
////                
////            }
//            if ($this->purchasemst_m->update($data, $PurchaseID)) {
//                $this->_show_message('Purchase Is Edited Successfully', 'success');
//                redirect('operator/purchasemst');
//            }
//        } else {
//            if ($this->input->post())
//                $this->data['purchasemst'] = (object) $this->input->post();
//        }
//        $this->display_view('operator', $view, $data);
//    }
}
