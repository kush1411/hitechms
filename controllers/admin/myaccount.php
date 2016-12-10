<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Myaccount extends MY_admin {

    function __construct() {
        parent::__construct();
        $this->load->library("tank_auth_admin");
    }

    function index() {
//        echo '<pre>';print_r($this->session->all_userdata());exit;
        $id = $this->session->userdata[SITE_NAME . "_admin_user_data"]['user_id'];
        $view = "myaccount/edit";
        $pagetitle = "Myaccount";
        $data['adminusers'] = Adminuser::find($id);

        if ($this->input->post()) {
            $config = array(
                array('field' => 'email', 'label' => "Email", 'rules' => 'required|valid_email|xss_clean|trim'),
                array('field' => 'username', 'label' => 'username', 'rules' => 'required|xss_clean|trim'),
                array('field' => 'activated', 'label' => 'Status', 'rules' => 'required|xss_clean|trim|callback_status_validate'),
                array('field' => 'contact_number', 'label' => 'Contact Number', 'rules' => 'required|xss_clean|trim|max_length[10]')
            );

            if ($this->input->post('password') || $this->input->post('Cpassword')) {
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('Cpassword', 'Confirm Password', 'required|matches[password]');
            }
            $this->form_validation->set_rules($config);
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
                    $EditUser = Adminuser::find($id);
                    $EditUser->email = $this->form_validation->set_value('email');
                    $EditUser->username = $this->form_validation->set_value('username');
                    $EditUser->contact_number = $this->form_validation->set_value('contact_number');
                    $EditUser->activated = $this->form_validation->set_value('activated');
                    $EditUser->image_path = ADMIN_UPLOAD_IMAGE_PATH;
                    if ($this->input->post('password') && $this->input->post('Cpassword')) {
                        $EditUser->password = $this->tank_auth_admin->create_password($this->form_validation->set_value('password'));
                    }
                    if (isset($upload_data['raw_name'])) {

                        $EditUser->image_name = $upload_data['orig_name'];
                    }
                    $EditUser->save();
                    $this->landingpage($id);
                    $conn->commit();
                    $this->_show_message('Profile Updated successfully', 'success');
                    redirect('admin/myaccount');
                } catch (Exception $e) {
                    $this->write_logs($e);
                    $conn->rollback();
                }
            }
        }

        if ($data['adminusers']->landingpage) {
            $data['landingPage'] = $data['adminusers']->landingpage->module_id;
        } else {
            $data['landingPage'] = 1;
        }
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
        $this->display_view('admin', $view, $data);
    }

    function status_validate($str) {
//        echo '<pre>';print_r($str);exit;
        if ($str == 1 || $str == 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message("status_validate", "Please select one");
            return FALSE;
        }
    }

    function landingpage($user_id) {
        if ($this->input->post('landing')) {
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
                $landing->updated = databasedate();
                $landing->save();
            }
        } else {
            $landing = new Landingpage();
            $landing->adminuser_id = $user_id;
            $landing->module_id = 1;
            $landing->created = databasedate();
            $landing->updated = databasedate();
            $landing->save();
        }
    }

}

?>
