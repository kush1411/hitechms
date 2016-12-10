<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Report extends My_front {

    function __construct() {
        parent::__construct();
        $this->load->model('report_m');
    }

    public function index() {
        $this->load->library('randomcolor');
        //echo '<pre>'; print_r($this->randomcolor->many(36)); die;
        //foreach ($this->randomcolor->many(36, array('luminosity'=>'random', 'hue'=>'random')) as $c) echo '<span style="display:inline-block; width:47px; height:47px; margin:8px; border-radius:50%;background:' . $c . ';"></span>';
        //die;
        $this->data['menuaction'] = 'expense';
        $data = array();
        $data['provider'] = $this->report_m->getProvider();
        
        if($this->input->post()){
            
            $data['reportData'] = $this->report_m->getExpenseSearch();
            $data['report'] = (object)$this->input->post();
        }
        $view = 'report/expense';
        $this->display_view('frontend', $view, $data);
    }
    
    public function expense(){
        $this->data['menuaction'] = 'expense';
        $data = array();
        $data['provider'] = $this->report_m->getProvider();
        if($this->input->post()){
            
            $data['reportData'] = $this->report_m->getExpenseSearch();
            $data['report'] = (object)$this->input->post();
        }
        $view = 'report/expense';
        $this->display_view('frontend', $view, $data);
    }

}

?>
