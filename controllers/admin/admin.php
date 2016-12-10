<?php

/*
 * -----------------------------
 * ----Author shafiq
 * ----Class Admin
 * ----For admin user
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Admin extends MY_admin {
    /*
     * ------Contructor------
     * load library for tank auth admin 
     * used for the authanticating the 
     * validate user
     */

    function __construct() {
        parent::__construct();
        $this->load->library('tank_auth_admin');
        $this->data['menuaction'] = 'admin';
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
        $view = 'adminusers/view';
        $this->metas['title'] = array('Admin | List');
        /*
         * if user is super admin list all admin
         * if user is admin list only its lower level admin
         * currently showing all user to except super admin
         * 
         */
        if ($this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == 1) {
            $data['allAdminuser'] = Adminuser::find('all', array('include' => 'admingroup'));
        } else if ($this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == 2) {
            $data['allAdminuser'] = Adminuser::find('all', array('conditions' => array('admingroup_id != ?', 1), 'include' => array('admingroup')));
        } else {
            $data['allAdminuser'] = Adminuser::find('all', array('conditions' => array('admingroup_id != ?', 1), 'include' => array('admingroup')));
        }
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('admin', $view, $data);
    }

    function create_user($createdata) {
        $password = $this->tank_auth_admin->create_password($createdata['password']);
        unset($createdata['modified']);
        $createdata['updated'] = databasedate();
        $createdata['password'] = $password;
        $createdata['last_ip'] = $this->input->ip_address();
        return $createdata;
    }

    function add() {
        /*
         * @var view : view name
         * @title :title of page
         */
        $view = 'adminusers/add';
        $this->metas['title'] = array('Admin | add');
        $this->data['adminusers'] = new Adminuser();
        //$this->scripts['js'] = array();
        //$this->scripts['css'] = array();
        if ($this->input->post()) {
            $config = array(
                array('field' => 'admingroup_id', 'label' => 'Group', 'rules' => 'required|xss_clean|trim|callback_select_validate'),
                array('field' => 'password', 'label' => 'Password', 'rules' => 'required|xss_clean|trim'),
                array('field' => 'Cpassword', 'label' => 'Confirm Password', 'rules' => 'required||xss_clean|trim|matches[password]'),
                array('field' => 'username', 'label' => 'Name', 'rules' => 'required|xss_clean|trim'),
                array('field' => 'activated', 'label' => 'Status', 'rules' => 'required|xss_clean|trim|callback_status_validate'),
                array('field' => 'contact_number', 'label' => 'Contact Number', 'rules' => 'required|xss_clean|trim'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required|valid_email|callback_select_email|xss_clean|trim'),
            );
            $this->form_validation->set_rules($config);

            /*
             * This flag is use for the upload error
             * if flag is false then upload has some error 
             * need to show them on page
             * 
             */
            $flag = TRUE;
            if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
                $config['upload_path'] = ADMIN_UPLOAD_IMAGE_PATH;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = ADMIN_MAX_UPLOAD_SIZE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('photo')) {
                    $error = array('errorUpload' => $this->upload->display_errors());
                    $flag = FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config ['new_image'] = ADMIN_UPLOAD_IMAGE_PATH . '/thumb';
                    $config['source_image'] = ADMIN_UPLOAD_IMAGE_PATH . '/' . $upload_data['raw_name'] . $upload_data['file_ext'];
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['thumb_marker'] = '';
                    $config['width'] = 27;
                    $config['height'] = 27;
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        $error = array('errorResize' => $this->image_lib->display_errors());
                        $flag = FALSE;
                    }
                }
            }
            if ($this->form_validation->run() && $flag) {
                $createdata = array(
                    'admingroup_id' => $this->form_validation->set_value('admingroup_id'),
                    'username' => $this->form_validation->set_value('username'),
                    'password' => $this->form_validation->set_value('password'),
                    'email' => $this->form_validation->set_value('email'),
                    'activated' => $this->form_validation->set_value('activated'),
                    'banned' => '0',
                    'created' => databasedate(),
                    'modified' => databasedate(),
                    'contact_number' => $this->form_validation->set_value('contact_number'),
                    'image_path' => ADMIN_UPLOAD_IMAGE_PATH
                );
                if (isset($upload_data['raw_name']) && !empty($upload_data['raw_name'])) {
                    $createdata['image_name'] = $upload_data['raw_name'] . $upload_data['file_ext'];
                }
                $conn = Adminuser::connection();
                $conn->transaction();
                if ($createData = $this->create_user($createdata)) {
                    try {
                        $redata = new Adminuser($createData);
                        $redata->save();
                        $this->input->post('rights') ? $this->update_insert_rights($redata->id, $this->input->post('rights')) : '';
                        $this->landingpage($redata->id);
                        $this->_show_message('Admin record is added successfully', 'success');
                        $conn->commit();
                        if ($this->check_rights(READ_MODULE)) {
                            redirect('admin/admin/list');
                        } else {
                            redirect('admin/admin/add');
                        }
                    } catch (Exception $e) {
                        $conn->rollback();
                        $this->write_logs($e);
                        // redirect('admin/admin/add');
                    }
                } else {
                    if ($this->input->post()) {
                        $this->data['adminusers'] = (object) $this->input->post();
                        $this->_show_message('Oops ! error while from submiting', 'error');
                    }
                    if (isset($error) && !empty($error)) {
                        $this->data['uploadError'] = '';
                        foreach ($error as $k => $v) {
                            $this->data['uploadError'] .= $v . ' ';
                        }
                    }
                }
            }
            if ($this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == 1) {
                $params = array('conditions' => array('status = ?', 1));
            } else if ($this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == 2) {
                $params = array('conditions' => array('status = ? and id != ?', 1, 1));
            } else {
                $params = array('conditions' => array('status = ? and id != ?', 1, 1));
            }
            $data['admingp'] = Admingroup::find_assoc($params);
            $paramsModule = array('conditions' => array('status = ?', 1));
            $data['allmodules'] = Module::find_assoc($paramsModule, FALSE);
            $data['postdata'] = (object) $this->input->post();
            $this->display_view('admin', $view, $data);
        } else {
            if ($this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == 1) {
                $params = array('conditions' => array('status = ?', 1));
            } else if ($this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == 2) {
                $params = array('conditions' => array('status = ? and id != ?', 1, 1));
            } else {
                $params = array('conditions' => array('status = ? and id != ?', 1, 1));
            }
            $data['admingp'] = Admingroup::find_assoc($params);
            $paramsModule = array('conditions' => array('status = ?', 1));
            $data['allmodules'] = Module::find_assoc($paramsModule, FALSE);
            $data['postdata'] = (object) $this->input->post();
            $this->display_view('admin', $view, $data);
        }
    }

    function edit($id = '') {
        if (!$id)
            show_404();
        $view = 'adminusers/add';
        $pagetitle = 'Edit';

        if ($this->input->post()) {

            $config = array(
                array('field' => 'admingroup_id', 'label' => 'Group', 'rules' => 'required|xss_clean|trim|callback_select_validate'),
                array('field' => 'username', 'label' => 'Name', 'rules' => 'required|xss_clean|trim'),
                array('field' => 'activated', 'label' => 'Status', 'rules' => 'required|xss_clean|trim|callback_status_validate'),
                array('field' => 'contact_number', 'label' => 'Contact Number', 'rules' => 'required|xss_clean|trim'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required|valid_email|xss_clean|trim'),
            );
            if ($this->input->post('password') || $this->input->post('Cpassword')) {
                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('Cpassword', 'Confirm Password', 'required|matches[password]');
            }

            $this->form_validation->set_rules($config);
            /*
             * This flag is use for the upload error
             * if flag is false then upload has some error 
             * need to show them on page
             * 
             */
            $flag = TRUE;
            if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
                $config['upload_path'] = ADMIN_UPLOAD_IMAGE_PATH;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = ADMIN_MAX_UPLOAD_SIZE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('photo')) {
                    $error = array('errorUpload' => $this->upload->display_errors());
                    $flag = FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $adminuser = Adminuser::find($id);
                    if ($adminuser->image_name) {
                        $this->load->helper('file');
                        $path = ADMIN_UPLOAD_IMAGE_PATH . '/' . $adminuser->image_name;
                        @unlink($path);
                    }
                    $config['image_library'] = 'gd2';
                    $config ['new_image'] = ADMIN_UPLOAD_IMAGE_PATH . '/thumb';
                    $config['source_image'] = ADMIN_UPLOAD_IMAGE_PATH . '/' . $upload_data['raw_name'] . $upload_data['file_ext'];
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['thumb_marker'] = '';
                    $config['width'] = 27;
                    $config['height'] = 27;
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        $error = array('errorResize' => $this->image_lib->display_errors());
                        $flag = FALSE;
                    }
                }
            }
            if ($this->form_validation->run() && $flag) {
                $conn = Adminuser::connection();
                $conn->transaction();
                try {
                    $editUser = adminuser::find($id);
                    $editUser->admingroup_id = $this->form_validation->set_value('admingroup_id');
                    $editUser->username = $this->form_validation->set_value('username');
                    $editUser->contact_number = $this->form_validation->set_value('contact_number');
                    $editUser->activated = $this->form_validation->set_value('activated');
                    $editUser->banned = 0;
                    $editUser->email = $this->form_validation->set_value('email');
                    $editUser->image_path = ADMIN_UPLOAD_IMAGE_PATH;
                    $editUser->updated = date('Y-m-d:h:i:s');
                    if ($this->input->post('password') && $this->input->post('Cpassword')) {
                        $editUser->password = $this->tank_auth_admin->create_password($this->form_validation->set_value('password'));
                    }
                    if (isset($upload_data['raw_name']) && !empty($upload_data['raw_name']))
                        $editUser->image_name = $upload_data['raw_name'] . $upload_data['file_ext'];
                    $editUser->save();
                    $this->update_insert_rights($id, $this->input->post('rights'));
                    $this->landingpage($id);
//                    if ($this->input->post('rights')) {
//                        $this->update_insert_rights($id, $this->input->post('rights'));
//                        $this->landingpage($id);
//                    }
                    $conn->commit();
                    $this->_show_message('User is Updated successfully', 'success');
                    redirect('admin/admin/list');
                } catch (Exception $e) {
                    $conn->rollback();
                    $this->write_logs($e);
                }
            } else {
                if (isset($error) && !empty($error)) {
                    $this->data['uploadError'] = '';
                    foreach ($error as $k => $v) {
                        $this->data['uploadError'] .= $v . ' ';
                    }
                } else if (isset($upload_data) && !empty($upload_data)) {
                    
                }
                $this->_show_message('Oops ! error while from submiting', 'error');
            }
        }
        $data['adminusers'] = Adminuser::find_by_id($id);
