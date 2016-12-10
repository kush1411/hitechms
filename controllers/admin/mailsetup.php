<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Mailsetup
 * ----For Machine Mailsetup
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Mailsetup extends MY_admin {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'mailsetup';
        $this->load->model('mailsetupmst');
    }

    /**
     * function index
     * @descp Used to list all admin mailsetup
     * @where view page datatable list in admin/mailsetups/view (view folder)
     * */
    public function index($CatID = '') {
        /*
         * @var view : view CatName
         * @title :title of page
         */
        $view = 'mailsetup/view';
        $this->metas['title'] = array('Admin | Mailsetup List');
        $data['allmailsetup'] = $this->mailsetupmst->getMailsetup();
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
        $view = 'mailsetup/add';
        $this->metas['title'] = array('Admin | Mailsetup | Add');
        $this->data['mfg'] = $this->mailsetupmst->getMfg();
        $config = array(
            array('field' => 'refMfgID1', 'label' => 'refMfgID1', 'rules' => 'required|is_unique[mailmst.refMfgID1]'),
            array('field' => 'refMfgID2', 'label' => 'refMfgID2', 'rules' => 'required')
        );
        $this->form_validation->set_rules($config);
        $data = array();
        if ($this->form_validation->run()) {
            $refMfgID1 = $this->input->post('refMfgID1');
            $refMfgID2 = $this->input->post('refMfgID2');
            $data = array();
            if (!empty($refMfgID2)) {
                foreach ($refMfgID2 as $key => $value) {
                    $data[] = array('refMfgID1' => $refMfgID1, 'refMfgID2' => $value, 'InsDateTime' => date('Y-m-d H:i:s'));
                }
            }
            if (!empty($data)) {
                if ($this->mailsetupmst->insert($data)) {
                    $this->_show_message('Mailsetup is added successfully', 'success');
                    redirect('admin/mailsetup');
                } else {
                    $this->_show_message('Database Unreachable, Try Again', 'error');
                    redirect('admin/mailsetup');
                }
            } else {
                $this->_show_message('Something Went Wrong, Try Again', 'error');
                redirect('admin/mailsetup');
            }
        } else {
            if ($this->input->post())
                $this->data['mailsetup'] = (object) $this->input->post();
        }
        $this->display_view('admin', $view, $data);
    }

    function edit($MfgID = '') {
        if (!$MfgID)
            show_404();
        /*
         * @var view : view CatName
         * @title :title of page
         */
        $view = 'mailsetup/add';
        $this->metas['title'] = array('Admin | Mailsetup | Edit');
        $this->data['mailsetup'] = $this->mailsetupmst->getMailsetupByID($MfgID);
        $this->data['mfg'] = $this->mailsetupmst->getMfg();

        $config = array(
            array('field' => 'refMfgID1', 'label' => 'refMfgID1', 'rules' => 'required'),
            array('field' => 'refMfgID2', 'label' => 'refMfgID2', 'rules' => 'required')
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $refMfgID1 = $this->input->post('refMfgID1');
            $refMfgID2 = $this->input->post('refMfgID2');
            $data = array();
            if (!empty($refMfgID2)) {
                foreach ($refMfgID2 as $key => $value) {
                    $data[] = array('refMfgID1' => $refMfgID1, 'refMfgID2' => $value, 'InsDateTime' => date('Y-m-d H:i:s'));
                }
            }
            if (!empty($data)) {
                $this->mailsetupmst->delete($MfgID);
                if ($this->mailsetupmst->insert($data)) {
                    $this->_show_message('Mailsetup is Updated successfully', 'success');
                    redirect('admin/mailsetup');
                } else {
                    $this->_show_message('Database Unreachable, Try Again', 'error');
                    redirect('admin/mailsetup');
                }
            } else {
                $this->_show_message('Something Went Wrong, Try Again', 'error');
                redirect('admin/mailsetup');
            }
        } else {
            if ($this->input->post()) {
                $this->data['mailsetup'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('admin', $view, $this->data);
    }

    function delete($CatID = '') {
        if ($this->input->post('option')) {
            $CatIDs = $this->input->post('option');
            if ($this->mailsetupmst->deleteAll($CatIDs)) {
                $this->_show_message("Mailsetup deleted", 'success');
            }
        } else {
            if (!$CatID)
                show_404();
            if ($this->mailsetupmst->delete($CatID)) {
                $this->_show_message("Mailsetup deleted", 'success');
            }
        }
        redirect('admin/mailsetup');
    }

    function check($CatID = '') {
        $name = $this->input->get('CatName');
        $mailsetup = $this->mailsetupmst->check($name, $CatID);
        if (empty($mailsetup)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkfirst() {
        $name = $this->input->get('CatName');
        $mailsetup = $this->mailsetupmst->check($name, '');
        if (empty($mailsetup)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

}
