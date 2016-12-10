<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Category
 * ----For Machine Category
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Category extends MY_admin {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'category';
        $this->load->model('categorymst');
    }

    /**
     * function index
     * @descp Used to list all admin category
     * @where view page datatable list in admin/categorys/view (view folder)
     * */
    public function index($CatID = '') {
        /*
         * @var view : view CatName
         * @title :title of page
         */
        $view = 'category/view';
        $this->metas['title'] = array('Admin | Category List');
        $data['allcategory'] = $this->categorymst->getCategory();
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('admin', $view, $data);
    }

    public function add() {
        /*
         * @var view : view CatName
         * @title :title of page
         */
        $view = 'category/add';
        $this->metas['title'] = array('Admin | Category | Add');
//        $where = array('conditions' => array('CatID != ?', 1));
//        $data['admingp'] = Categorymst::find_assoc($where);
        $config = array(
            array('field' => 'CatName', 'label' => 'CatName', 'rules' => 'required|is_unique[categorymst.CatName]'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['CatName'] = $this->form_validation->set_value('CatName');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->categorymst->insert($data)) {
                $this->_show_message('Category is added successfully', 'success');
                redirect('admin/category');
            }
        } else {
            if ($this->input->post())
                $this->data['category'] = (object) $this->input->post();
        }
        $this->display_view('admin', $view, $data);
    }

    function edit($CatID = '') {
        if (!$CatID)
            show_404();
        /*
         * @var view : view CatName
         * @title :title of page
         */
        $view = 'category/add';
        $this->metas['title'] = array('Admin | Category | Edit');
        $this->data['category'] = $this->categorymst->getCategoryByID($CatID);
        if($this->input->post('CatName') != $this->data['category']->CatName) {
            $is_unique =  '|is_unique[categorymst.CatName]';
        } else {
           $is_unique =  '';
        }
        $config = array(
            array('field' => 'CatName', 'label' => 'CatName', 'rules' => 'required'.$is_unique),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $editgroup = array();
            $editgroup['CatName'] = $this->form_validation->set_value('CatName');
            $editgroup['Status'] = $this->form_validation->set_value('Status');
            $editgroup['UpdDateTime'] = date('Y-m-d H:i:s');
            if ($this->categorymst->update($editgroup, $CatID)) {
                $this->_show_message('Category is edited successfully', 'success');
                redirect('admin/category');
            }
        } else {
            if ($this->input->post()) {
                $this->data['category'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('admin', $view, $this->data);
    }

    function delete($CatID = '') {
        if ($this->input->post('option')) {
            $CatIDs = $this->input->post('option');
            if($this->categorymst->deleteAll($CatIDs)){
                $this->_show_message("Category deleted", 'success');
            }
        } else {
            if (!$CatID)
                show_404();
            if($this->categorymst->delete($CatID)){
                $this->_show_message("Category deleted", 'success');
            }
            
        }
        redirect('admin/category');
    }

    function activate($CatID = '') {
        if (!$CatID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '1';
        if ($this->categorymst->update($editActivation, $CatID)) {
            $this->_show_message("Category activated successfully", 'success');
            redirect('admin/category');
        }
    }

    function deactivate($CatID = '') {
        if (!$CatID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '0';
        if ($this->categorymst->update($editActivation, $CatID)) {
            $this->_show_message("Category deactivated successfully", 'success');
            redirect('admin/category');
        }
    }
	
	function check($CatID = '') {
		$name = $this->input->get('CatName');
        $category = $this->categorymst->check($name, $CatID);
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }
	
	function checkfirst() {
		$name = $this->input->get('CatName');
        $category = $this->categorymst->check($name, '');
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }

}