//        $paramsModule = array('conditions' => array('status = ?', 1));
//        $data['allmodules'] = Module::find_assoc($paramsModule, FALSE);
//        
        if ($data['adminusers']->landingpage) {
            $data['landingPage'] = $data['adminusers']->landingpage->module_id;
        } else {
            $data['landingPage'] = 1;
        }
        $paramsModule = array('conditions' => array('status = ?', 1));
        $data['allmodules'] = Module::find_assoc($paramsModule, FALSE);


        if ($this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == 1 && $this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == $id) {
            $params = array('conditions' => array('status = ? and id = ?', 1, 1));
        } else if ($this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == 1 && $this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] != $id) {
            $params = array('conditions' => array('status = ? ', 1));
        } else if ($this->session->userdata[SITE_NAME . '_admin_user_data']['admingroup'] == 2) {
            $params = array('conditions' => array('status = ? and id != ?', 1, 1));
        } else {
            $params = array('conditions' => array('status = ? and id != ?', 1, 1));
        }
        $data['admingp'] = Admingroup::find_assoc($params);
        $data['postdata'] = (object) $this->input->post();
        $this->display_view('admin', $view, $data);
    }

    function landingpage($user_id) {
        if ($this->input->post('landing') && $this->input->post('rights')) {
            /*
             * First check for landing page already in databse
             */
            $landing = Landingpage::find('first', array('conditions' => array('adminuser_id  = ?', $user_id)));
            if ($landing) {
                $landing->module_id = $this->input->post('landing');
                $landing->modified = databasedate();
                $landing->save();
            } else {
                $landing = new Landingpage();
                $landing->adminuser_id = $user_id;
                $landing->module_id = $this->input->post('landing');
                $landing->created = databasedate();
                $landing->modified = databasedate();
                $landing->save();
            }
        } else {
            /*
             * First find old if any then update else insert new
             */
            $landingpage = Landingpage::find('first', array('conditions' => array('adminuser_id = ?', $user_id)));
            if ($landingpage) {
                $landingpage->module_id = MYACCOUNT;
                $landingpage->modified = databasedate();
                $landingpage->save();
            } else {
                $landing = new Landingpage();
                $landing->adminuser_id = $user_id;
                $landing->module_id = MYACCOUNT;
                $landing->created = databasedate();
                $landing->modified = databasedate();
                $landing->save();
            }
        }
    }

    function insert_myaccount_rights($user_id) {
        $rightsObj = new Adminright();
        $rightsObj->right = 127;//FULLRIGHTS;
        $rightsObj->module_id = MYACCOUNT;
        $rightsObj->adminuser_id = $user_id;
        $rightsObj->created = date("Y-m-d H:i:s");
        $rightsObj->modified = date("Y-m-d H:i:s");
        $rightsObj->save();
    }

    function update_insert_rights($user_id, $rightsArray) {
        $adminRightsObj = Adminright::find('all', array('conditions' => array('adminuser_id = ? ', $user_id)));
        if ($adminRightsObj) {
            foreach ($adminRightsObj as $rightkey => $rightvlaue) {
                $rightvlaue->delete();
            }
        }
        if ($rightsArray) {
            foreach ($rightsArray as $k => $v) {
                $value = 0;
                if (key_exists('read', $v)) {
                    $value += READ_MODULE;
                }
                if (key_exists('add', $v)) {
                    $value += ADD_MODULE;
                }
                if (key_exists('edit', $v)) {
                    $value += EDIT_MODULE;
                }
                if (key_exists('delete', $v)) {
                    $value += DELETE_MODULE;
                }
                if (key_exists('other', $v)) {
                    /*
                     * 6 for products will add copy product
                     * 17 for newsletter will add send mail
                     * 18 and 20 for download product
                     */
                    if ($k == '2') {
                        $value += COPY_PRODUCT_MODULE;
                    } else
                    if ($k == '6') {
                        $value += COPY_PRODUCT_MODULE;
                    } else if ($k == '18') {
                        $value += SEND_EMAIL_MODULE;
                    } else if ($k == '20') {
                        $value += DOWNLOAD_MODULE;
                    } else if ($k == '22') {
                        $value += DOWNLOAD_MODULE;
                    }
                }
                $rightsObj = new Adminright();
                $result = $rightsObj->find(array('conditions' => array('adminuser_id = ? and module_id = ? ', $user_id, $k)));
                if (isset($result->right) && !empty($result->right)) {
                    $result->right = $value;
                    $result->save();
                } else {
                    $rightsObj->right = $value;
                    $rightsObj->module_id = $k;
                    $rightsObj->adminuser_id = $user_id;
                    $rightsObj->created = date("Y-m-d H:i:s");
                    $rightsObj->modified = date("Y-m-d H:i:s");
                    $rightsObj->save();
                }
            }
        }
        $this->insert_myaccount_rights($user_id);
    }

    function delete($id = '') {
        if ($this->input->post('option')) {
            $ids = $this->input->post('option');
            $deleteObj = Adminuser::find('all', array('conditions' => array('id in (?)', $ids)));
            foreach ($deleteObj as $obj) {
                $obj->delete();
            }
            $this->_show_message("Admin users deleted", 'success');
        } else {
            if (!$id)
                show_404();
            $deleteObj = Adminuser::find($id);
            $deleteObj->delete();
            $this->_show_message("Admin user deleted", 'success');
        }
        redirect('admin/admin/list');
    }

    function activate($id = '') {
        if (!$id)
            show_404();
        $editActivation = Adminuser::find_by_id($id);
        $editActivation->activated = '1';
        $editActivation->save();
        $this->_show_message("Admin user activated successfully", 'success');
        redirect('admin/admin');
    }

    function deactivate($id = '') {
        if (!$id)
            show_404();
        $editActivation = Adminuser::find_by_id($id);
        $editActivation->activated = '0';
        $editActivation->save();
        $this->_show_message("Admin user deactivated successfully", 'success');
        redirect('admin/admin');
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
            $this->form_validation->set_message('select_validate', 'Please select group');
            return FALSE;
        } else {
            return true;
        }
    }

    function select_email($str) {
        $result = Adminuser::find_by_email($str);
        if ($result) {
            $this->form_validation->set_message('select_email', 'email address is already in use');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
	function pdf(){
		//echo 123; die;
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
			$txt = "You can also export 1D barcodes in other formats (PNG, SVG, HTML). Check the examples inside the barcodes directory.\n";
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
				'fgcolor' => array(0,0,0),
				'bgcolor' => false, //array(255,255,255),
				'text' => true,
				'font' => 'helvetica',
				'fontsize' => 8,
				'stretchtext' => 4
			);

			// PRINT VARIOUS 1D BARCODES


			// CODE 128 AUTO
			$pdf->Cell(0, 0, 'CODE 128 AUTO', 0, 1);
			$pdf->write1DBarcode('CODE 128 AUTO', 'C128', '', '', '', 18, 0.4, $style, 'N');

			$pdf->Ln();

			// CODABAR
			$pdf->Cell(0, 0, 'CODABAR', 0, 1);
			$pdf->write1DBarcode('123456789', 'CODABAR', '', '', '', 18, 0.4, $style, 'N');

			$pdf->Ln();

			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// TEST BARCODE ALIGNMENTS

			// set a background color
			$style['bgcolor'] = array(255,255,240);
			$style['fgcolor'] = array(127,0,0);

			// Left position
			$style['position'] = 'L';
			$pdf->write1DBarcode('LEFT', 'C128A', '', '', '', 15, 0.4, $style, 'N');

			$pdf->Ln(2);

			// Center position
			$style['position'] = 'C';
			$pdf->write1DBarcode('CENTER', 'C128A', '', '', '', 15, 0.4, $style, 'N');

			$pdf->Ln(2);

			// Right position
			$style['position'] = 'R';
			$pdf->write1DBarcode('RIGHT', 'C128A', '', '', '', 15, 0.4, $style, 'N');

			$pdf->Ln(2);
// . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
			$date = date("Y_m_d H_i_s");
			$pdfName = 'uploads/' . str_replace(' ', '', $date) . '.pdf';
			$pdf->Output($pdfName, 'F'); //D
			echo $pdfName; die;
	}

}

?>