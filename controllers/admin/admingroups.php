<?php

/*
 * -----------------------------
 * ----Author shafiq
 * ----Class Admin Group
 * ----For admin Group user
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Admingroups extends MY_admin {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'admingroups';
    }

    /**
     * function index
     * @descp Used to list all admin groups
     * @where view page datatable list in admin/admingroups/view (view folder)
     * */
    public function index($id = '') {
        /*
         * @var view : view name
         * @title :title of page
         */
        $view = 'admingroup/view';
        $this->metas['title'] = array('Admin | Groups List');

        /*
         * if user is super admin list all admin
         * if user is admin list only its lower level admin
         * currently showing all user to except super admin
         * 
         */

        if ($this->session->userdata[SITE_NAME.'_admin_user_data']['admingroup'] == 1) {
            //  $data['allAdminuser'] = Adminuser::find('all', array('order' => 'updated desc', 'include' => 'admingroup'));
            $data['allAdminuser'] = Admingroup::find('all', array('order' => 'updated desc'));
        } else if ($this->session->userdata[SITE_NAME.'_admin_user_data']['admingroup'] == 2) {
            $data['allAdminuser'] = Admingroup::find('all', array('conditions' => array('id != ?', 1), 'order' => 'updated desc'));
        } else {
            $data['allAdminuser'] = Admingroup::find('all', array('conditions' => array('id != ?', 1), 'order' => 'updated desc'));
        }
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        //$this->data['userRights'] = $this->check_rights();
        $this->display_view('admin', $view, $data);
    }

    public function add() {
        /*
         * @var view : view name
         * @title :title of page
         */
        $view = 'admingroup/add';
        $this->metas['title'] = array('Admin | Groups | Add');
        $where = array('conditions' => array('id != ?', 1));
        $data['admingp'] = Admingroup::find_assoc($where);
        $config = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        $this->data['admingroup'] = new Admingroup();
        if ($this->form_validation->run()) {
            $data = new Admingroup();
            $data->name = $this->form_validation->set_value('name');
            $data->status = $this->form_validation->set_value('status');
            $data->created = date("Y:m:d H:i:s");
            $data->updated = date("Y:m:d H:i:s");
            $data->save();
            $this->_show_message('Admin group is added successfully', 'success');
            redirect('admin/groups');
        } else {
            if ($this->input->post())
                $this->data['admingroup'] = (object) $this->input->post();
        }
        $this->display_view('admin', $view, $data);
    }

    function edit($id = '') {
        if (!$id)
            show_404();
        /*
         * @var view : view name
         * @title :title of page
         */
        $view = 'admingroup/add';
        $this->metas['title'] = array('Admin | Groups | Edit');
        $this->data['admingroup'] = Admingroup::find(array('conditions' => array('id = ? ', $id)));
        $config = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $editgroup = Admingroup::find($id);
            $editgroup->name = $this->form_validation->set_value('name');
            $editgroup->status = $this->form_validation->set_value('status');
            $editgroup->updated = date('Y-m-d H:i:s');
            $editgroup->save();
            $this->_show_message('Admin group is edited successfully', 'success');
            redirect('admin/groups');
        } else {
            if ($this->input->post()) {
                $this->data['admingroup'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('admin', $view, $this->data);
    }

    function delete($id = '') {
        if ($this->input->post('option')) {
            $ids = $this->input->post('option');
            $deleteObj = Admingroup::find('all', array('conditions' => array('id in (?)', $ids)));
            foreach ($deleteObj as $obj) {
                $obj->delete();
            }
            $this->_show_message("Admin groups deleted", 'success');
        } else {
            if (!$id)
                show_404();
            $deleteObj = Admingroup::find($id);
            $deleteObj->delete();
            $this->_show_message("Admin groups deleted", 'success');
        }
        redirect('admin/groups');
    }

    function activate($id = '') {
        if (!$id)
            show_404();
        $editActivation = Admingroup::find_by_id($id);
        $editActivation->status = '1';
        $editActivation->save();
        $this->_show_message("Admin groups activated successfully", 'success');
        redirect('admin/groups');
    }

    function deactivate($id = '') {
        if (!$id)
            show_404();
        $editActivation = Admingroup::find_by_id($id);
        $editActivation->status = '0';
        $editActivation->save();
        $this->_show_message("Admin groups deactivated successfully", 'success');
        redirect('admin/groups');
    }
	
	function check($id = '') {
		$name = $this->input->get('name');
        $admingroup = Admingroup::find(array('conditions' => array('id <> ? AND name = ? ', $id, $name)));
		if(empty($admingroup)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }
	
	function checkfirst() {
		$name = $this->input->get('name');
        $admingroup = Admingroup::find(array('conditions' => array('name = ? ',$name)));
		if(empty($admingroup)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }

}

