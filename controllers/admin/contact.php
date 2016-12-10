<?php

/*
 * -----------------------------
 * ----Author shafiq
 * ----Class Contact
 * ----For admin user
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Contact extends MY_admin {
    /*
     * ------Contructor------
     * load library for tank auth admin 
     * used for the authanticating the 
     * validate user
     */

    function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'contact';
        $this->load->model('contactmst');
    }

    /**
     * function index
     * @descp Used to list all admin user
     * @where view page datatable list in admin/admin/view (view folder)
     * */
    function index() {
        /*
         * @var view : view name
         * @title :title of page
         */
        $view = 'contact/view';
        $this->metas['title'] = array('Contact | List');
        $data = array();
        $data['allContact'] = $this->contactmst->getAllContact();
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('admin', $view, $data);
    }

    function delete($id = '') {
        if ($this->input->post('option')) {
            $ids = $this->input->post('option');
            if($this->contactmst->deleteAll($ids)){
                $this->_show_message("Contact deleted", 'success');
            }
        } else {
            if (!$id)
                show_404();
            if($this->contactmst->delete($id)){
                $this->_show_message("Contact deleted", 'success');
            }
            
        }
        redirect('admin/contact');
    }

}

?>