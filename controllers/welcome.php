<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function contactus() {
        if($this->input->post()){
            $data = array();
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['query'] = $this->input->post('query');
            $data['InsertDateTime'] = date('Y-m-d H:i:s');
            $this->load->model('home_m');
            if($this->home_m->insert_contact($data)){
                echo json_encode(array('res'=>'success','msg'=>'Contact Inserted')); die;
            }else{
                echo json_encode(array('res'=>'error','msg'=>'Database Unreachable')); die;
            }
        }else{
            echo json_encode(array('res'=>'error','msg'=>'invalid action')); die;
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
