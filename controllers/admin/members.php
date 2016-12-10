<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Members extends MY_admin {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'members';
    }

    public function index() {

        $view = "user/view";
        $data['userRights'] = $this->check_rights();
        $data['allusers'] = User::find('all', array('order' => 'UpdDateTime desc'));
        $this->display_view('admin', $view, $data);
    }

    public function validation($info = "") {
        $config = array(
            array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'required'),
            array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email]'),
            array('field' => 'status', 'label' => 'Status', 'rules' => 'required'),
            array('field' => 'telephone', 'label' => 'Telephone', 'rules' => 'required'),
            array('field' => 'mobiles', 'label' => 'Mobile', 'rules' => 'integer'),
            array('field' => 'code', 'label' => 'code', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
        if ($info == 'edit') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if ($this->input->post('password') || $this->input->post('confirmpassword')) {
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
            }
        } else {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
        }
    }

    function select_validate($str) {
        if ($str == -1 || $str == 0 || $str == '') {
            $this->form_validation->set_message('select_validate', 'Please select Category');
            return FALSE;
        } else {
            return true;
        }
    }

    public function add() {

        $view = "user/add";

        $this->validation('add');
        if ($this->form_validation->run()) {
            $conn = User::connection();
            $conn->transaction();
            try {
                /*                 * *********************Insert Record into Users table********************************** */
                $this->load->library('tank_auth_admin');
                $adddata['firstname'] = $this->form_validation->set_value('firstname');
                $adddata['lastname'] = $this->form_validation->set_value('lastname');
                $adddata['email'] = $this->form_validation->set_value('email');
                $adddata['password'] = $this->tank_auth_admin->create_password($this->form_validation->set_value('password'));
                $adddata['activated'] = 1;
                $adddata['InsDatetime'] = date("Y-m-d h:i:s");
                $adddata['UpdDateTime'] = date("Y-m-d h:i:s");
                $users = new User($adddata);
                $users->save();
                /*                 * *********************Insert Record into Photo table********************************** */
//                if (isset($_FILES['userfile']) && !empty($_FILES['userfile']) && $_FILES['userfile']['error'] != '4') {
//                    $config['upload_path'] = ADMIN_UPLOAD_IMAGE_PATH;
//                    $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
//                    $config['max_size'] = '10000';
//                    $config['max_width'] = '1024';
//                    $config['max_height'] = '768';
//                    $this->load->library('upload', $config);
//                    if (!$this->upload->do_upload('userfile')) {
//                        $error = $this->upload->display_errors();
//                        $this->_show_message($error, "error");
//                    } else {
//                        $data = $this->upload->data();
//                        $photo = new Photo($data);
//                        $photo->save();
//                        $addprofile['photo_id'] = $photo->id;
//                    }
//                } else {
//                    $addprofile['photo_id'] = '';
//                }

                /*                 * *********************Insert Record into Userprofile table**************************** */
                $addprofile['user_id'] = $users->id;
                $addprofile['code'] = $this->input->post('code');
                $addprofile['aboutme'] = $this->input->post('aboutme');
                $addprofile['telephone'] = $this->input->post('telephone');
                $addprofile['mobile'] = $this->input->post('mobiles');
                $addprofile['InsDatetime'] = date('Y-m-d h:i:s');
                $addprofile['UpdDateTime'] = date('Y-m-d h:i:s');
                $userprofile = new Userprofile($addprofile);
                $userprofile->save();

                $new = array();
                $new['refCompID'] = $users->id;
                $new['F1SrMode'] = 'manual';
                $new['F1SrType'] = NULL;
                $new['F1SrTypeMode'] = NULL;
                $new['F1SrValue'] = $this->input->post('code');
                $new['F1SrValLength'] = '0';
                $new['F2SrMode'] = 'manual';
                $new['F2SrType'] = NULL;
                $new['F2SrTypeMode'] = NULL;
                $new['F2SrValue'] = '-';
                $new['F2SrValLength'] = '0';
                $new['F3SrMode'] = 'auto';
                $new['F3SrType'] = 'Date';
                $new['F3SrTypeMode'] = 'ddmmyy';
                $new['F3SrValue'] = '';
                $new['F3SrValLength'] = '0';
                $new['F4SrMode'] = 'auto';
                $new['F4SrType'] = 'Number';
                $new['F4SrTypeMode'] = '*';
                $new['F4SrValue'] = '1';
                $new['F4SrValLength'] = '6';
                $new['F5SrMode'] = NULL;
                $new['F5SrType'] = NULL;
                $new['F5SrTypeMode'] = NULL;
                $new['F5SrValue'] = '';
                $new['F5SrValLength'] = '0';
                $new['F6SrMode'] = NULL;
                $new['F6SrType'] = NULL;
                $new['F6SrTypeMode'] = NULL;
                $new['F6SrValue'] = '';
                $new['F6SrValLength'] = '0';
                $new['F7SrMode'] = NULL;
                $new['F7SrType'] = NULL;
                $new['F7SrTypeMode'] = NULL;
                $new['F7SrValue'] = '';
                $new['F7SrValLength'] = '0';
                $new['RevDate'] = date('Y-m-d H:i:s');
                $new['InsTerminal'] = '127.0.0.1';
                $new['InsDateTime'] = date('Y-m-d H:i:s');
                $new['UpdTerminal'] = '127.0.0.1';
                $new['UpdDateTime'] = date('Y-m-d H:i:s');
                $this->load->model('barcodemst_m');
                $this->barcodemst_m->insert_erpsrn($new);

                $conn->commit();
                $email = $users->email;
                $data['email'] = $users->email;
                $data['subject'] = 'User Profile Created';
                $data['password'] = $this->form_validation->set_value('password');
                $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;
                $this->_send_email("admin-activate", $email, $data);
                $this->_show_message("User added successfully", "success");
                redirect('admin/members/list');
            } catch (Exception $e) {
                $this->write_logs($e);
                $conn->rollback();
            }
        } else {
            if ($this->input->post())
                $this->data['postdata'] = (object) $this->input->post();
        }
        $data['postdata'] = (object) $this->input->post();
        $this->display_view("admin", $view, $data);
    }

    public function edit($id = "") {
        $view = "user/edit";
        $data['editdata'] = User::find($id);
        $this->validation('edit');

        if ($this->form_validation->run()) {
            $conn = User::connection();
            $conn->transaction();
            try {
                if (isset($id)) {
                    $Editdata['firstname'] = $this->form_validation->set_value('firstname');
                    $Editdata['lastname'] = $this->form_validation->set_value('lastname');
                    $Editdata['email'] = $this->form_validation->set_value('email');
                    if ($this->input->post('password')) {
                        $this->load->library('tank_auth_admin');
                        $Editdata['password'] = $this->tank_auth_admin->create_password($this->form_validation->set_value('password'));
                    }
                    $Editdata['activated'] = 1;
                    $Editdata['UpdDateTime'] = date("Y-m-d h:i:s");
                    $Editusers = User::find($id);
                    $Editusers->update_attributes($Editdata);

                    $Editprof = Userprofile::find_by_user_id($id);
//                    if (isset($_FILES['userfile']) && !empty($_FILES['userfile']) && $_FILES['userfile']['error'] != '4') {
//                        $config['upload_path'] = ADMIN_UPLOAD_IMAGE_PATH;
//                        $config['max_size'] = '10000';
//                        $config['max_height'] = '768';
//                        $config['max_width'] = '1024';
//                        $config['allowed_types'] = 'jpg|jpeg|png|bmp|gif';
//
//                        $this->load->library('upload', $config);
//                        if (!$this->upload->do_upload('userfile')) {
//                            $error = $this->upload->display_errors();
//                            $this->_show_message($error, "error");
//                        } else {
//                            $editdata = $this->upload->data();
//                            unset($editdata['is_image']);
//                            $userprofile = Userprofile::find_by_user_id($id);
//                            $photo_id = $userprofile->photo_id;
//                            if (isset($photo_id) && $photo_id != '') {
//                                $photo = Photo::find($photo_id);
//                                if (isset($photo->file_name) && !empty($photo->file_name)) {
//                                    $this->load->helper('file');
//                                    $path = ADMIN_UPLOAD_IMAGE_PATH . '/' . $photo->file_name;
////                                    echo '<pre>';print_r($path);exit;
//                                    @unlink($path);
//                                }
//                                $update_photo = Photo::find($photo_id);
//                                $update_photo->update_attributes($editdata);
//                                $update_photo_id = $update_photo->id;
//                                $Editprof->photo_id = $update_photo_id;
//                            } else {
//                                $photo = new Photo($editdata);
//                                $photo->save();
//                                $auto_id = $photo->id;
//                                $Editprof->photo_id = $auto_id;
//                            }
//                        }
//                    }
                    $Editprof->user_id = isset($Editusers->id) ? $Editusers->id : $Editprof->user_id;
                    $Editprof->aboutme = $this->input->post('aboutme');
                    $Editprof->code = $this->input->post('code');
                    $Editprof->telephone = $this->input->post('telephone');
                    $Editprof->mobile = $this->input->post('mobiles');
                    $Editprof->upddatetime = date("Y-m-d h:i:s");
                    $Editprof->save();
                    $conn->commit();
                    $this->_show_message("User updated Successfully", "success");
                    redirect('admin/members/list');
                }
            } catch (Exception $e) {
                $this->write_logs($e);
            }
        } else {
            if ($this->input->post()) {
                $data['postdata'] = (object) $this->input->post();
            }
        }
        $data['postdata'] = (object) $this->input->post();
        $this->display_view("admin", $view, $data);
    }

    function delete($id = '') {

        if ($this->input->post('option')) {
            $ids = $this->input->post('option');

            $deleteObj = User::find('all', array('conditions' => array('id in (?)', $ids)));
            foreach ($deleteObj as $obj) {
                $obj->delete();
            }
            $this->load->model('members_m');
            $this->members_m->deleteMembersData($ids);
            $this->_show_message("User deleted", 'success');
        } else {
            if (!$id)
                show_404();
            $deleteObj = User::find($id);
            $userprofile = Userprofile::find_by_user_id($id);
            $deleteObj->delete();
            $this->members_m->deleteMemberData($id);
            $this->_show_message("User deleted", 'success');
        }
        redirect('admin/members/list');
    }

    function activate($id = '') {
        if (!$id)
            show_404();

        $editArticle = User::find_by_id($id);
        $editArticle->activated = '1';
        $editArticle->save();
        $this->_show_message("User activated successfully", 'success');
        redirect('admin/members/list');
    }

    function deactivate($id = '') {
        if (!$id)
            show_404();
        $editArticle = User::find_by_id($id);
        $editArticle->activated = '0';
        $editArticle->save();
        $this->_show_message("User deactivated successfully", 'success');
        redirect('admin/members/list');
    }

    function details($id = '') {
        if (!$id)
            show_404();

        $view = "user/details";
        $this->load->model('machinemst');
        $this->data['machine'] = $this->machinemst->getMachineByCompID($id);
        $data['title'] = 'Client Machine View';
        $this->display_view("admin", $view, $data);
    }

    function pdf($MachID) {
        $this->load->model('machinemst');
        $machine = $this->machinemst->getMachineByID($MachID);
        $parts = $this->machinemst->getMachinePartsByMachID($MachID);
//        echo '<pre>';
//        print_r($machine);
//        print_r($parts);
//        die;
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(SITE_NAME);
        $pdf->SetTitle('Barcode');
        $pdf->SetSubject('Barcode');
        $pdf->SetKeywords('barcode, print, pdf');
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);

        $pdf->setHeaderData('', 0, '', '', array(255, 255, 255), array(255, 255, 255));

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'ltr';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
// set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);
        $pdf->SetFont('helvetica', '', 11);
        $pdf->startPageGroup();
        $pdf->setRTL(false);
        $pdf->AddPage();

