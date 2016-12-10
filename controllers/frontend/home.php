<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends My_front {

    function __construct() {
        parent::__construct();
       // $this->_api_require_user(array('only' => array('checkout', 'addaddress', 'confirm')));
    }

    public function index() {
        $this->data['menuaction'] = 'dashboard';
        $this->load->model('home_m');
        $this->data['loc'] = $this->home_m->getLocation();
        $this->data['desg'] = $this->home_m->getDesignation();
        $this->data['provider'] = $this->home_m->getProvider();
        $this->data['emp'] = $this->home_m->getEmployee();
        $this->data['mach'] = $this->home_m->getMachine();
        $view = 'home/dashboard';
        $this->display_view('frontend', $view, $this->data);
    }
    
     public function innerpages() {
        $id = $this->uri->segment(3);
        $view = 'content/contents';
        $this->display_view('frontend', $view, $this->data);
    }

    public function newsletter() {
        if ($this->input->get('name')) {
            $conn = Subscribnewsletters::connection();
            $conn->transaction();
            $user1 = Subscribnewsletters::find('first', array('conditions' => array('email = ?', $this->input->get('name'))));
            if ($user1) {
                $value = array('error' => '1', 'message' => 'Already subscribed',);
                echo json_encode($value);
            } else {
                try {
                    $newsletter = new Subscribnewsletters();
                    $newsletter->email = $this->input->get('name');
                    $newsletter->status = 0;
                    $newsletter->created = date('Y-m-d h:i:s');
                    $newsletter->updated = date('Y-m-d h:i:s');
                    $newsletter->save();
                    $conn->commit();

                    /*                     * ************************User mail*********************************** */
                    $auto_id = $newsletter->id;

                    $data['site_name'] = 'Diamond Machine Maintenance';
                    $data['link'] = base_url("frontend/home/subscribenewsletter/" . $auto_id);
                    $email = $newsletter->email;
                    $data['subject'] = "Newsletter_subscription";
                    $this->_send_email('newsletter', $email, $data);
                    $value = array('success' => '1', 'message' => 'Your email have been succesfully added');
                    echo json_encode($value);
                } catch (Exception $e) {
                    $this->write_logs($e);
                    $conn->rollback();
                    $value = array('error' => '1', 'message' => 'Database error');
                    echo json_encode($value);
                }
            }
        } else {
            $value = array('error' => '1', 'message' => 'Please enter email id to subscribe');
            echo json_encode($value);
        }
    }

    function subscribenewsletter($id = "") {
        $user = Subscribnewsletters::find($id);
        $user->status = 1;
        $user->save();
        $this->_show_message("Newsletter activated", 'success');
        redirect('/');
    }
  


    function checkUser($str) {
        $user = Subscribnewsletters::find('first', array('conditions' => array('email = ?', $str)));
        if ($user) {
            $this->form_validation->set_message('checkUser', 'Already subcribed');
            return FALSE;
        } else {
            return true;
        }
    }

    function unsubscribenewsletter() {
//        $this->right_menu();
        $this->input->get('name');
//        $this->form_validation->set_rules('name', 'Email', 'trim|required|trim|xss_clean|strip_tags|valid_email|callback_check_email');
        if ($this->input->post('email')) {
            try {
                $email = $this->input->post('email');
                $newslettser = Subscribnewsletters::find_by_email($email);
                $newslettser->status = 0;
                $newslettser->save();
                $this->_show_message("Newsletter Unsubscribed Successfully", 'success');
//                redirect('frontend/home/unsubscribenewsletter');
                redirect('/');
            } catch (Exception $e) {
                $this->write_logs($e);
            }
        } else {
            if ($this->input->post())
                $data['postdata'] = $this->input->post();
        }
        $view = "login/unsubscribe_newsletter";
        $this->display_view('frontend', $view);
    }

}

?>
