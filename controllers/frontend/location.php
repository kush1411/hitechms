<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Location
 * ----For Machine Location
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Location extends My_front {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'location';
        $this->load->model('locationmst');
    }

    /**
     * function index
     * @descp Used to list all frontend location
     * @where view page datatable list in locations/view (view folder)
     * */
    public function index($LocID = '') {
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'location/view';
        $this->metas['title'] = array('Client | Location List');
        $data['alllocation'] = $this->locationmst->getLocation();
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
        $view = 'location/add';
        $this->metas['title'] = array('Client | Location | Add');
        $config = array(
            array('field' => 'Code', 'label' => 'Code', 'rules' => 'required|is_unique[locationmst.Code]'),
            array('field' => 'Name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required')
        );
        $this->form_validation->set_rules($config);
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
				
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCompID'] = $user_id;
            $data['Code'] = $this->form_validation->set_value('Code');
            $data['Name'] = $this->form_validation->set_value('Name');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->locationmst->insert($data)) {
                $this->_show_message('Location is added successfully', 'success');
                redirect('location');
            }
        } else {
            if ($this->input->post())
                $this->data['location'] = (object) $this->input->post();
        }
        $this->display_view('frontend', $view, $data);
    }

    function edit($LocID = '') {
        if (!$LocID)
            show_404();
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'location/add';
        $this->metas['title'] = array('Client | Location | Edit');
        $this->data['location'] = $this->locationmst->getLocationByID($LocID);
        if($this->input->post('Name') != $this->data['location']->Name) {
            $is_unique =  '|is_unique[locationmst.Name]';
        } else {
           $is_unique =  '';
        }
        if($this->input->post('Code') != $this->data['location']->Code) {
            $is_unique1 =  '|is_unique[locationmst.Code]';
        } else {
           $is_unique1 =  '';
        }
        $config = array(
            array('field' => 'Code', 'label' => 'Code', 'rules' => 'required'.$is_unique1),
            array('field' => 'Name', 'label' => 'Name', 'rules' => 'required'.$is_unique),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $editgroup = array();
            $editgroup['Code'] = $this->form_validation->set_value('Code');
            $editgroup['Name'] = $this->form_validation->set_value('Name');
            $editgroup['Status'] = $this->form_validation->set_value('Status');
            $editgroup['UpdDateTime'] = date('Y-m-d H:i:s');
            $editgroup['UpdTerminal'] = $this->input->ip_address();
            if ($this->locationmst->update($editgroup, $LocID)) {
                $this->_show_message('Location is edited successfully', 'success');
                redirect('location');
            }
        } else {
            if ($this->input->post()) {
                $this->data['location'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('frontend', $view, $this->data);
    }

    function delete($LocID = '') {
        if ($this->input->post('option')) {
            $LocIDs = $this->input->post('option');
            if($this->locationmst->deleteAll($LocIDs)){
                $this->_show_message("Location deleted", 'success');
            }
        } else {
            if (!$LocID)
                show_404();
            if($this->locationmst->delete($LocID)){
                $this->_show_message("Location deleted", 'success');
            }
            
        }
        redirect('location');
    }

    function activate($LocID = '') {
        if (!$LocID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '1';
        if ($this->locationmst->update($editActivation, $LocID)) {
            $this->_show_message("Location activated successfully", 'success');
            redirect('location');
        }
    }

    function deactivate($LocID = '') {
        if (!$LocID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '0';
        if ($this->locationmst->update($editActivation, $LocID)){
            $this->_show_message("Location deactivated successfully", 'success');
            redirect('location');
        }
    }
	
	function check($LocID = '') {
		$name = $this->input->get('Code');
        $category = $this->locationmst->check($name, $LocID);
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }
	
	function checkfirst() {
		$name = $this->input->get('Code');
        $category = $this->locationmst->check($name, '');
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }

}
