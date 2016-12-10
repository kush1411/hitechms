<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Subparts
 * ----For Machine Subparts
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Subparts extends MY_admin {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'subparts';
        $this->load->model('subpartsmst');
    }

    /**
     * function index
     * @descp Used to list all admin parts
     * @where view page datatable list in admin/subpartss/view (view folder)
     * */
    public function index($SubpartsID = '') {
        /*
         * @var view : view SubpartsName
         * @title :title of page
         */
        $view = 'subparts/view';
        $this->metas['title'] = array('Admin | Subparts List');
        $data['allsubparts'] = $this->subpartsmst->getSubparts();
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('admin', $view, $data);
    }

    public function add() {
        /*
         * @var view : view SubpartsName
         * @title :title of page
         */
        $view = 'subparts/add';
        $this->metas['title'] = array('Admin | Subparts | Add');
        $this->data['parts'] = $this->subpartsmst->getPart();
        $this->data['mfg'] = $this->subpartsmst->getMfg();
        $config = array(
            array('field' => 'refMachPartID', 'label' => 'refMachPartID', 'rules' => 'required|callback_select_validate'),
            array('field' => 'SubPartName', 'label' => 'SubPartName', 'rules' => 'required'),
            array('field' => 'refMfgID[]', 'label' => 'refMfgID[]', 'rules' => 'required'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refMachPartID'] = $this->form_validation->set_value('refMachPartID');
            $data['SubPartName'] = $this->form_validation->set_value('SubPartName');
            //$data['refMfgID'] = $this->form_validation->set_value('refMfgID');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($subpartid = $this->subpartsmst->insert($data)) {
                $insertData = array();
                $refMfgID = $this->input->post('refMfgID');
                if (!empty($refMfgID)) {
                    foreach ($refMfgID as $key => $value) {
                        $tmp = array();
                        $tmp['refMachSubPartID'] = $subpartid;
                        $tmp['refMfgID'] = $value;
                        $insertData[] = $tmp;
                    }
                }
                if (!empty($insertData)) {
                    $this->subpartsmst->insertbatch($insertData);
                }
                $this->_show_message('Subparts is added successfully', 'success');
                redirect('admin/subparts');
            }
        } else {
            if ($this->input->post())
                $this->data['subparts'] = (object) $this->input->post();
        }
        $this->display_view('admin', $view, $data);
    }

    function edit($SubpartsID = '') {
        if (!$SubpartsID)
            show_404();
        /*
         * @var view : view SubpartsName
         * @title :title of page
         */
        $view = 'subparts/add';
        $this->metas['title'] = array('Admin | Subparts | Edit');

        $this->data['subparts'] = $this->subpartsmst->getSubpartsByID($SubpartsID);
        $this->data['subparts']->refMfgID = (array) $this->subpartsmst->getMfgBySubPartsID($SubpartsID);
        $this->data['parts'] = $this->subpartsmst->getPart();
        $this->data['mfg'] = $this->subpartsmst->getMfg();

        if ($this->input->post('SubPartName') != $this->data['subparts']->SubPartName) {
            $is_unique = '|is_unique[subpartsmst.SubPartName]';
        } else {
            $is_unique = '';
        }
        $config = array(
            array('field' => 'refMachPartID', 'label' => 'refMachPartID', 'rules' => 'required|callback_select_validate'),
            array('field' => 'SubPartName', 'label' => 'SubPartName', 'rules' => 'required'),
            array('field' => 'refMfgID[]', 'label' => 'refMfgID[]', 'rules' => 'required'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $data = array();
            $data['refMachPartID'] = $this->form_validation->set_value('refMachPartID');
            $data['SubPartName'] = $this->form_validation->set_value('SubPartName');
            // $data['refMfgID'] = $this->form_validation->set_value('refMfgID');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['UpdDateTime'] = date('Y-m-d H:i:s');
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->subpartsmst->update($data, $SubpartsID)) {
                $this->subpartsmst->deletebatch($SubpartsID);
                $insertData = array();
                $refMfgID = $this->input->post('refMfgID');
                if (!empty($refMfgID)) {
                    foreach ($refMfgID as $key => $value) {
                        $tmp = array();
                        $tmp['refMachSubPartID'] = $SubpartsID;
                        $tmp['refMfgID'] = $value;
                        $insertData[] = $tmp;
                    }
                }
                if (!empty($insertData)) {
                    $this->subpartsmst->insertbatch($insertData);
                }
                $this->_show_message('Subparts is edited successfully', 'success');
                redirect('admin/subparts');
            }
        } else {
            if ($this->input->post()) {
                $this->data['subparts'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('admin', $view, $this->data);
    }

    function copy($SubpartsID = '') {
        if (!$SubpartsID)
            show_404();
        /*
         * @var view : view SubpartsName
         * @title :title of page
         */
        $view = 'subparts/copy';
        $this->metas['title'] = array('Admin | Subparts | Copy');

        $this->data['subparts'] = $this->subpartsmst->getSubpartsByID($SubpartsID);
        $this->data['subparts']->refMfgID = (array) $this->subpartsmst->getMfgBySubPartsID($SubpartsID);
        $this->data['parts'] = $this->subpartsmst->getPart();
        $this->data['mfg'] = $this->subpartsmst->getMfg();

        if ($this->input->post('SubPartName') != $this->data['subparts']->SubPartName) {
            $is_unique = '|is_unique[subpartsmst.SubPartName]';
        } else {
            $is_unique = '';
        }
        $config = array(
            array('field' => 'refMachPartID', 'label' => 'refMachPartID', 'rules' => 'required|callback_select_validate'),
            array('field' => 'SubPartName', 'label' => 'SubPartName', 'rules' => 'required'),
            array('field' => 'refMfgID[]', 'label' => 'refMfgID[]', 'rules' => 'required'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $data = array();
            $data['refMachPartID'] = $this->form_validation->set_value('refMachPartID');
            $data['SubPartName'] = $this->form_validation->set_value('SubPartName');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($subpartid = $this->subpartsmst->insert($data)) {
                $insertData = array();
                $refMfgID = $this->input->post('refMfgID');
                if (!empty($refMfgID)) {
                    foreach ($refMfgID as $key => $value) {
                        $tmp = array();
                        $tmp['refMachSubPartID'] = $subpartid;
                        $tmp['refMfgID'] = $value;
                        $insertData[] = $tmp;
                    }
                }
                if (!empty($insertData)) {
                    $this->subpartsmst->insertbatch($insertData);
                }
                $this->_show_message('Subparts is added successfully', 'success');
                redirect('admin/subparts');
            }
        } else {
            if ($this->input->post())
                $this->data['subparts'] = (object) $this->input->post();
        }
        $this->display_view('admin', $view, $this->data);
    }

    function delete($SubpartsID = '') {
        if ($this->input->post('option')) {
            $SubpartsIDs = $this->input->post('option');
            if ($this->subpartsmst->deleteAll($SubpartsIDs)) {
                $this->_show_message("Subparts deleted", 'success');
            }
        } else {
            if (!$SubpartsID)
                show_404();
            if ($this->subpartsmst->delete($SubpartsID)) {
                $this->_show_message("Subparts deleted", 'success');
            }
        }
        redirect('admin/subparts');
    }

    function activate($SubpartsID = '') {
        if (!$SubpartsID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '1';
        if ($this->subpartsmst->update($editActivation, $SubpartsID)) {
            $this->_show_message("Subparts activated successfully", 'success');
            redirect('admin/subparts');
        }
    }

    function deactivate($SubpartsID = '') {
        if (!$SubpartsID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '0';
        if ($this->subpartsmst->update($editActivation, $SubpartsID)) {
            $this->_show_message("Subparts deactivated successfully", 'success');
            redirect('admin/subparts');
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

    function check($SubpartsID = '') {
        $name = $this->input->get('SubPartName');
        $refMachPartID = $this->input->get('refMachPartID');
        $parts = $this->subpartsmst->check($name,$refMachPartID, $SubpartsID);
        if (empty($parts)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkfirst() {
        $name = $this->input->get('SubPartName');
        $refMachPartID = $this->input->get('refMachPartID');
        $parts = $this->subpartsmst->check($name,$refMachPartID, '');
        if (empty($parts)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

}
