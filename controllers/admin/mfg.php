<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Mfg
 * ----For Machine Mfg
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Mfg extends MY_admin {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'mfg';
        $this->load->model('mfgmst');
    }

    /**
     * function index
     * @descp Used to list all admin mfg
     * @where view page datatable list in admin/mfgs/view (view folder)
     * */
    public function index($MfgID = '') {
        /*
         * @var view : view MfgName
         * @title :title of page
         */
        $view = 'mfg/view';
        $this->metas['title'] = array('Admin | Mfg List');
        $data['allmfg'] = $this->mfgmst->getMfg();
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('admin', $view, $data);
    }

    public function add() {
        /*
         * @var view : view MfgName
         * @title :title of page
         */
        $view = 'mfg/add';
        $this->metas['title'] = array('Admin | Mfg | Add');
//        $where = array('conditions' => array('MfgID != ?', 1));
//        $data['admingp'] = Mfgmst::find_assoc($where);
        $config = array(
            array('field' => 'MfgName', 'label' => 'MfgName', 'rules' => 'required|is_unique[mfgmst.MfgName]'),
            array('field' => 'MfgAddr1', 'label' => 'MfgAddr1', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgAddr2', 'label' => 'MfgAddr2', 'rules' => 'xss_clean|trim'),
            array('field' => 'MfgCity', 'label' => 'MfgCity', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgState', 'label' => 'MfgState', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgCountry', 'label' => 'MfgCountry', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgPincode', 'label' => 'MfgPincode', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgContactPerson1', 'label' => 'MfgContactPerson1', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgContactNumber1', 'label' => 'MfgContactNumber1', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgContactPerson2', 'label' => 'MfgContactPerson2', 'rules' => 'xss_clean|trim'),
            array('field' => 'MfgContactNumber2', 'label' => 'MfgContactNumber2', 'rules' => 'xss_clean|trim'),
            array('field' => 'MfgEmail', 'label' => 'MfgEmail', 'rules' => 'required|xss_clean|trim|is_unique[mfgmst.MfgEmail]'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
            array('field' => 'IsPartsMfg', 'label' => 'IsPartsMfg', 'rules' => 'xss_clean|trim'),
        );
        $this->form_validation->set_rules($config);
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['MfgName'] = $this->form_validation->set_value('MfgName');
            $data['MfgAddr1'] = $this->form_validation->set_value('MfgAddr1');
            $data['MfgAddr2'] = $this->form_validation->set_value('MfgAddr2');
            $data['MfgCity'] = $this->form_validation->set_value('MfgCity');
            $data['MfgState'] = $this->form_validation->set_value('MfgState');
            $data['MfgCountry'] = $this->form_validation->set_value('MfgCountry');
            $data['MfgPincode'] = $this->form_validation->set_value('MfgPincode');
            $data['MfgContactPerson1'] = $this->form_validation->set_value('MfgContactPerson1');
            $data['MfgContactNumber1'] = $this->form_validation->set_value('MfgContactNumber1');
            $data['MfgContactPerson2'] = $this->form_validation->set_value('MfgContactPerson2');
            $data['MfgContactNumber2'] = $this->form_validation->set_value('MfgContactNumber2');
            $data['MfgEmail'] = $this->form_validation->set_value('MfgEmail');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['IsPartsMfg'] = $this->form_validation->set_value('IsPartsMfg');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->mfgmst->insert($data)) {
                $this->_show_message('Mfg is added successfully', 'success');
                redirect('admin/mfg');
            }
        } else {
            if ($this->input->post())
                $this->data['mfg'] = (object) $this->input->post();
        }
        $this->display_view('admin', $view, $data);
    }

    function edit($MfgID = '') {
        if (!$MfgID)
            show_404();
        /*
         * @var view : view MfgName
         * @title :title of page
         */
        $view = 'mfg/add';
        $this->metas['title'] = array('Admin | Mfg | Edit');
        $this->data['mfg'] = $this->mfgmst->getMfgByID($MfgID);
        if ($this->input->post('MfgName') != $this->data['mfg']->MfgName) {
            $is_unique = '|is_unique[mfgmst.MfgName]';
        } else {
            $is_unique = '';
        }
        if ($this->input->post('MfgEmail') != $this->data['mfg']->MfgEmail) {
            $is_unique1 = '|is_unique[mfgmst.MfgEmail]';
        } else {
            $is_unique1 = '';
        }

        $config = array(
            array('field' => 'MfgName', 'label' => 'MfgName', 'rules' => 'required' . $is_unique),
            array('field' => 'MfgAddr1', 'label' => 'MfgAddr1', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgAddr2', 'label' => 'MfgAddr2', 'rules' => 'xss_clean|trim'),
            array('field' => 'MfgCity', 'label' => 'MfgCity', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgState', 'label' => 'MfgState', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgCountry', 'label' => 'MfgCountry', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgPincode', 'label' => 'MfgPincode', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgContactPerson1', 'label' => 'MfgContactPerson1', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgContactNumber1', 'label' => 'MfgContactNumber1', 'rules' => 'required|xss_clean|trim'),
            array('field' => 'MfgContactPerson2', 'label' => 'MfgContactPerson2', 'rules' => 'xss_clean|trim'),
            array('field' => 'MfgContactNumber2', 'label' => 'MfgContactNumber2', 'rules' => 'xss_clean|trim'),
            array('field' => 'MfgEmail', 'label' => 'MfgEmail', 'rules' => 'required|xss_clean|trim'.$is_unique1),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
            array('field' => 'IsPartsMfg', 'label' => 'IsPartsMfg', 'rules' => 'xss_clean|trim'),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $data = array();
            $data['MfgName'] = $this->form_validation->set_value('MfgName');
            $data['MfgAddr1'] = $this->form_validation->set_value('MfgAddr1');
            $data['MfgAddr2'] = $this->form_validation->set_value('MfgAddr2');
            $data['MfgCity'] = $this->form_validation->set_value('MfgCity');
            $data['MfgState'] = $this->form_validation->set_value('MfgState');
            $data['MfgCountry'] = $this->form_validation->set_value('MfgCountry');
            $data['MfgPincode'] = $this->form_validation->set_value('MfgPincode');
            $data['MfgContactPerson1'] = $this->form_validation->set_value('MfgContactPerson1');
            $data['MfgContactNumber1'] = $this->form_validation->set_value('MfgContactNumber1');
            $data['MfgContactPerson2'] = $this->form_validation->set_value('MfgContactPerson2');
            $data['MfgContactNumber2'] = $this->form_validation->set_value('MfgContactNumber2');
            $data['MfgEmail'] = $this->form_validation->set_value('MfgEmail');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['IsPartsMfg'] = $this->form_validation->set_value('IsPartsMfg');
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->mfgmst->update($data, $MfgID)) {
                $this->_show_message('Mfg is edited successfully', 'success');
                redirect('admin/mfg');
            }
        } else {
            if ($this->input->post()) {
                $this->data['mfg'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('admin', $view, $this->data);
    }

    function delete($MfgID = '') {
        if ($this->input->post('option')) {
            $MfgIDs = $this->input->post('option');
            if ($this->mfgmst->deleteAll($MfgIDs)) {
                $this->_show_message("Mfg deleted", 'success');
            }
        } else {
            if (!$MfgID)
                show_404();
            if ($this->mfgmst->delete($MfgID)) {
                $this->_show_message("Mfg deleted", 'success');
            }
        }
        redirect('admin/mfg');
    }

    function activate($MfgID = '') {
        if (!$MfgID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '1';
        if ($this->mfgmst->update($editActivation, $MfgID)) {
            $this->_show_message("Mfg activated successfully", 'success');
            redirect('admin/mfg');
        }
    }

    function deactivate($MfgID = '') {
        if (!$MfgID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '0';
        if ($this->mfgmst->update($editActivation, $MfgID)) {
            $this->_show_message("Mfg deactivated successfully", 'success');
            redirect('admin/mfg');
        }
    }

    function check($MfgID = '') {
        $name = $this->input->get('MfgName');
        $mfg = $this->mfgmst->check($name, $MfgID);
        if (empty($mfg)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

    function checkfirst() {
        $name = $this->input->get('MfgName');
        $mfg = $this->mfgmst->check($name, '');
        if (empty($mfg)) {
            echo 'true';
        } else {
            echo 'false';
        }
        die;
    }

}
