<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Purchasejob
 * ----For Purchasejob Purchase
 * ----Important Function index,add,edit,delete,findbarcode
 * -----------------------------
 */

class Purchasejob extends My_operator {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'purchasejob';
        $this->load->model('purchasejob_m');
    }

    public function index() {
        //echo base_url('quotation/' . $this->encryptionk->encodeData(1) . '/' . $this->encryptionk->encodeData(2)); die;
        $view = 'purchasejob/index';
        $this->metas['title'] = array('Operator | Purchase Job List');
        $this->data['allpurchasesjob'] = $this->purchasejob_m->getAllPurchaseJob();
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('operator', $view, $this->data);
    }

    public function ajaxform() {
        $barc = $this->input->get('barc');
        if ($barc != '') {
            $parts = $this->purchasejob_m->getDataBySrNo($barc);
            if (!empty($parts)) {
                $chckmate = $this->purchasejob_m->checkDataBySrNo($barc);
                if ($chckmate > 0) {
                    $data['BarcodeNo'] = $barc;
                    $data['machineparts'] = $this->purchasejob_m->getDetailDataBySrNo($barc);
                    $data['part'] = $this->purchasejob_m->getPart($data['machineparts']->refMachID);
                    $data['subpart'] = $this->purchasejob_m->getSubPart($data['machineparts']->refMachPartID);
                    $data['mfg'] = $this->purchasejob_m->getMfgByPartsID($data['machineparts']->refMachPartID);
                    $data['JobID'] = $this->purchasejob_m->getJobIDBySrNo($barc);
//                    echo '<pre>'; print_r($data['mfg']); die;
                    if ($data['machineparts']->refMachSubPartID != '' || $data['machineparts']->refMachSubPartID != NULL) {
                        $data['mfg'] = $this->purchasejob_m->getMfgBySubPartsID($data['machineparts']->refMachSubPartID);
                    }
                    if ($data['machineparts']->SubPartName == NULL) {
                        $data['machineparts']->ProductName = $data['machineparts']->PartName;
                    } else {
                        $data['machineparts']->ProductName = $data['machineparts']->SubPartName;
                    }
                    $data['provider'] = $this->purchasejob_m->getProvider();
                    $view = 'purchasejob/ajaxform';
                    $response['res'] = 'success';
                    $response['msg'] = $this->load->view('operator/' . $view, $data, true);
                }
                else {
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
        $category = $this->purchasejob_m->checkserialparts($name, $MachPartID);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    public function add() {
        $view = 'purchasejob/add';
        $this->metas['title'] = array('Operator | Purchase Job | Add');
        $config = array(
            array('field' => 'refMfgID', 'label' => 'refMfgID', 'rules' => 'required')
        );
        $this->form_validation->set_rules($config);

        $this->data['provider'] = $this->purchasejob_m->getProvider();

        $data = array();
        $BarcodeNo = $this->input->post('BarcodeNo');
        if ($this->form_validation->run()) {
            $data['refCompID'] = $this->session->userdata(SITE_NAME . '_operator_data')['CompID'];
            $data['refJobID'] = $this->input->post('refJobID');
            $data['refMfgID'] = $this->input->post('refMfgID');
            $data['Status'] = 'Quotation Request Sent';
            $data['InsUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();

            if($POID = $this->purchasejob_m->insert($data)){
                $provider = $this->purchasejob_m->getProviderEmail($BarcodeNo);
				$email['subject'] = ' Need Quotation For New Purchase';
                $email['company'] = User::find('first', array('conditions' => array('id = ?', $this->session->userdata(SITE_NAME . '_operator_data')['CompID'])));
                $email['Product'] = $this->purchasejob_m->getDetailDataBySrNo($BarcodeNo);
                if ($email['Product']->SubPartName == NULL) {
                    $email['Product']->ProductName = $email['Product']->PartName;
                } else {
                    $email['Product']->ProductName = $email['Product']->SubPartName;
                }
                if (!empty($provider)) {
                    foreach ($provider as $key => $value) {
                        $email['link'] = base_url('pjquotation/' . $this->encryptionk->encodeData($POID) . '/' . $this->encryptionk->encodeData($value->SerProvID));
                        $email['Name'] = $value->Name;
                        $emailid = $value->Email;
                        $this->_send_email('require_quotation', $emailid, $email);
                    }
                }
                $this->_show_message('Purchase Job Is Created Successfully', 'success');
            }else{
                $this->_show_message('Purchase Job Is Not Created', 'error');
            }
            redirect('operator/purchasejob');
        }
        $this->display_view('operator', $view, $data);
    }

public function quotation($JobID = '') {
        if (!$JobID)
            show_404();

        $view = 'purchasejob/quotation';
        $this->metas['title'] = array('Operator | Purchase Job | Quotation');
        $data['quotationlist'] = $this->purchasejob_m->getQuotationByJobId($JobID);
        $data['job'] = $this->purchasejob_m->getJobByID($JobID);
        if ($this->input->post()) {
            $selectedProvider = $this->input->post('selectedProvider');
            $selprv = explode('__11__', $selectedProvider);
            $ins = array();
            $ins['refProviderID'] = $selprv[0];
            $ins['PurAmt'] = $selprv[1];
            $ins['Remarks'] = $this->input->post('Remarks');
            $ins['Status'] = 'Quotation Applied';
            try {
                if (isset($_FILES['file']['tmp_name'])) {
                    $uploaddir = './uploads/quotation/';
                    $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                    $file_name = md5(preg_replace('/[\s]+/', '_', strtolower(trim($_FILES['file']['name']))) . date('Ymdhis')) . '.' . $ext;
                    $uploadfile = $uploaddir . $file_name;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                        $ins['POFile'] = $file_name;
                    } else {
                        $this->_show_message('File Not Uploaded', 'error');
                        redirect('operator/purchasejob/quotation/' . $JobID);
                    }
                }
            } catch (Exception $e) {
                $this->_show_message('Something Went Wrong, Try Again', 'error');
                redirect('operator/purchasejob/quotation/' . $JobID);
            }
            if ($this->purchasejob_m->update($ins, $JobID)) {
                $this->_show_message('Quoation Applied Successfully', 'success');
                redirect('operator/purchasejob');
            } else {
                $this->_show_message('Quoation Not Applied, Try Again', 'error');
                redirect('operator/purchasejob/quotation/' . $JobID);
            }
        }
        $this->display_view('operator', $view, $data);
    }

    public function edit($JobID = '') {
        if (!$JobID)
            show_404();

        $view = 'purchasejob/edit';
        $this->metas['title'] = array('Operator | Purchase Job | Edit');
        $config = array(
            array('field' => 'refMfgID', 'label' => 'refMfgID', 'rules' => 'trim|required'),
            array('field' => 'BarcodeNo', 'label' => 'BarcodeNo', 'rules' => 'trim|required'),
            array('field' => 'refProviderID', 'label' => 'refProviderID', 'rules' => 'trim'),
            array('field' => 'Remarks', 'label' => 'Remarks', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'PurAmt', 'label' => 'PurAmt', 'rules' => 'trim|strip_tags'),
        );
        $this->form_validation->set_rules($config);

        $this->data['purchasemst'] = $this->purchasejob_m->getJobByID($JobID);
        $this->data['quotationlist'] = $this->purchasejob_m->getQuotationByJobId($JobID);
        $barc = $this->purchasejob_m->getBarcodeByJobID($JobID);
        $data['BarcodeNo'] = $barc;
        $data['machineparts'] = $this->purchasejob_m->getDetailDataBySrNo($barc);
        $data['part'] = $this->purchasejob_m->getPart($data['machineparts']->refMachID);
        $data['subpart'] = $this->purchasejob_m->getSubPart($data['machineparts']->refMachPartID);
        $data['mfg'] = $this->purchasejob_m->getMfgByPartsID($data['machineparts']->refMachPartID);
        $data['JobID'] = $this->data['purchasemst']->refJobID;
        if ($data['machineparts']->refMachSubPartID != '' || $data['machineparts']->refMachSubPartID == NULL) {
            $data['mfg'] = $this->purchasejob_m->getMfgBySubPartsID($data['machineparts']->refMachSubPartID);
        }
        if ($data['machineparts']->SubPartName == NULL) {
            $data['machineparts']->ProductName = $data['machineparts']->PartName;
        } else {
            $data['machineparts']->ProductName = $data['machineparts']->SubPartName;
        }
        $data['provider'] = $this->purchasejob_m->getProvider();

        if ($this->form_validation->run()) {
            $data = array();
            $data['refMfgID'] = $this->form_validation->set_value('refMfgID');
            $data['refProviderID'] = $this->form_validation->set_value('refProviderID');
            $data['Remarks'] = $this->form_validation->set_value('Remarks');
            $data['PurAmt'] = $this->form_validation->set_value('PurAmt');
            if($this->data['purchasemst']->Status == 'Quotation Request Sent' && $data['PurAmt'] > 0){
               $data['PurAmt'] = 'Job Pending' ;
            }
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();

            if ($this->purchasejob_m->update($data, $JobID)) {
                $this->_show_message('Purchase Job Is Edited Successfully', 'success');
                redirect('operator/purchasejob');
            }
        } else {
            if ($this->input->post())
                $this->data['purchasemst'] = (object) $this->input->post();
        }
        $this->display_view('operator', $view, $data);
    }
    
    public function addquot($jobid) {
        $view = 'purchasejob/addquot';
        $this->metas['title'] = array('Operator | Purchase Job | AddQuotation');

        if ($jobid > 0) {
            $this->data['provider'] = $this->purchasejob_m->getProvider();
            $data = array();
            if ($this->input->post()) {
                $data['refPOID'] = $jobid;
                $data['refSerProvID'] = $this->input->post('refProviderID');
                $data['quotation'] = $this->input->post('quotation');
                $data['remarks'] = $this->input->post('remarks');
                try {
                    if (isset($_FILES['file']['tmp_name'])) {
                        $uploaddir = './uploads/quotation/';
                        $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                        $file_name = md5(preg_replace('/[\s]+/', '_', strtolower(trim($_FILES['file']['name']))) . date('s')) . '.' . $ext;
                        $uploadfile = $uploaddir . $file_name;
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                            $data['filename'] = $file_name;
                        }
                    }
                } catch (Exception $e) {
                    
                }
                $data['InsDateTime'] = date('Y-m-d H:i:s');
                $data['InsTerminal'] = $this->input->ip_address();
                if ($this->purchasejob_m->insert_quotation($data)) {
                    $this->_show_message('Quotation Add Successfuly', 'success');
                    redirect('operator/purchasejob/quotation/'.$jobid);
                }
            }
            $this->display_view('operator', $view, $data);
        }else{
            show_404();
        }
    }

}
