<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Machine
 * ----For Machine Machine
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Machine extends My_front {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'machine';
        $this->load->model('machinemst');
    }

    /**
     * function index
     * @descp Used to list all frontend machine
     * @where view page datatable list in machines/view (view folder)
     * */
    public function index($MachID = '') {
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'machine/view';
        $this->metas['title'] = array('Client | Machine List');
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $data['allmachine'] = $this->machinemst->getMachine($user_id);
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
        $view = 'machine/add';
        $this->metas['title'] = array('Client | Machine | Add');
        $config = array(
            array('field' => 'refCatID', 'label' => 'refCatID', 'rules' => 'required'),
            array('field' => 'refTypeID', 'label' => 'refTypeID', 'rules' => 'required'),
            array('field' => 'refMfgID', 'label' => 'refMfgID', 'rules' => 'required'),
            array('field' => 'refLocID', 'label' => 'refLocID', 'rules' => 'required'),
            array('field' => 'MachCode', 'label' => 'MachCode', 'rules' => 'trim|required|trim|xss_clean|is_unique[cmpmachmst.MachCode]'),
            array('field' => 'MachName', 'label' => 'MachName', 'rules' => 'trim|required|trim|xss_clean'),
            //array('field' => 'MachStatus', 'label' => 'MachStatus', 'rules' => 'required'),
            array('field' => 'MachDesc', 'label' => 'MachDesc', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachPurDate', 'label' => 'MachPurDate', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'MachCurrAmt', 'label' => 'MachCurrAmt', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachPurAmt', 'label' => 'MachPurAmt', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachBillNo', 'label' => 'MachBillNo', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'MachSerialNo', 'label' => 'MachSerialNo', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'MachRemarks', 'label' => 'MachRemarks', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachWarrantyFrom', 'label' => 'MachWarrantyFrom', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachWarrantyTo', 'label' => 'MachWarrantyTo', 'rules' => 'trim|xss_clean|strip_tags'),
        );
        $this->form_validation->set_rules($config);
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $this->data['category'] = $this->machinemst->getCategory();
        $this->data['location'] = $this->machinemst->getLocation($user_id);
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCompID'] = $user_id;
            $data['refCatID'] = $this->form_validation->set_value('refCatID');
            $data['refTypeID'] = $this->form_validation->set_value('refTypeID');
            $data['refMfgID'] = $this->form_validation->set_value('refMfgID');
            $data['refLocID'] = $this->form_validation->set_value('refLocID');
            $data['MachCode'] = $this->form_validation->set_value('MachCode');
            $data['MachName'] = $this->form_validation->set_value('MachName');
            $data['MachDesc'] = $this->form_validation->set_value('MachDesc');
            $dt = $this->form_validation->set_value('MachPurDate');
            $jdt = NULL;
            if ($dt != '') {
                $dt = explode('/', $dt);
                $jdt = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
            }
            $data['MachPurDate'] = $jdt;
            $data['MachCurrAmt'] = $this->form_validation->set_value('MachCurrAmt');
            $data['MachPurAmt'] = $this->form_validation->set_value('MachPurAmt');
            $data['MachBillNo'] = $this->form_validation->set_value('MachBillNo');
            $data['MachSerialNo'] = $this->form_validation->set_value('MachSerialNo');
            $b_data = $this->_get_auto_id();
            $data['autoserialno'] = $b_data['barcode'];
            $data['MachRemarks'] = $this->form_validation->set_value('MachRemarks');
            //$data['MachStatus'] = $this->form_validation->set_value('MachStatus');
            $dt = $this->form_validation->set_value('MachWarrantyFrom');
            $jdt = '0000-00-00';
            if ($dt != '') {
                $dt = explode('/', $dt);
                $jdt = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
            }
            $data['MachWarrantyFrom'] = $jdt;
            
            $dt = $this->form_validation->set_value('MachWarrantyTo');
            $jdt = '0000-00-00';
            if ($dt != '') {
                $dt = explode('/', $dt);
                $jdt = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
            }
            $data['MachWarrantyTo'] = $jdt;
            
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->machinemst->insert($data, $b_data['barcode_array'], $b_data['id'])) {
                $this->_show_message('Machine is added successfully', 'success');
                redirect('machine');
            }
        } else {
            if ($this->input->post())
                $this->data['machine'] = (object) $this->input->post();
        }
        $this->display_view('frontend', $view, $data);
    }

    function edit($MachID = '') {
        if (!$MachID)
            show_404();
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'machine/add';
        $this->metas['title'] = array('Client | Machine | Edit');
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $this->data['machine'] = $this->machinemst->getMachineByID($MachID);
        $this->data['category'] = $this->machinemst->getCategory();
        $this->data['type'] = $this->machinemst->getType($this->data['machine']->refCatID);

        $this->data['mfg'] = $this->machinemst->getMfg($this->data['machine']->refTypeID);
        $this->data['location'] = $this->machinemst->getLocation($user_id);

        if ($this->input->post('MachCode') != $this->data['machine']->MachCode) {
            $is_unique1 = '|is_unique[cmpmachmst.MachCode]';
        } else {
            $is_unique1 = '';
        }
        $config = array(
            array('field' => 'refCatID', 'label' => 'refCatID', 'rules' => 'required'),
            array('field' => 'refTypeID', 'label' => 'refTypeID', 'rules' => 'required'),
            array('field' => 'refMfgID', 'label' => 'refMfgID', 'rules' => 'required'),
            array('field' => 'refLocID', 'label' => 'refLocID', 'rules' => 'required'),
            array('field' => 'MachCode', 'label' => 'MachCode', 'rules' => 'trim|required|trim|xss_clean|' . $is_unique1),
            array('field' => 'MachName', 'label' => 'MachName', 'rules' => 'trim|required|trim|xss_clean'),
            // array('field' => 'MachStatus', 'label' => 'MachStatus', 'rules' => 'required'),
            array('field' => 'MachDesc', 'label' => 'MachDesc', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachPurDate', 'label' => 'MachPurDate', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'MachCurrAmt', 'label' => 'MachCurrAmt', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachPurAmt', 'label' => 'MachPurAmt', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachBillNo', 'label' => 'MachBillNo', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'MachSerialNo', 'label' => 'MachSerialNo', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'MachRemarks', 'label' => 'MachRemarks', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachWarrantyFrom', 'label' => 'MachWarrantyFrom', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'MachWarrantyTo', 'label' => 'MachWarrantyTo', 'rules' => 'trim|xss_clean|strip_tags'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCatID'] = $this->form_validation->set_value('refCatID');
            $data['refTypeID'] = $this->form_validation->set_value('refTypeID');
            $data['refMfgID'] = $this->form_validation->set_value('refMfgID');
            $data['refLocID'] = $this->form_validation->set_value('refLocID');
            $data['MachCode'] = $this->form_validation->set_value('MachCode');
            $data['MachName'] = $this->form_validation->set_value('MachName');
            $data['MachDesc'] = $this->form_validation->set_value('MachDesc');
            $dt = $this->form_validation->set_value('MachPurDate');
            $jdt = NULL;
            if ($dt != '') {
                $dt = explode('/', $dt);
                $jdt = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
            }
            $data['MachPurDate'] = $jdt;
            $data['MachCurrAmt'] = $this->form_validation->set_value('MachCurrAmt');
            $data['MachPurAmt'] = $this->form_validation->set_value('MachPurAmt');
            $data['MachBillNo'] = $this->form_validation->set_value('MachBillNo');
            $data['MachSerialNo'] = $this->form_validation->set_value('MachSerialNo');
            $data['MachRemarks'] = $this->form_validation->set_value('MachRemarks');
            
            $dt = $this->form_validation->set_value('MachWarrantyFrom');
            $jdt = '0000-00-00';
            if ($dt != '') {
                $dt = explode('/', $dt);
                $jdt = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
            }
            $data['MachWarrantyFrom'] = $jdt;
            
            $dt = $this->form_validation->set_value('MachWarrantyTo');
            $jdt = '0000-00-00';
            if ($dt != '') {
                $dt = explode('/', $dt);
                $jdt = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
            }
            $data['MachWarrantyTo'] = $jdt;
            
            
            //$data['MachStatus'] = $this->form_validation->set_value('MachStatus');
            $data['UpdDateTime'] = date('Y-m-d H:i:s');
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->machinemst->update($data, $MachID)) {
                $this->_show_message('Machine is edited successfully', 'success');
                redirect('machine');
            }
        } else {
            if ($this->input->post()) {
                $this->data['machine'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('frontend', $view, $this->data);
    }

    function delete($MachID = '') {
        if ($this->input->post('option')) {
            $MachIDs = $this->input->post('option');
            if ($this->machinemst->deleteAll($MachIDs)) {
                $this->_show_message("Machine deleted", 'success');
            }
        } else {
            if (!$MachID)
                show_404();
            if ($this->machinemst->delete($MachID)) {
                $this->_show_message("Machine deleted", 'success');
            }
        }
        redirect('machine');
    }

    function activate($MachID = '') {
        if (!$MachID)
            show_404();
        $editActivation = array();
        $editActivation['MachStatus'] = '1';
        if ($this->machinemst->update($editActivation, $MachID)) {
            $this->_show_message("Machine activated successfully", 'success');
            redirect('machine');
        }
    }

    function deactivate($MachID = '') {
        if (!$MachID)
            show_404();
        $editActivation = array();
        $editActivation['MachStatus'] = '0';
        if ($this->machinemst->update($editActivation, $MachID)) {
            $this->_show_message("Machine deactivated successfully", 'success');
            redirect('machine');
        }
    }

    function gettype() {
        $refCatID = $this->input->get('id');
        if ($refCatID > 0) {
            $type = $this->machinemst->getType($refCatID);
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

    function getmfg() {
        $refTypeID = $this->input->get('id');
        if ($refTypeID > 0) {
            $type = $this->machinemst->getMfg($refTypeID);
            $msg = '<option value="">--Select Machine Manufacturer--</option>';
            if (!empty($type)) {
                foreach ($type as $k => $v) {
                    $msg .= '<option value="' . $v->MfgID . '" >' . $v->MfgName . '</option> ';
                }
            }
            $data['res'] = 'success';
            $data['msg'] = $msg;
        } else {
            $data['res'] = 'success';
            $data['msg'] = '<option value="">--Select Machine Manufacturer--</option>';
        }
        echo json_encode($data);
        die;
    }

    function view($MachID) {
        if (!$MachID)
            show_404();

        $view = 'machine/partsview';
        $this->metas['title'] = array('Client | Machine & Parts | View');
        $data['machine'] = $this->machinemst->getMachineDetailsByID($MachID);
        $data['allmachineparts'] = $this->machinemst->getMachinePartsByMachID($MachID);

        $this->data['userRights'] = $this->check_rights();
        $this->display_view('frontend', $view, $data);
    }

    function addparts($MachID) {
        $view = 'machine/addparts';
        $this->metas['title'] = array('Client | Machine Parts | Add');
        $config = array(
//            array('field' => 'refMachID', 'label' => 'refMachID', 'rules' => 'required'),
            array('field' => 'refMachPartID', 'label' => 'refMachPartID', 'rules' => 'required'),
            array('field' => 'refMachSubPartID', 'label' => 'refMachSubPartID', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'SerialNo', 'label' => 'SerialNo', 'rules' => 'required|is_unique[cmpmachpartmst.SerialNo]'),
            //array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
            array('field' => 'refMfgID', 'label' => 'refMfgID', 'rules' => 'required'),
            array('field' => 'Remarks', 'label' => 'Remarks', 'rules' => 'trim|xss_clean|strip_tags'),
        );
        $this->data['MachID'] = $MachID;
        $this->form_validation->set_rules($config);
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        //$this->data['machine'] = $this->machinemst->getMachine();
        $this->data['part'] = $this->machinemst->getPart($MachID);
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCompID'] = $user_id;
            $data['refMachID'] = $MachID; //$this->form_validation->set_value('refMachID');
            $data['refMachPartID'] = $this->form_validation->set_value('refMachPartID');
            $data['refMachSubPartID'] = $this->form_validation->set_value('refMachSubPartID');
            $data['refMfgID'] = $this->form_validation->set_value('refMfgID');
            $data['SerialNo'] = $this->form_validation->set_value('SerialNo');
            $b_data = $this->_get_auto_id();
            $data['autoserialno'] = $b_data['barcode'];
            //$data['Status'] = $this->form_validation->set_value('Status');
            $data['Remarks'] = $this->form_validation->set_value('Remarks');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
//            echo '<pre>'; print_r($data); die;
            if ($this->machinemst->insertparts($data, $b_data['barcode_array'], $b_data['id'])) {
                $this->_show_message('Machine Part is added successfully', 'success');
                redirect('machine/view/' . $MachID);
            }
        } else {
            if ($this->input->post())
                $this->data['machineparts'] = (object) $this->input->post();
        }
        $this->display_view('frontend', $view, $data);
    }

    function editparts($MachID = '', $MachPartID = '') {
        if (!$MachID)
            show_404();

        if (!$MachPartID)
            show_404();
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'machine/addparts';
        $this->data['MachID'] = $MachID;
        $this->metas['title'] = array('Client | Machine Part | Edit');
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $this->data['machineparts'] = $this->machinemst->getMachinePartsByID($MachPartID,$user_id);
        //$this->data['machine'] = $this->machinemst->getMachine();
        $this->data['part'] = $this->machinemst->getPart($this->data['machineparts']->refMachID);
        $this->data['subpart'] = $this->machinemst->getSubPart($this->data['machineparts']->refMachPartID);
        $this->data['mfg'] = $this->machinemst->getMfgByPartsID($this->data['machineparts']->refMachPartID);
        if ($this->data['machineparts']->refMachSubPartID != '' || $this->data['machineparts']->refMachSubPartID == NULL) {
            $this->data['mfg'] = $this->machinemst->getMfgBySubPartsID($this->data['machineparts']->refMachSubPartID);
        }


        if ($this->input->post('SerialNo') != $this->data['machineparts']->SerialNo) {
            $is_unique1 = '|is_unique[cmpmachpartmst.SerialNo]';
        } else {
            $is_unique1 = '';
        }
        $config = array(
//            array('field' => 'refMachID', 'label' => 'refMachID', 'rules' => 'required'),
            array('field' => 'refMachPartID', 'label' => 'refMachPartID', 'rules' => 'required'),
            array('field' => 'refMachSubPartID', 'label' => 'refMachSubPartID', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'SerialNo', 'label' => 'SerialNo', 'rules' => 'required' . $is_unique1),
            //array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
            array('field' => 'refMfgID', 'label' => 'refMfgID', 'rules' => 'required'),
            array('field' => 'Remarks', 'label' => 'Remarks', 'rules' => 'trim|xss_clean|strip_tags'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $data = array();
//            $data['refMachID'] = $this->form_validation->set_value('refMachID');
            $data['refMachPartID'] = $this->form_validation->set_value('refMachPartID');
            $data['refMachSubPartID'] = $this->form_validation->set_value('refMachSubPartID');
            $data['refMfgID'] = $this->form_validation->set_value('refMfgID');
            $data['SerialNo'] = $this->form_validation->set_value('SerialNo');
            //$data['Status'] = $this->form_validation->set_value('Status');
            $data['Remarks'] = $this->form_validation->set_value('Remarks');
            $data['UpdDateTime'] = date('Y-m-d H:i:s');
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->machinemst->updateparts($data, $MachPartID)) {
                $this->_show_message('Machine Part is edited successfully', 'success');
                redirect('machine/view/' . $MachID);
            }
        } else {
            if ($this->input->post()) {
                $this->data['machineparts'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('frontend', $view, $this->data);
    }

    function deleteparts($MachID = '', $MachPartID = '') {
        if ($this->input->post('option')) {
            $MachPartIDs = $this->input->post('option');
            if ($this->machinemst->deleteAllparts($MachPartIDs)) {
                $this->_show_message("Machine Part deleted", 'success');
            }
        } else {
            if (!$MachID)
                show_404();
            if ($this->machinemst->deleteparts($MachPartID)) {
                $this->_show_message("Machine Part deleted", 'success');
            }
        }
        redirect('machine/view/' . $MachID);
    }

    function activateparts($MachID = '', $MachPartID = '') {
        if (!$MachID)
            show_404();
        if (!$MachPartID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '1';
        if ($this->machinemst->updateparts($editActivation, $MachPartID)) {
            $this->_show_message("Machine Part activated successfully", 'success');
            redirect('machine/view/' . $MachID);
        }
    }

    function deactivateparts($MachID = '', $MachPartID = '') {
        if (!$MachID)
            show_404();
        if (!$MachPartID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '0';
        if ($this->machinemst->updateparts($editActivation, $MachPartID)) {
            $this->_show_message("Machine Part deactivated successfully", 'success');
            redirect('machine/view/' . $MachID);
        }
    }

    function getpart() {
        $refMachID = $this->input->get('id');
        if ($refMachID > 0) {
            $type = $this->machinemst->getPart($refMachID);
            $msg = '<option value="">--Select Machine Parts--</option>';
            if (!empty($type)) {
                foreach ($type as $k => $v) {
                    $msg .= '<option value="' . $v->MachPartID . '" >' . $v->PartName . '</option> ';
                }
            }
            $data['res'] = 'success';
            $data['msg'] = $msg;
        } else {
            $data['res'] = 'success';
            $data['msg'] = '<option value="">--Select Machine Parts--</option>';
        }
        echo json_encode($data);
        die;
    }

    function getsubpart() {
        $refPartID = $this->input->get('id');
        if ($refPartID > 0) {
            $type = $this->machinemst->getSubPart($refPartID);
            $mfg = $this->machinemst->getMfgByPartsID($refPartID);
            $msg = '<option value="">--Select Machine SubPart--</option>';
            $msg1 = '<option value="">--Select Manufacturer--</option>';
            if (!empty($type)) {
                foreach ($type as $k => $v) {
                    $msg .= '<option value="' . $v->MachSubPartID . '" >' . $v->SubPartName . '</option> ';
                }
            }
            if (!empty($mfg)) {
                foreach ($mfg as $k => $v) {
                    $msg1 .= '<option value="' . $v->MfgID . '" >' . $v->MfgName . '</option> ';
                }
            }
            $data['res'] = 'success';
            $data['msg'] = $msg;
            $data['msg1'] = $msg1;
        } else {
            $data['res'] = 'success';
            $data['msg'] = '<option value="">--Select Machine SubPart--</option>';
            $data['msg1'] = '<option value="">--Select Manufacturer--</option>';
        }
        echo json_encode($data);
        die;
    }

    function getmfgbysubpartid() {
        $refSubPartID = $this->input->get('id');
        if ($refSubPartID > 0) {
            $mfg = $this->machinemst->getMfgBySubPartsID($refSubPartID);
            $msg1 = '<option value="">--Select Manufacturer--</option>';
            if (!empty($mfg)) {
                foreach ($mfg as $k => $v) {
                    $msg1 .= '<option value="' . $v->MfgID . '" >' . $v->MfgName . '</option> ';
                }
            }
            $data['res'] = 'success';
            $data['msg'] = $msg1;
        } else {
            $data['res'] = 'success';
            $data['msg'] = '<option value="">--Select Manufacturer--</option>';
        }
        echo json_encode($data);
        die;
    }

    function check($MachID = '') {
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $name = $this->input->get('MachCode');
        $category = $this->machinemst->check($name, $MachID,$user_id);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkfirst() {
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $name = $this->input->get('MachCode');
        $category = $this->machinemst->check($name, '',$user_id);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkserial($MachID = '') {
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $name = $this->input->get('MachSerialNo');
        $category = $this->machinemst->checkserial($name, $MachID,$user_id);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkserialfirst() {
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $name = $this->input->get('MachSerialNo');
        $category = $this->machinemst->checkserial($name, '',$user_id);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkserialparts($MachPartID = '') {
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $name = $this->input->get('SerialNo');
        $category = $this->machinemst->checkserialparts($name, $MachPartID,$user_id);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkserialpartsfirst() {
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $name = $this->input->get('SerialNo');
        $category = $this->machinemst->checkserialparts($name, '',$user_id);
        if (empty($category)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function info($MachID){
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        
        $mach = $this->machinemst->getMachineByID($MachID);
        $category = $this->machinemst->getCategory();
        $type = $this->machinemst->getType($mach->refCatID);
        $mfg = $this->machinemst->getMfg($mach->refTypeID);
        $location = $this->machinemst->getLocation($user_id);
        //echo '<pre>'; print_r($mach); die;
        echo '<p><b>Machine Code :</b> '.$mach->MachCode.'</p>';
        echo '<p><b>Machine Name :</b> '.$mach->MachName.'</p>';
        echo '<p><b>Machine Desc :</b> '.$mach->MachDesc.'</p>';
        echo '<p><b>Machine Purchase Date :</b> '.$mach->MachPurDate.'</p>';
        echo '<p><b>Machine Bill No :</b> '.$mach->MachBillNo.'</p>';
        echo '<p><b>Machine Serial No :</b> '.$mach->MachSerialNo.'</p>';
        echo '<p><b>Machine Warranty :</b> '.$mach->MachWarrantyFrom.' - '.$mach->MachWarrantyTo.'</p>';
        echo '<p><b>Machine Location :</b> ';
        foreach ($location as $key => $value) {
           if($value->LocID = $mach->refLocID){
               echo $value->Name;
           } 
        }
        echo '</p>';
        echo '<p><b>Machine Category :</b> ';
        foreach ($category as $key => $value) {
           if($value->CatID = $mach->refCatID){
               echo $value->CatName;
           } 
        }
        echo '</p>';
        echo '<p><b>Machine Type :</b> ';
        foreach ($type as $key => $value) {
           if($value->TypeID = $mach->refTypeID){
               echo $value->TypeName;
           } 
        }
        echo '</p>';
        echo '<p><b>Machine Mfg :</b> ';
        foreach ($mfg as $key => $value) {
           if($value->MfgID = $mach->refMfgID){
               echo $value->MfgName;
           } 
        }
        echo '</p>';
        die;
    }
}
