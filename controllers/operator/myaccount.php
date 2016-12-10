<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Myaccount extends My_operator {

    function __construct() {
        parent::__construct();
        $this->_api_require_user();
        $this->load->model('employeemst');
    }

    public function index() {
        $view = 'myaccount/myaccount';
        $seesiondata = $this->session->userdata(SITE_NAME . '_operator_data');
        $user_id = $seesiondata['operator_id'];
        $this->data['employee'] = $this->employeemst->getEmployeeByID($user_id);
        $this->display_view('operator', $view, $this->data);
    }

    function edit($user_id = "") {
        if ($this->session->userdata(SITE_NAME . '_operator_data')) {
            $user_id = $this->session->userdata[SITE_NAME . '_operator_data']['operator_id'];

            $this->data['employee'] = $this->employeemst->getEmployeeByID($user_id);

            $config = array(
                array('field' => 'EmpName', 'label' => 'EmpName', 'rules' => 'trim|required|trim|xss_clean'),
                array('field' => 'EmpShift', 'label' => 'EmpShift', 'rules' => 'required|xss_clean|strip_tags'),
                array('field' => 'EmpAddr1', 'label' => 'EmpAddr1', 'rules' => 'trim|required|xss_clean|strip_tags'),
                array('field' => 'EmpAddr2', 'label' => 'EmpAddr2', 'rules' => 'trim|xss_clean|strip_tags'),
                array('field' => 'EmpCity', 'label' => 'EmpCity', 'rules' => 'trim|required|xss_clean|strip_tags'),
                array('field' => 'EmpState', 'label' => 'EmpState', 'rules' => 'trim|required|xss_clean|strip_tags'),
                array('field' => 'EmpCountry', 'label' => 'EmpCountry', 'rules' => 'trim|required|xss_clean|strip_tags'),
                array('field' => 'EmpPincode', 'label' => 'EmpPincode', 'rules' => 'trim|required|xss_clean|strip_tags'),
                array('field' => 'EmpContact1', 'label' => 'EmpContact1', 'rules' => 'trim|required|xss_clean|strip_tags'),
                array('field' => 'EmpContact2', 'label' => 'EmpContact2', 'rules' => 'trim|xss_clean|strip_tags'),
                array('field' => 'EmpSalary', 'label' => 'EmpSalary', 'rules' => 'trim|xss_clean|strip_tags'),
                array('field' => 'EmpJoinDat', 'label' => 'EmpJoinDat', 'rules' => 'trim|xss_clean|strip_tags|required'),
                array('field' => 'EmpLeftOn', 'label' => 'EmpLeftOn', 'rules' => 'trim|xss_clean|strip_tags'),
                array('field' => 'EmpRemarks', 'label' => 'EmpRemarks', 'rules' => 'trim|xss_clean|strip_tags')
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $data = array();
                $data['EmpName'] = $this->form_validation->set_value('EmpName');
                $data['EmpAddr1'] = $this->form_validation->set_value('EmpAddr1');
                $data['EmpAddr2'] = $this->form_validation->set_value('EmpAddr2');
                $data['EmpCity'] = $this->form_validation->set_value('EmpCity');
                $data['EmpState'] = $this->form_validation->set_value('EmpState');
                $data['EmpCountry'] = $this->form_validation->set_value('EmpCountry');
                $data['EmpPincode'] = $this->form_validation->set_value('EmpPincode');
                $data['EmpContact1'] = $this->form_validation->set_value('EmpContact1');
                $data['EmpContact2'] = $this->form_validation->set_value('EmpContact2');
                $data['EmpShift'] = $this->form_validation->set_value('EmpShift');
                $data['EmpSalary'] = $this->form_validation->set_value('EmpSalary');
                $dt = $this->form_validation->set_value('EmpJoinDat');
                $jdt = NULL;
                if ($dt != '') {
                    $dt = explode('/', $dt);
                    $jdt = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
                }
                $data['EmpJoinDat'] = $jdt;
                $dt = $this->form_validation->set_value('EmpLeftOn');
                $jdt = NULL;
                if ($dt != '') {
                    $dt = explode('/', $dt);
                    $jdt = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
                }
                $data['EmpLeftOn'] = $jdt;
                $data['EmpRemarks'] = $this->form_validation->set_value('EmpRemarks');
                $data['UpdDateTime'] = date('Y-m-d H:i:s');
                $data['UpdTerminal'] = $this->input->ip_address();
                if ($this->employeemst->update($data, $user_id)) {
                    $this->_show_message('Profile is edited successfully', 'success');
                    redirect('/operator/dashboard');
                }
            } else {
                if ($this->input->post()) {
                    $this->data['employee'] = (object) $this->input->post();
                    $this->_show_message('Error while Editing', 'error');
                }
            }
            $view = "myaccount/myaccount";
            $this->display_view("operator", $view, $this->data);
        } else {
            redirect('/operator');
        }
    }

}

?>
