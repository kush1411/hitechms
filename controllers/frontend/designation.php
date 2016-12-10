<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Designation
 * ----For Machine Designation
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Designation extends My_front {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'designation';
        $this->load->model('designationmst');
    }

    /**
     * function index
     * @descp Used to list all frontend designation
     * @where view page datatable list in designations/view (view folder)
     * */
    public function index($DesignID = '') {
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'designation/view';
        $this->metas['title'] = array('Client | Designation List');
        $data['alldesignation'] = $this->designationmst->getDesignation();
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
        $view = 'designation/add';
        $this->metas['title'] = array('Client | Designation | Add');
        $config = array(
            array('field' => 'Name', 'label' => 'Name', 'rules' => 'required|is_unique[designmst.Name]'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCompID'] = $user_id;
            $data['Name'] = $this->form_validation->set_value('Name');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->designationmst->insert($data)) {
                $this->_show_message('Designation is added successfully', 'success');
                redirect('designation');
            }
        } else {
            if ($this->input->post())
                $this->data['designation'] = (object) $this->input->post();
        }
        $this->display_view('frontend', $view, $data);
    }

    function edit($DesignID = '') {
        if (!$DesignID)
            show_404();
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'designation/add';
        $this->metas['title'] = array('Client | Designation | Edit');
        $this->data['designation'] = $this->designationmst->getDesignationByID($DesignID);
        if ($this->input->post('Name') != $this->data['designation']->Name) {
            $is_unique = '|is_unique[designmst.Name]';
        } else {
            $is_unique = '';
        }
        $config = array(
            array('field' => 'Name', 'label' => 'Name', 'rules' => 'required' . $is_unique),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $editgroup = array();
            $editgroup['Name'] = $this->form_validation->set_value('Name');
            $editgroup['Status'] = $this->form_validation->set_value('Status');
            $editgroup['UpdDateTime'] = date('Y-m-d H:i:s');
            $editgroup['UpdTerminal'] = $this->input->ip_address();
            if ($this->designationmst->update($editgroup, $DesignID)) {
                $this->_show_message('Designation is edited successfully', 'success');
                redirect('designation');
            }
        } else {
            if ($this->input->post()) {
                $this->data['designation'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('frontend', $view, $this->data);
    }

    function delete($DesignID = '') {
        if ($this->input->post('option')) {
            $DesignIDs = $this->input->post('option');
            if ($this->designationmst->deleteAll($DesignIDs)) {
                $this->_show_message("Designation deleted", 'success');
            }
        } else {
            if (!$DesignID)
                show_404();
            if ($this->designationmst->delete($DesignID)) {
                $this->_show_message("Designation deleted", 'success');
            }
        }
        redirect('designation');
    }

    function activate($DesignID = '') {
        if (!$DesignID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '1';
        if ($this->designationmst->update($editActivation, $DesignID)) {
            $this->_show_message("Designation activated successfully", 'success');
            redirect('designation');
        }
    }

    function deactivate($DesignID = '') {
        if (!$DesignID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '0';
        if ($this->designationmst->update($editActivation, $DesignID)) {
            $this->_show_message("Designation deactivated successfully", 'success');
            redirect('designation');
        }
    }
	
	function check($DesignID = '') {
		$name = $this->input->get('Name');
        $category = $this->designationmst->check($name, $DesignID);
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }
	
	function checkfirst() {
		$name = $this->input->get('Name');
        $category = $this->designationmst->check($name, '');
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }

}
