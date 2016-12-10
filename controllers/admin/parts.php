<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Parts
 * ----For Machine Parts
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Parts extends MY_admin {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'parts';
        $this->load->model('partsmst');
    }

    /**
     * function index
     * @descp Used to list all admin parts
     * @where view page datatable list in admin/partss/view (view folder)
     * */
    public function index($PartsID = '') {
        /*
         * @var view : view PartsName
         * @title :title of page
         */
        $view = 'parts/view';
        $this->metas['title'] = array('Admin | Parts List');
        $data['allparts'] = $this->partsmst->getParts();
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('admin', $view, $data);
    }

    public function add() {
        /*
         * @var view : view PartsName
         * @title :title of page
         */
        $view = 'parts/add';
        $this->metas['title'] = array('Admin | Parts | Add');
        $this->data['category'] = $this->partsmst->getCat();
        $this->data['mfg'] = $this->partsmst->getMfg();
        $config = array(
            array('field' => 'refCatID', 'label' => 'refCatID', 'rules' => 'required|callback_select_validate'),
            array('field' => 'PartName', 'label' => 'PartName', 'rules' => 'required'),
            array('field' => 'refTypeID', 'label' => 'refTypeID', 'rules' => 'required'),
            array('field' => 'refMfgID[]', 'label' => 'refMfgID[]', 'rules' => 'required'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCatID'] = $this->form_validation->set_value('refCatID');
            $data['refTypeID'] = $this->form_validation->set_value('refTypeID');
            $data['PartName'] = $this->form_validation->set_value('PartName');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($partid = $this->partsmst->insert($data)) {
                $insertData = array();
                $refMfgID = $this->input->post('refMfgID');
                if (!empty($refMfgID)) {
                    foreach ($refMfgID as $key => $value) {
                        $tmp = array();
                        $tmp['refMachPartID'] = $partid;
                        $tmp['refMfgID'] = $value;
                        $insertData[] = $tmp;
                    }
                }
                if (!empty($insertData)) {
                    $this->partsmst->insertbatch($insertData);
                }
                $this->_show_message('Parts is added successfully', 'success');
                redirect('admin/parts');
            }
        } else {
            if ($this->input->post())
                $this->data['parts'] = (object) $this->input->post();
        }
        $this->display_view('admin', $view, $data);
    }

    function edit($PartsID = '') {
        if (!$PartsID)
            show_404();
        /*
         * @var view : view PartsName
         * @title :title of page
         */
        $view = 'parts/add';
        $this->metas['title'] = array('Admin | Parts | Edit');

        $this->data['parts'] = $this->partsmst->getPartsByID($PartsID);
        $this->data['parts']->refMfgID = (array) $this->partsmst->getMfgByPartsID($PartsID);
        $this->data['type'] = $this->partsmst->getType($this->data['parts']->refCatID);
        $this->data['category'] = $this->partsmst->getCat();
        $this->data['mfg'] = $this->partsmst->getMfg();

        if ($this->input->post('PartName') != $this->data['parts']->PartName) {
            $is_unique = '|is_unique[partsmst.PartsName]';
        } else {
            $is_unique = '';
        }
        $config = array(
            array('field' => 'refCatID', 'label' => 'refCatID', 'rules' => 'required|callback_select_validate'),
            array('field' => 'PartName', 'label' => 'PartName', 'rules' => 'required'),
            array('field' => 'refTypeID', 'label' => 'refTypeID', 'rules' => 'required'),
            array('field' => 'refMfgID[]', 'label' => 'refMfgID[]', 'rules' => 'required'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCatID'] = $this->form_validation->set_value('refCatID');
            $data['refTypeID'] = $this->form_validation->set_value('refTypeID');
            $data['PartName'] = $this->form_validation->set_value('PartName');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['UpdDateTime'] = date('Y-m-d H:i:s');
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->partsmst->update($data, $PartsID)) {
                $this->partsmst->deletebatch($PartsID);
                $insertData = array();
                $refMfgID = $this->input->post('refMfgID');
                if (!empty($refMfgID)) {
                    foreach ($refMfgID as $key => $value) {
                        $tmp = array();
                        $tmp['refMachPartID'] = $PartsID;
                        $tmp['refMfgID'] = $value;
                        $insertData[] = $tmp;
                    }
                }
                if (!empty($insertData)) {
                    $this->partsmst->insertbatch($insertData);
                }
                $this->_show_message('Parts is edited successfully', 'success');
                redirect('admin/parts');
            }
        } else {
            if ($this->input->post()) {
                $this->data['parts'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('admin', $view, $this->data);
    }
    
    function copy($PartsID = '') {
        if (!$PartsID)
            show_404();
        /*
         * @var view : view PartsName
         * @title :title of page
         */
        $view = 'parts/copy';
        $this->metas['title'] = array('Admin | Parts | Add');

        $this->data['parts'] = $this->partsmst->getPartsByID($PartsID);
        $this->data['parts']->refMfgID = (array) $this->partsmst->getMfgByPartsID($PartsID);
        $this->data['type'] = $this->partsmst->getType($this->data['parts']->refCatID);
        $this->data['category'] = $this->partsmst->getCat();
        $this->data['mfg'] = $this->partsmst->getMfg();

        if ($this->input->post('PartName') != $this->data['parts']->PartName) {
            $is_unique = '|is_unique[partsmst.PartsName]';
        } else {
            $is_unique = '';
        }
        $config = array(
            array('field' => 'refCatID', 'label' => 'refCatID', 'rules' => 'required|callback_select_validate'),
            array('field' => 'PartName', 'label' => 'PartName', 'rules' => 'required'),
            array('field' => 'refTypeID', 'label' => 'refTypeID', 'rules' => 'required'),
            array('field' => 'refMfgID[]', 'label' => 'refMfgID[]', 'rules' => 'required'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCatID'] = $this->form_validation->set_value('refCatID');
            $data['refTypeID'] = $this->form_validation->set_value('refTypeID');
            $data['PartName'] = $this->form_validation->set_value('PartName');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($partid = $this->partsmst->insert($data)) {
                $insertData = array();
                $refMfgID = $this->input->post('refMfgID');
                if (!empty($refMfgID)) {
                    foreach ($refMfgID as $key => $value) {
                        $tmp = array();
                        $tmp['refMachPartID'] = $partid;
                        $tmp['refMfgID'] = $value;
                        $insertData[] = $tmp;
                    }
                }
                if (!empty($insertData)) {
                    $this->partsmst->insertbatch($insertData);
                }
                $this->_show_message('Parts is added successfully', 'success');
                redirect('admin/parts');
            }
        } else {
            if ($this->input->post())
                $this->data['parts'] = (object) $this->input->post();
        }
        $this->display_view('admin', $view, $this->data);
    }

    function delete($PartsID = '') {
        if ($this->input->post('option')) {
            $PartsIDs = $this->input->post('option');
            if ($this->partsmst->deleteAll($PartsIDs)) {
                $this->_show_message("Parts deleted", 'success');
            }
        } else {
            if (!$PartsID)
                show_404();
            if ($this->partsmst->delete($PartsID)) {
                $this->_show_message("Parts deleted", 'success');
            }
        }
        redirect('admin/parts');
    }

    function activate($PartsID = '') {
        if (!$PartsID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '1';
        if ($this->partsmst->update($editActivation, $PartsID)) {
            $this->_show_message("Parts activated successfully", 'success');
            redirect('admin/parts');
        }
    }

    function deactivate($PartsID = '') {
        if (!$PartsID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '0';
        if ($this->partsmst->update($editActivation, $PartsID)) {
            $this->_show_message("Parts deactivated successfully", 'success');
            redirect('admin/parts');
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
        $name = $this->input->get('PartName');
        $refTypeID = $this->input->get('refTypeID');
        $parts = $this->partsmst->check($name,$refTypeID, $TypeID);
        if (empty($parts)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkfirst() {
        $name = $this->input->get('PartName');
        $refTypeID = $this->input->get('refTypeID');
        $parts = $this->partsmst->check($name,$refTypeID, '');
        if (empty($parts)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function gettype() {
        $refCatID = $this->input->get('id');
        if ($refCatID > 0) {
            $type = $this->partsmst->getType($refCatID);
            $msg = '<option value="">--Select Machine Type--</option>';
            if (!empty($type)) {
                foreach ($type as $k => $v) {
                    $msg .= '<option value="' . $v->TypeID . '" >' . $v->TypeName . '</option> ';
                }
            }
            $data['res'] = 'success';
            $data['msg'] = $msg;
        } else {
            $data['res'] = 'success';
            $data['msg'] = '<option value="">--Select Machine Type--</option>';
        }
        echo json_encode($data);
        die;
    }

}
