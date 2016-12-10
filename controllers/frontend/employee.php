<?php

/*ALTER TABLE `empmst` ADD `IsQuot` TINYINT NOT NULL DEFAULT '0' AFTER `EmpStatus`;
 * -----------------------------
 * ----Author Kushal
 * ----Class Employee
 * ----For Machine Employee
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Employee extends My_front {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'employee';
        $this->load->model('employeemst');
    }

    /**
     * function index
     * @descp Used to list all frontend employee
     * @where view page datatable list in employees/view (view folder)
     * */
    public function index($EmpID = '') {
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'employee/view';
        $this->metas['title'] = array('Client | Employee List');
        $data['allemployee'] = $this->employeemst->getEmployee();
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('frontend', $view, $data);
    }

    public function add() {
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'employee/add';
        $this->metas['title'] = array('Client | Employee | Add');
        $config = array(
            array('field' => 'refDesgnID', 'label' => 'refDesgnID', 'rules' => 'required'),
            array('field' => 'refLocID', 'label' => 'refLocID', 'rules' => 'required'),
            array('field' => 'EmpCode', 'label' => 'EmpCode', 'rules' => 'trim|required|trim|xss_clean|is_unique[empmst.EmpCode]'),
            array('field' => 'EmpName', 'label' => 'EmpName', 'rules' => 'trim|required|trim|xss_clean'),
            array('field' => 'EmpStatus', 'label' => 'EmpStatus', 'rules' => 'required'),
            array('field' => 'EmpShift', 'label' => 'EmpShift', 'rules' => 'required|xss_clean|strip_tags'),
            array('field' => 'EmpAddr1', 'label' => 'EmpAddr1', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpAddr2', 'label' => 'EmpAddr2', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'EmpCity', 'label' => 'EmpCity', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpState', 'label' => 'EmpState', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpCountry', 'label' => 'EmpCountry', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpPincode', 'label' => 'EmpPincode', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpContact1', 'label' => 'EmpContact1', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpContact2', 'label' => 'EmpContact2', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'EmpEmail', 'label' => 'EmpEmail', 'rules' => 'trim|required|xss_clean|strip_tags|valid_email'),
            array('field' => 'EmpSalary', 'label' => 'EmpSalary', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'EmpJoinDat', 'label' => 'EmpJoinDat', 'rules' => 'trim|xss_clean|strip_tags|required'),
            array('field' => 'EmpLeftOn', 'label' => 'EmpLeftOn', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'EmpRemarks', 'label' => 'EmpRemarks', 'rules' => 'trim|xss_clean|strip_tags')
        );
        $this->form_validation->set_rules($config);
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $this->data['designation'] = $this->employeemst->getDesignation();
        $this->data['location'] = $this->employeemst->getLocation();
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCompID'] = $user_id;
            $data['refDesgnID'] = $this->form_validation->set_value('refDesgnID');
            $data['refLocID'] = $this->form_validation->set_value('refLocID');
            $data['EmpCode'] = $this->form_validation->set_value('EmpCode');
            $data['EmpName'] = $this->form_validation->set_value('EmpName');
            $data['EmpAddr1'] = $this->form_validation->set_value('EmpAddr1');
            $data['EmpAddr2'] = $this->form_validation->set_value('EmpAddr2');
            $data['EmpCity'] = $this->form_validation->set_value('EmpCity');
            $data['EmpState'] = $this->form_validation->set_value('EmpState');
            $data['EmpCountry'] = $this->form_validation->set_value('EmpCountry');
            $data['EmpPincode'] = $this->form_validation->set_value('EmpPincode');
            $data['EmpContact1'] = $this->form_validation->set_value('EmpContact1');
            $data['EmpContact2'] = $this->form_validation->set_value('EmpContact2');
            $data['EmpEmail'] = $this->form_validation->set_value('EmpEmail');
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
            $data['EmpStatus'] = $this->form_validation->set_value('EmpStatus');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->employeemst->insert($data)) {
                $this->_show_message('Employee is added successfully', 'success');
                redirect('employee');
            }
        } else {
            if ($this->input->post())
                $this->data['employee'] = (object) $this->input->post();
        }
        $this->display_view('frontend', $view, $data);
    }

    function edit($EmpID = '') {
        if (!$EmpID)
            show_404();
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'employee/add';
        $this->metas['title'] = array('Client | Employee | Edit');
        $this->data['employee'] = $this->employeemst->getEmployeeByID($EmpID);
        $this->data['designation'] = $this->employeemst->getDesignation();
        $this->data['location'] = $this->employeemst->getLocation();

        if ($this->input->post('EmpCode') != $this->data['employee']->EmpCode) {
            $is_unique1 = '|is_unique[empmst.EmpCode]';
        } else {
            $is_unique1 = '';
        }
        $config = array(
            array('field' => 'refDesgnID', 'label' => 'refDesgnID', 'rules' => 'required'),
            array('field' => 'refLocID', 'label' => 'refLocID', 'rules' => 'required'),
            array('field' => 'EmpCode', 'label' => 'EmpCode', 'rules' => 'trim|required|trim|xss_clean|' . $is_unique1),
            array('field' => 'EmpName', 'label' => 'EmpName', 'rules' => 'trim|required|trim|xss_clean'),
            array('field' => 'EmpStatus', 'label' => 'EmpStatus', 'rules' => 'required'),
            array('field' => 'EmpShift', 'label' => 'EmpShift', 'rules' => 'required|xss_clean|strip_tags'),
            array('field' => 'EmpAddr1', 'label' => 'EmpAddr1', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpAddr2', 'label' => 'EmpAddr2', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'EmpCity', 'label' => 'EmpCity', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpState', 'label' => 'EmpState', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpCountry', 'label' => 'EmpCountry', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpPincode', 'label' => 'EmpPincode', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpContact1', 'label' => 'EmpContact1', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'EmpContact2', 'label' => 'EmpContact2', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'EmpEmail', 'label' => 'EmpEmail', 'rules' => 'trim|required|xss_clean|strip_tags|valid_email'),
            array('field' => 'EmpSalary', 'label' => 'EmpSalary', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'EmpJoinDat', 'label' => 'EmpJoinDat', 'rules' => 'trim|xss_clean|strip_tags|required'),
            array('field' => 'EmpLeftOn', 'label' => 'EmpLeftOn', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'EmpRemarks', 'label' => 'EmpRemarks', 'rules' => 'trim|xss_clean|strip_tags')
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $data = array();
            $data['refDesgnID'] = $this->form_validation->set_value('refDesgnID');
            $data['refLocID'] = $this->form_validation->set_value('refLocID');
            $data['EmpCode'] = $this->form_validation->set_value('EmpCode');
            $data['EmpName'] = $this->form_validation->set_value('EmpName');
            $data['EmpAddr1'] = $this->form_validation->set_value('EmpAddr1');
            $data['EmpAddr2'] = $this->form_validation->set_value('EmpAddr2');
            $data['EmpCity'] = $this->form_validation->set_value('EmpCity');
            $data['EmpState'] = $this->form_validation->set_value('EmpState');
            $data['EmpCountry'] = $this->form_validation->set_value('EmpCountry');
            $data['EmpPincode'] = $this->form_validation->set_value('EmpPincode');
            $data['EmpContact1'] = $this->form_validation->set_value('EmpContact1');
            $data['EmpContact2'] = $this->form_validation->set_value('EmpContact2');
            $data['EmpEmail'] = $this->form_validation->set_value('EmpEmail');
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
            $data['EmpStatus'] = $this->form_validation->set_value('EmpStatus');
            $data['UpdDateTime'] = date('Y-m-d H:i:s');
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->employeemst->update($data, $EmpID)) {
                $this->_show_message('Employee is edited successfully', 'success');
                redirect('employee');
            }
        } else {
            if ($this->input->post()) {
                $this->data['employee'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('frontend', $view, $this->data);
    }

    function delete($EmpID = '') {
        if ($this->input->post('option')) {
            $EmpIDs = $this->input->post('option');
            if ($this->employeemst->deleteAll($EmpIDs)) {
                $this->_show_message("Employee deleted", 'success');
            }
        } else {
            if (!$EmpID)
                show_404();
            if ($this->employeemst->delete($EmpID)) {
                $this->_show_message("Employee deleted", 'success');
            }
        }
        redirect('employee');
    }

    function activate($EmpID = '') {
        if (!$EmpID)
            show_404();
        $editActivation = array();
        $editActivation['EmpStatus'] = '1';
        if ($this->employeemst->update($editActivation, $EmpID)) {
            $this->_show_message("Employee activated successfully", 'success');
            redirect('employee');
        }
    }

    function deactivate($EmpID = '') {
        if (!$EmpID)
            show_404();
        $editActivation = array();
        $editActivation['EmpStatus'] = '0';
        if ($this->employeemst->update($editActivation, $EmpID)) {
            $this->_show_message("Employee deactivated successfully", 'success');
            redirect('employee');
        }
    }

    function check($EmpID = '') {
        $name = $this->input->get('EmpCode');
        $category = $this->employeemst->check($name, $EmpID);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkfirst() {
        $name = $this->input->get('EmpCode');
        $category = $this->employeemst->check($name, '');
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkemail($EmpID = '') {
        $name = $this->input->get('EmpEmail');
        $category = $this->employeemst->checkemail($name, $EmpID);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkemailfirst() {
        $name = $this->input->get('EmpEmail');
        $category = $this->employeemst->checkemail($name, '');
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function login($EmpID) {
        if (!$EmpID)
            show_404();
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'employee/login';
        $this->metas['title'] = array('Client | Employee | Login');
        $this->data['employee'] = $this->employeemst->getEmployeeByID($EmpID);
        if ($this->input->post()) {
            $email = $data = array();
            $email['UserName'] = $data['EmpEmail'] = $this->input->post('EmpEmail');
            $email['UserPass'] = $password = $this->input->post('EmpPassword');
            $email['OrgCode'] = $this->data['CompDetails']->code;
            $email['subject'] = ' - YOUR SIGN IN DETAILS';
            if ($password != '') {
                $data['EmpPassword'] = md5($password);
            }
            $data['IsQuot'] = $this->input->post('IsQuot');
            if ($this->employeemst->update($data, $EmpID)) {
                if($password != '') {
                    $this->_send_email('reset_password', $email['UserName'], $email);
                }
                $this->_show_message('Employee Password edited successfully', 'success');
                redirect('employee');
            }
        }
        $this->display_view('frontend', $view, $this->data);
    }

    function getrandom() {
        $randomPassword = generate_random_string(6);
        echo json_encode(array('result' => 'success', 'rand' => $randomPassword));
        die;
    }

}
