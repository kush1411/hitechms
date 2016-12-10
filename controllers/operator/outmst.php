<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Outmst
 * ----For parts out
 * ----Important Function index,add,edit,delete,findbarcode
 * -----------------------------
 */

class Outmst extends My_operator {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'outmst';
        $this->load->model('outmst_m');
    }

    public function index() {
        $view = 'out/index';
        $this->metas['title'] = array('Operator | OutBound List');
        $this->data['allouts'] = $this->outmst_m->getAllOutBound();
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('operator', $view, $this->data);
    }

    public function add() {
        $view = 'out/add';
        $this->metas['title'] = array('Operator | OutBound | Add');
        $config = array(
            array('field' => 'refJobID', 'label' => 'refJobID', 'rules' => 'trim|required'),
            array('field' => 'EngineerName', 'label' => 'EngineerName', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'EngineerContact', 'label' => 'EngineerContact', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'EngineerPickupDate', 'label' => 'EngineerPickupDate', 'rules' => 'trim|required|xss_clean'),
        );
        $this->form_validation->set_rules($config);

        $this->data['job'] = $this->outmst_m->getJob();

        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCompID'] = $this->session->userdata(SITE_NAME . '_operator_data')['CompID'];
            $data['refJobID'] = $this->form_validation->set_value('refJobID');
            $data['EngineerName'] = $this->form_validation->set_value('EngineerName');
            $data['EngineerContact'] = $this->form_validation->set_value('EngineerContact');
            $old =  $this->form_validation->set_value('EngineerPickupDate');
            $new = explode('/', $old);
            $data['EngineerPickupDate'] =$new[2].'-'.$new[1].'-'.$new[0];
            $data['InsUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->outmst_m->insert($data)) {
                $this->_show_message('OutBound Is Created Successfully', 'success');
                redirect('operator/outmst');
            }
        } else {
            if ($this->input->post())
                $this->data['outmst'] = (object) $this->input->post();
        }
        $this->display_view('operator', $view, $data);
    }

    public function edit($OutID = '') {
        if (!$OutID)
            show_404();

        $view = 'out/edit';
        $this->metas['title'] = array('Operator | OutBound | Edit');
        $config = array(
            array('field' => 'EngineerName', 'label' => 'EngineerName', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'EngineerContact', 'label' => 'EngineerContact', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'EngineerPickupDate', 'label' => 'EngineerPickupDate', 'rules' => 'trim|required|xss_clean'),
        );
        $this->form_validation->set_rules($config);

        $this->data['outmst'] = $this->outmst_m->getOutBoundByID($OutID);

        $this->data['job'] = $this->outmst_m->getJob();

        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['EngineerName'] = $this->form_validation->set_value('EngineerName');
            $data['EngineerContact'] = $this->form_validation->set_value('EngineerContact');
            $old =  $this->form_validation->set_value('EngineerPickupDate');
            $new = explode('/', $old);
            $data['EngineerPickupDate'] =$new[2].'-'.$new[1].'-'.$new[0];
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->outmst_m->update($data, $OutID)) {
                $this->_show_message('OutBound Is Edited Successfully', 'success');
                redirect('operator/outmst');
            }
        } else {
            if ($this->input->post())
                $this->data['outmst'] = (object) $this->input->post();
        }
        $this->display_view('operator', $view, $data);
    }

    function delete($OutID = '') {
        if (!$OutID)
            show_404();

        if ($this->outmst_m->delete($OutID)) {
            $this->_show_message("OutBound deleted", 'success');
        }
        redirect('operator/outmst');
    }

    function findbarcode() {
        $barc = $this->input->get('barc');
        if ($barc != '') {
            $parts = $this->outmst_m->getDataBySrNo($barc);
            if (!empty($parts)) {
                $data = $this->outmst_m->getDetailDataBySrNo($barc);
                $data->JobID = $parts->JobID;
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
