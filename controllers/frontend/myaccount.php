<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Myaccount extends My_front {

    function __construct() {
        parent::__construct();
        $this->_api_require_user();
    }

    public function index() {
        $view = 'myaccount/myaccount';
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $this->data['user'] = User::find('first', array('conditions' => array('id = ?', $user_id)));
        $this->display_view('frontend', $view, $this->data);
    }

    function edit($user_id = "") {
        if ($this->session->userdata(SITE_NAME . '_user_data')) {
            $user_id = $this->session->userdata[SITE_NAME . '_user_data']['user_id'];

            $this->data['user'] = User::find('first', array('conditions' => array('id=?', $user_id)));
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('company', 'Company', 'trim|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('city', 'city', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('state', 'State', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('zip', 'Zip', 'trim|required|trim|xss_clean|strip_tags|integer');
            $this->form_validation->set_rules('fax', 'Fax', 'trim|trim|xss_clean|strip_tags|integer');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|trim|xss_clean|strip_tags|integer');
            $this->form_validation->set_rules('aboutme', 'About Me', 'trim|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|trim|xss_clean|strip_tags|integer');

            if ($this->form_validation->run()) {
				
                $conn = User::connection();
                $conn->transaction();
                try {
					
                    $user = User::find('first', array('conditions' => array('id=?', $user_id)));
                    $user->firstname = $this->input->post('firstname');
                    $user->lastname = $this->input->post('lastname');
                    $user->upddatetime = date("Y-m-d H:i:s");
					
                    $user->save();

                    $userprofile = Userprofile::find_by_user_id($user_id);
                    $userprofile->telephone = $this->input->post('telephone');
					$userprofile->address = $this->input->post('address');
					$userprofile->country = $this->input->post('country');
					$userprofile->state = $this->input->post('state');
					$userprofile->city = $this->input->post('city');
					$userprofile->zip = $this->input->post('zip');
					$userprofile->fax = $this->input->post('fax');
					$userprofile->company = $this->input->post('company');
					$userprofile->aboutme = $this->input->post('aboutme');
					$userprofile->mobile = $this->input->post('mobile');
                    $userprofile->upddatetime = date("Y-m-d H:i:s");
                    $userprofile->save();
                    $conn->commit();
                    $this->_show_message("Updated successfully...", 'success');
                    redirect('/');
                } catch (Exception $e) {
                    $this->write_logs($e);
                    $conn->rollback();
                }
            } else {

                $formerror = '';
                $errors = $this->form_validation->get_field_data();
                foreach ($errors as $k => $v) {
                    $formerror .= $v['error'];
                }
                $this->_show_message($formerror, 'error');
                $this->data['error'] = $formerror;
                $this->data['postdata'] = $this->input->post();
            }

            $view = "myaccount/myaccount";
            $this->display_view("frontend", $view, $this->data);
        } else {
            redirect('/');
        }
    }

    public function pastorders() {
        $view = 'myaccount/past_orders';
        if ($this->session->userdata(SITE_NAME . '_user_data')) {
            $user_id = $this->session->userdata[SITE_NAME . '_user_data']['user_id'];

            $this->data['item'] = Order::find('all', array('conditions' => array('user_id=?', $user_id), 'order' => 'id desc'));
        }
        $this->display_view('frontend', $view, $this->data);
    }

    public function pastorders_details($id = '') {
//        $view = 'myaccount/pastorder_details';
        $view = "myaccount/orderdetails";
        $this->data['order'] = Order::find(array('conditions' => array('id = ?', $id)));
        $this->data['orderdetail'] = Orderdetail::find('all', array('conditions' => array('order_id = ?', $id)));

//echo'<pre>';
//print_r(   $this->data['orderdetail']);exit;
        $this->display_view('frontend', $view, $this->data);
    }

    public function saveddesigns($id = '') {
        $data = '';
        if ($this->session->userdata('Cozysham_user_data')) {
            $offset = 0;
            $limit = 5;
            if ($this->uri->segment(2) != '') {
                $offset = $this->uri->segment(2);
            }
            $data['userid'] = $this->session->userdata['Cozysham_user_data']['user_id'];
            $data['username'] = $this->session->userdata['Cozysham_user_data']['name'];
            $user_cushion = User_Cushion::find('all', array('conditions' => array('user_id = ?', $data['userid']), 'order' => 'updated desc', 'limit' => $limit, 'offset' => $offset));

            $this->load->library('pagination');
            $url = base_url('designs');

            $count = count(User_Cushion::find('all', array('conditions' => array('user_id = ?', $data['userid']), 'order' => 'updated desc')));
            $config = $this->pagination($count, $url, $limit);
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);
            $data['links'] = $this->pagination->create_links();

            $data['designs'] = $user_cushion;

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
                    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $view = "myaccount/ajaxsavedlisting";
                $this->load->view('frontend/' . $view, $data);
            } else {
                $view = "myaccount/savedlisting";
                $this->display_view(FRONTENDFOLDERNAME, $view, $data);
            }
        } else {
            $view = "/login/register";
            $this->display_view(FRONTENDFOLDERNAME, $view, $data);
        }
    }

    public function deletedesign($id) {
        if ($id) {
            $userdesign = User_Cushion::find($id);
            $userdesign->delete();
            $this->_show_message('Design deleted successfully', 'success');
            redirect('designs');
        } else {
            
        }
    }

    public function editdesign($id) {

        if ($id) {

            redirect('visualizer/visual/' . $id);
        }
    }

}

?>
