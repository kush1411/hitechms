<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Type
 * ----For Machine Type
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Type extends MY_admin {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'type';
        $this->load->model('typemst');
    }

    /**
     * function index
     * @descp Used to list all admin type
     * @where view page datatable list in admin/types/view (view folder)
     * */
    public function index($TypeID = '') {
        /*
         * @var view : view TypeName
         * @title :title of page
         */
        $view = 'type/view';
        $this->metas['title'] = array('Admin | Type List');
        $data['alltype'] = $this->typemst->getType();
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('admin', $view, $data);
    }

    public function add() {
        /*
         * @var view : view TypeName
         * @title :title of page
         */
        $view = 'type/add';
        $this->metas['title'] = array('Admin | Type | Add');
        $this->data['category'] = $this->typemst->getCat();
        $this->data['mfg'] = $this->typemst->getMfg();
        $config = array(
            array('field' => 'refCatID', 'label' => 'refCatID', 'rules' => 'required|callback_select_validate'),
            array('field' => 'TypeName', 'label' => 'TypeName', 'rules' => 'required'),
            array('field' => 'refMfgID[]', 'label' => 'refMfgID[]', 'rules' => 'required'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCatID'] = $this->form_validation->set_value('refCatID');
            $data['TypeName'] = $this->form_validation->set_value('TypeName');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($typeid = $this->typemst->insert($data)) {
                $insertData = array();
                $refMfgID = $this->input->post('refMfgID');
                if(!empty($refMfgID)){
                    foreach ($refMfgID as $key => $value) {
                        $tmp = array();
                        $tmp['refTypeID']= $typeid;
                        $tmp['refMfgID']= $value;
                        $insertData[] = $tmp;
                    }
                }
                if(!empty($insertData)){
                    $this->typemst->insertbatch($insertData);
                }
                $this->_show_message('Type is added successfully', 'success');
                redirect('admin/type');
            }
        } else {
            if ($this->input->post())
                $this->data['type'] = (object) $this->input->post();
        }
        $this->display_view('admin', $view, $data);
    }

    function edit($TypeID = '') {
        if (!$TypeID)
            show_404();
        /*
         * @var view : view TypeName
         * @title :title of page
         */
        $view = 'type/add';
        $this->metas['title'] = array('Admin | Type | Edit');
        
        $this->data['type'] = $this->typemst->getTypeByID($TypeID);
        $this->data['type']->refMfgID = (array)$this->typemst->getMfgByTypeID($TypeID);
        $this->data['category'] = $this->typemst->getCat();
        $this->data['mfg'] = $this->typemst->getMfg();
        
        if($this->input->post('TypeName') != $this->data['type']->TypeName) {
            $is_unique =  '|is_unique[typemst.TypeName]';
        } else {
           $is_unique =  '';
        }
        $config = array(
            array('field' => 'refCatID', 'label' => 'refCatID', 'rules' => 'required|callback_select_validate'),
            array('field' => 'TypeName', 'label' => 'TypeName', 'rules' => 'required'),
            array('field' => 'refMfgID[]', 'label' => 'refMfgID[]', 'rules' => 'required'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCatID'] = $this->form_validation->set_value('refCatID');
            $data['TypeName'] = $this->form_validation->set_value('TypeName');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['UpdDateTime'] = date('Y-m-d H:i:s');
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->typemst->update($data, $TypeID)) {
                $this->typemst->deletebatch($TypeID);
                $insertData = array();
                $refMfgID = $this->input->post('refMfgID');
                if(!empty($refMfgID)){
                    foreach ($refMfgID as $key => $value) {
                        $tmp = array();
                        $tmp['refTypeID']= $TypeID;
                        $tmp['refMfgID']= $value;
                        $insertData[] = $tmp;
                    }
                }
                if(!empty($insertData)){
                    $this->typemst->insertbatch($insertData);
                }
                $this->_show_message('Type is edited successfully', 'success');
                redirect('admin/type');
            }
        } else {
            if ($this->input->post()) {
                $this->data['type'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('admin', $view, $this->data);
    }

    function delete($TypeID = '') {
        if ($this->input->post('option')) {
            $TypeIDs = $this->input->post('option');
            if($this->typemst->deleteAll($TypeIDs)){
                $this->_show_message("Type deleted", 'success');
            }
        } else {
            if (!$TypeID)
                show_404();
            if($this->typemst->delete($TypeID)){
                $this->_show_message("Type deleted", 'success');
            }
            
        }
        redirect('admin/type');
    }

    function activate($TypeID = '') {
        if (!$TypeID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '1';
        if ($this->typemst->update($editActivation, $TypeID)) {
            $this->_show_message("Type activated successfully", 'success');
            redirect('admin/type');
        }
    }

    function deactivate($TypeID = '') {
        if (!$TypeID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '0';
        if ($this->typemst->update($editActivation, $TypeID)) {
            $this->_show_message("Type deactivated successfully", 'success');
            redirect('admin/type');
        }
    }
    
    function status_validate($str) {
        if ($str == 1 || $str == 0) {
            return true;
        } else {
            $this->form_validation->set_message('status_validate', 'Please choose status');
            return FALSE;
        }
    }

    function select_validate($str) {
        if ($str == -1 || $str == 0 || $str == '') {
            $this->form_validation->set_message('select_validate', 'Please Select Category');
            return FALSE;
        } else {
            return true;
        }
    }
	
	function check($TypeID = '') {
		$name = $this->input->get('TypeName');
		$refCatID = $this->input->get('refCatID');
        $mfg = $this->typemst->check($name,$refCatID, $TypeID);
		if(empty($mfg)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }
	
	function checkfirst() {
		$name = $this->input->get('TypeName');
		$refCatID = $this->input->get('refCatID');
        $mfg = $this->typemst->check($name,$refCatID, '');
		if(empty($mfg)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }

}