// print a message
        $txt = "Here Is The List OF Machine And Their Respective Parts And Subparts";
        $pdf->MultiCell(70, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
        $pdf->SetY(30);

        $pdf->SetFont('helvetica', '', 10);

// define barcode style
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );

// PRINT VARIOUS 1D BARCODES
// CODE 128 AUTO
        if (!empty($machine)) {
            $str = 'Machine : ' . $machine->MachCode . ' - ' . $machine->MachName;
            $pdf->Cell(0, 0, $str, 0, 1);
            $pdf->write1DBarcode($machine->autoserialno, 'C128', '', '', '', 18, 0.4, $style, 'N');

            $pdf->Ln();

            if (!empty($parts)) {
                foreach ($parts as $k => $v) {
                    if ($v->PartName != '' && $v->SubPartName == '')
                        $str = 'Part Name : ' . $v->PartName;

                    if ($v->PartName != '' && $v->SubPartName != '')
                        $str = 'Subpart Name : ' . $v->SubPartName;

                    $pdf->Cell(0, 0, $str, 0, 1);
                    $pdf->write1DBarcode($v->autoserialno, 'C128', '', '', '', 18, 0.4, $style, 'N');

                    $pdf->Ln();
                }
            }
        }
// . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
        $date = date("Y_m_d H_i_s");
        //$pdfName = 'uploads/' . str_replace(' ', '', $date) . '.pdf';
        $pdfName = str_replace(' ', '', $date) . '.pdf';
        $pdf->Output($pdfName, 'D'); //D,F
        echo $pdfName;
        die;
    }
    
    function machineactivate($MachID = '') {
        if (!$MachID)
            show_404();
        
        $this->load->model('machinemst');
        $editActivation = array();
        $editActivation['MachStatus'] = '1';
        if($this->machinemst->checkparts($MachID)){
            if ($this->machinemst->update($editActivation, $MachID)) {
                $this->_show_message("Machine activated successfully", 'success');
            }else{
                $this->_show_message("Database Out Of Service, Try Later", 'error');
            }
        }else{
            $this->_show_message("Machine Have No Parts, Try After Parts Added", 'error');
        }
        $this->load->library('user_agent');
        redirect($this->agent->referrer());
    }
    
    function machinedeactivate($MachID = '') {
        if (!$MachID)
            show_404();
        
        $this->load->model('machinemst');
        $editActivation = array();
        $editActivation['MachStatus'] = '0';
        if ($this->machinemst->update($editActivation, $MachID)) {
            $this->_show_message("Machine deactivated successfully", 'success');
            $this->load->library('user_agent');
            redirect($this->agent->referrer());
        }
    }

}

?>
