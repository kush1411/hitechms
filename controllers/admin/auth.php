<?php

/*
 * @auther Shafiq
 */

Class auth extends MY_base {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('security');
        $this->load->library('tank_auth_admin');
    }

    function index() {
        redirect('admin/activate');
    }

    function logout() {
        $this->tank_auth_admin->logout();
        redirect('admin');
    }

    /**
     * Login user on the site
     *
     * @return void
     */
    function login() {
        $this->metas['title'] = array('login');
        $this->scripts['js'] = array('admin/js/libs/jquery/jquery-1.11.2.min.js', 'admin/js/libs/jquery/jquery-migrate-1.2.1.min.js', 'admin/js/libs/bootstrap/bootstrap.min.js','admin/js/libs/spin.js/spin.min.js');
        $this->scripts['css'] = array('admin/css/bootstrap.css','admin/css/style.css','admin/css/font-awesome.min.css','admin/css/material-design-iconic-font.min.css');
        if ($this->tank_auth_admin->is_logged_in()) {         // logged in
            //redirect('dashboard');
            redirect('admin/product');
        } else if ($this->tank_auth_admin->is_logged_in(FALSE)) {      // logged in, not activated
            redirect('admin/activate');
        } else {
            $this->form_validation->set_rules('username', 'Login', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $data['errors'] = array();
            if ($this->form_validation->run()) {        // validation ok
                if ($this->tank_auth_admin->login($this->form_validation->set_value('username'), $this->form_validation->set_value('password'))) {        // success
                    $adminModules = Adminuser::find($this->session->userdata[SITE_NAME.'_admin_user_data']['user_id']);
                    $array = array();
                    $arrayRights = array();
                    foreach ($adminModules->adminright as $km => $kv) {
                        if ($kv->module->id != '' && $kv->module->status) {
                            $arrayRights[$kv->module->id] = $kv->right;
                            $array[$kv->module->id] = $kv->module->name;
                        }
                    }
                    ksort($array);
                    $this->session->set_userdata(SITE_NAME.'_menus', $array);
                    $this->session->set_userdata(SITE_NAME.'_userRights', $arrayRights);
                    redirect('admin/admin');
                } else {
                    $errors = $this->tank_auth_admin->get_error_message();
                    if (isset($errors['banned'])) {        // banned user
                        $this->_show_message($errors['banned'], 'error');
                    } elseif (isset($errors['not_activated'])) {    // not activated user
                        $this->_show_message($errors['not_activated'], 'error');
                    } elseif (isset($errors['password'])) {
                        $this->_show_message($this->lang->line($errors['password']), 'error');
                    } else {             // fail
                        foreach ($errors as $k => $v)
                            $data['errors'][$k] = $this->lang->line($v);
						
						$this->_show_message($this->lang->line($errors['login']), 'error');
                    }
                }
				redirect('admin');
            }
            $data = $this->data;
            $this->display_view('admin', 'auth/login', $data, TRUE);
        }
    }

    /**
     * Send activation email again, to the same or new email address
     *
     * @return void
     */
    function send_again() {
        if (!$this->tank_auth->is_logged_in(FALSE)) {              // not logged in or activated
            redirect('admin');
        } else {
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|xss_clean|valid_email');
            $data['errors'] = array();
            if ($this->form_validation->run()) {                // validation ok
                if (!is_null($data = $this->tank_auth->change_email($this->form_validation->set_value('email')))) {      // success
                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                    $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                    $this->_send_email('activate', $data['email'], $data);

                    $this->_handle_message('auth_message_activation_email_sent', $data['email']); //CHANGE
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            $this->load->view('admin/auth/send_again_form', $data);
        }
    }

    function unauthorize() {
        $this->scripts['js'] = array('admin/js/libs/jquery/jquery-1.11.2.min.js', 'admin/js/libs/jquery/jquery-migrate-1.2.1.min.js', 'admin/js/libs/bootstrap/bootstrap.min.js','admin/js/libs/spin.js/spin.min.js');
        $this->scripts['css'] = array('admin/css/bootstrap.css','admin/css/style.css','admin/css/font-awesome.min.css','admin/css/material-design-iconic-font.min.css');
        $this->display_view('admin', 'unauthorize');
    }

}
