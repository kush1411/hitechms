<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Inmst
 * ----For Parts In
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Inmst extends My_operator {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'inmst';
        $this->load->model('inmst_m');
    }

    public function index() {
        $view = 'in/index';
        $this->metas['title'] = array('Operator | InBound List');
        $this->data['allins'] = $this->inmst_m->getAllInBound();
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('operator', $view, $this->data);
    }

    public function add() {
        $view = 'in/add';
        $this->metas['title'] = array('Operator | InBound | Add');
        $config = array(
            array('field' => 'refJobID', 'label' => 'refJobID', 'rules' => 'trim|required'),
            array('field' => 'refOutID', 'label' => 'refOutID', 'rules' => 'trim|required'),
            array('field' => 'EngineerName', 'label' => 'EngineerName', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'EngineerContact', 'label' => 'EngineerContact', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'EngineerDropTime', 'label' => 'EngineerDropTime', 'rules' => 'trim|required|xss_clean'),
        );
        $this->form_validation->set_rules($config);

        $this->data['job'] = $this->inmst_m->getJob();

        $data = array();
        if ($this->form_validation->run()) {
//            echo '<pre>';
//            print_r($this->input->post()); print_r($_FILES);
//            die;
            $data = array();
            $data['refCompID'] = $this->session->userdata(SITE_NAME . '_operator_data')['CompID'];
            $data['refJobID'] = $this->form_validation->set_value('refJobID');
            $data['refOutID'] = $this->form_validation->set_value('refOutID');
            $data['EngineerName'] = $this->form_validation->set_value('EngineerName');
            $data['EngineerContact'] = $this->form_validation->set_value('EngineerContact');
            $old = $this->form_validation->set_value('EngineerDropTime');
            $new = explode('/', $old);
            $data['EngineerDropTime'] = $new[2] . '-' . $new[1] . '-' . $new[0];
            $data['InsUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            $data['Status'] = 'Done';
            $product = array();
            $account = array();
            if ($this->inmst_m->checkWarranty($data['refJobID'])) {
                $data['Status'] = $this->input->post('Status');
                if ($data['Status'] == 'Done') {
                    $old = $this->input->post('WarrantyFrom');
                    $new = explode('/', $old);
                    $product['WarrantyFrom'] = $new[2] . '-' . $new[1] . '-' . $new[0];

                    $old = $this->input->post('WarrantyTo');
                    $new = explode('/', $old);
                    $product['WarrantyTo'] = $new[2] . '-' . $new[1] . '-' . $new[0];
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
                                redirect('operator/inmst/add/');
                            }
                        }
                    } catch (Exception $e) {
                        $this->_show_message('Something Went Wrong, Try Again', 'error');
                        redirect('operator/inmst/add/');
                    }
                    $account['refCompID'] = $this->session->userdata(SITE_NAME . '_operator_data')['CompID'];
                    $account['refJobID'] = $data['refJobID'];
                    $account['Amount'] = $this->inmst_m->quotationAmt($data['refJobID']);
                    $account['Status'] = 'Pending';
                    $account['InsUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
                    $account['InsDateTime'] = date("Y:m:d H:i:s");
                    $account['InsTerminal'] = $this->input->ip_address();
                    $account['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
                    $account['UpdDateTime'] = date("Y:m:d H:i:s");
                    $account['UpdTerminal'] = $this->input->ip_address();
                }
            }
            if ($this->inmst_m->insert($data, $product, $account)) {
                $this->_show_message('InBound Is Created Successfully', 'success');
                redirect('operator/inmst');
            } else {
                $this->_show_message('InBound Is Not Created, Try Again', 'error');
                redirect('operator/inmst');
            }
        } else {
            if ($this->input->post())
                $this->data['inmst'] = (object) $this->input->post();
        }
        $this->display_view('operator', $view, $data);
    }

    public function edit($InID = '') {
        if (!$InID)
            show_404();

        $view = 'in/edit';
        $this->metas['title'] = array('Operator | InBound | Add');
        $config = array(
            array('field' => 'EngineerName', 'label' => 'EngineerName', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'EngineerContact', 'label' => 'EngineerContact', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'EngineerDropTime', 'label' => 'EngineerDropTime', 'rules' => 'trim|required|xss_clean'),
        );
        $this->form_validation->set_rules($config);

        $this->data['inmst'] = $this->inmst_m->getInBoundByID($InID);

        $this->data['job'] = $this->inmst_m->getJob();

        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['EngineerName'] = $this->form_validation->set_value('EngineerName');
            $data['EngineerContact'] = $this->form_validation->set_value('EngineerContact');
            $old = $this->form_validation->set_value('EngineerDropTime');
            $new = explode('/', $old);
            $data['EngineerDropTime'] = $new[2] . '-' . $new[1] . '-' . $new[0];
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->inmst_m->update($data, $InID)) {
                $this->_show_message('InBound Is Edited Successfully', 'success');
                redirect('operator/inmst');
            }
        } else {
            if ($this->input->post())
                $this->data['inmst'] = (object) $this->input->post();
        }
        $this->display_view('operator', $view, $data);
    }

    function delete($InID = '') {
        if (!$InID)
            show_404();

        if ($this->inmst_m->delete($InID)) {
            $this->_show_message("InBound deleted", 'success');
        }
        redirect('operator/inmst');
    }

    function findbarcode() {
        $barc = $this->input->get('barc');
        if ($barc != '') {
            $parts = $this->inmst_m->getDataBySrNo($barc);
            if (!empty($parts)) {
                $data = $this->inmst_m->getDetailDataBySrNo($barc);
                $data->JobID = $parts->JobID;
                $data->OutID = $parts->OutID;
                $data->IsWarranty = $parts->IsWarranty;
                if ($data->SubPartName == NULL) {
                    $data->ProductName = $data->PartName;
                } else {
                    $data->ProductName = $data->SubPartName;
                }

                $response['res'] = 'success';
                $response['msg'] = $data;
            } else {
                $response['res'] = 'error';
                $response['msg'] = 'Invalid Barcode OR Job Not Created';
            }
        } else {
            $response['res'] = 'error';
            $response['msg'] = 'Wrong Method';
        }
        echo json_encode($response);
        die;
    }

}
