<?php

Class auth extends MY_base {

    function __construct() {
        parent::__construct();
        $this->load->model('accountmst');
        $this->scripts['js'] = array('admin/js/libs/jquery/jquery-1.11.2.min.js', 'admin/js/libs/jquery/jquery-migrate-1.2.1.min.js', 'admin/js/libs/bootstrap/bootstrap.min.js','admin/js/libs/spin.js/spin.min.js');
        $this->scripts['css'] = array('admin/css/bootstrap.css','admin/css/style.css','admin/css/font-awesome.min.css','admin/css/material-design-iconic-font.min.css');
        if($this->session->userdata(SITE_NAME . '_account_data') && $this->data['action'] == 'index'){ 
            redirect('/account/dashboard');
        }
    }

    function index() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|trim|xss_clean|strip_tags|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('code', 'code', 'trim|required|trim|xss_clean|strip_tags');

            if ($this->form_validation->run()) {
                try {
                    $code = $this->accountmst->checkCompCode($this->form_validation->set_value('code'));
                    if(!$code){
                        $this->_show_message("Company Code Not Registered", "error");
                        redirect('/account');
                        die;
                    }
                    $account = $this->accountmst->getOperatorByID($this->form_validation->set_value('email'),$this->form_validation->set_value('code'));
					//echo '<pre>'; print_r($account); die;
                    if ($account && $this->validate_password($account, $this->form_validation->set_value('password'))) {
                        if ($account->EmpStatus == 0) {
                            $this->_show_message("Account is not activated, Contact Your Administrator", "error");
                            redirect('/account');
                        }
                        $this->session->set_userdata(SITE_NAME . '_account_data', array(
                            'account_id' => $account->EmpID,
                            'CompID' => $account->refCompID,
                            'status' => $account->EmpStatus,
                            'firstname' => $account->EmpName,
                        ));
                        redirect('/account/dashboard');
                    } else {
                        $this->_show_message("Invalid Login", "error");
                        redirect('/account');
                    }
                } catch (Exception $e) {
                    
                }
            } else {
                $this->data['postdata'] = $this->input->post();
            }
        }
        $view = "login/login";
        $this->display_view('account', $view, $this->data);
    }

    function validate_password($user, $password) {
        if (md5($password) == $user->EmpPassword) {
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        $this->session->unset_userdata(SITE_NAME . '_account_data');
        $this->session->unset_userdata('facebook-url');
        $this->session->unset_userdata('state');
        $this->session->unset_userdata('lastclick');
        redirect('/account');
    }

    public function forgotpass() {
        $this->load->library('tank_auth');
        $view = "login/forgetpassword";
        if ($this->tank_auth->is_logged_in()) {         // logged in
            redirect('');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $data['errors'] = array();
            if ($this->form_validation->run()) {
                if (!is_null($data = $this->tank_auth->forgot_password(
                                $this->form_validation->set_value('email')))) {
                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                    // Send email with password activation link
                    $data['subject'] = "Forgot your password";
                    $this->_send_email('forgot_password', $data['email'], $data);
                    $this->_show_message($this->lang->line("auth_message_new_password_sent") . '</br>', 'success');
                    redirect('/');
                } else {
                    $this->_show_message('incorrect_email_or_username', 'error');
                    redirect('account/auth/forgotpass');
                }
            } else {
                $this->data['postdata'] = $this->input->post();
                $error = $this->form_validation->get_field_data();
                if ($error) {
                    $this->_show_message($error, "error");
                    redirect();
                }
            }
        }
        $this->display_view("account", $view, $this->data);
    }

    public function reset_password() {
//echo'<pre>';
//print_r('grfvg');exit;
        $view = "login/reset_password";
        $user_id = $this->uri->segment(4);
        $new_pass_key = $this->uri->segment(5);
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']|alpha_dash');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');
        $data['errors'] = array();
        if ($this->form_validation->run()) {
            $new_pass = User::find_by_id($user_id);
            $new_pass->password = $this->tank_auth->genrate_pass($this->form_validation->set_value('new_password'));
            $new_pass->save();
            $data['site_name'] = $this->config->item('website_name', 'tank_auth');
            $data['email'] = $new_pass->email;
            $data['subject'] = "New Password";
            // Send email with new password
            $data['password'] = $this->form_validation->set_value('new_password');
            $this->_send_email('reset_password', $data['email'], $data);
            $this->_show_message('  Your new password send to your mail' . '<br>', 'success');
            redirect('/');
//            } else {              // fail
//                $this->_show_message($this->lang->line('auth_message_new_password_failed' . '<br>', 'error'));
//            }
        } else {
            $formerror = "";
            $error = $this->form_validation->get_field_data();
            if ($error) {
                foreach ($error as $val) {
                    $formerror.= $val['error'];
                }
            }
            $this->_show_message($formerror, 'error');
            // Try to activate user by password key (if not activated yet)
//            if ($this->config->item('email_activation', 'tank_auth')) {
//                $this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
//            }
//            if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
//                $this->_show_message('error in updation plz try again' . '<br>', 'error');
//            }
        }
        $this->display_view("account", $view, $data);
    }

    function register() {
        $view = "login/register";
        if ($this->input->post()) {
            $this->form_validation->set_rules('remail', 'Email', 'trim|required|trim|xss_clean|strip_tags|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('rpassword', 'Password', 'trim|required|trim|xss_clean|strip_tags|min_length[6]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|trim|xss_clean|strip_tags|matches[rpassword]');
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('city', 'City', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('state', 'State', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('zip', 'Zip', 'trim|required|trim|xss_clean|strip_tags|integer');
            $this->form_validation->set_rules('fax', 'Fax', 'trim|trim|xss_clean|strip_tags|integer');
            $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|trim|xss_clean|strip_tags|integer');
            $this->form_validation->set_rules('code', 'code', 'trim|required|trim|xss_clean|strip_tags');

            if ($this->form_validation->run()) {
                $userdata['code'] = $this->form_validation->set_value('code');
                $userdata['firstname'] = $this->form_validation->set_value('firstname');
                $userdata['lastname'] = $this->form_validation->set_value('lastname');
                $userdata['email'] = $this->form_validation->set_value('remail');
                $userdata['password'] = $this->form_validation->set_value('rpassword');
                $userdata['address'] = $this->form_validation->set_value('address');
                $userdata['city'] = $this->form_validation->set_value('city');
                $userdata['state'] = $this->form_validation->set_value('state');
                $userdata['country'] = $this->form_validation->set_value('country');
                $userdata['zip'] = $this->form_validation->set_value('zip');
                $userdata['telephone'] = $this->form_validation->set_value('telephone');
                $userdata['company'] = $this->input->post('company');
                $userdata['fax'] = $this->input->post('fax');
                
                if (!is_null($data = $this->tank_auth->create_user($userdata))) {
                    $data['site_name'] = SITE_NAME;
                    $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;
                    $data['subject'] = "Registration";
                    $this->_send_email("activate", $data['email'], $data);
                    unset($data['password']); // Clear password (just for any case)
                    $this->_show_message($this->lang->line('auth_message_registration_completed_1'), 'success');
                    redirect('/login');
                } else {
                    $formerror = '';
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v) {
                        $formerror .= $this->lang->line($v);
                    }
                    $this->data['signuperror'] = $formerror;
                    //$this->_show_message($this->lang->line("change_error_and_continue") . '</br>' . $formerror, 'error');
                }
            } else {
                $formerror = '';
                $errors = $this->form_validation->get_field_data();
                foreach ($errors as $k => $v) {
                    $formerror .= $v['error'];
                }
                $this->_show_message($formerror, 'error');
                $this->data['signuperror'] = $formerror;
                $this->data['postdata'] = $this->input->post();
            }
        }
        $this->display_view("account", $view, $this->data);
    }

    function activate() {
        $user_id = $this->uri->segment(4);
        $new_email_key = $this->uri->segment(5);
        if ($this->tank_auth->activate_user($user_id, $new_email_key)) {  // success
             $this->_show_message('activation process done successfuly', 'info');
            $user = User::find('first', array('conditions' => array('id = ?', $user_id)));
            $this->session->set_userdata(SITE_NAME . '_account_data', array(
                'user_id' => $user->id,
                'name' => $user->fullname,
                'status' => $user->activated,
                'firstname' => $user->firstname,
            ));

            redirect('/dashboard');
        } else {                // fail
            $this->_show_message('activation_code_incorrect_expire', 'info');
            echo '0';
            redirect('login');
        }
    }

    public function change_password() {

        $view = "login/change_password";
        if ($this->tank_auth->is_logged_in()) {        // not logged in or not activated
            redirect('home');
        } else {
            if ($this->input->post()) {
                $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']|alpha_dash');
                $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');
                $user_id = $this->session->userdata[SITE_NAME . '_account_data']['user_id'];
                $data['errors'] = array();
                if ($this->form_validation->run()) {
                    $user = User::find_by_id($user_id);
                    $user->password = $this->tank_auth->genrate_pass($this->form_validation->set_value('new_password'));
                    $user->modified = date("Y-m-d h:i:s");
                    $user->save();
                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                    $data['email'] = $user->email;
                    $data['subject'] = "New Password";
                    // Send email with new password
                    $data['password'] = $this->form_validation->set_value('new_password');
                    $this->_send_email('reset_password', $data['email'], $data);
                    $this->_show_message('  Your new password send to your mail' . '<br>', 'success');
                    redirect('/');
                } else {
                    redirect('changepassword');
                }
            }
            $this->display_view("account", $view, $this->data);
        }
    }

}