<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends My_operator {

    function __construct() {
        parent::__construct();
       // $this->_api_require_user(array('only' => array('checkout', 'addaddress', 'confirm')));
    }

    public function index() {
        $this->data['menuaction'] = 'dashboard';
        $view = 'home/dashboard';
        $this->display_view('operator', $view, $this->data);
    }

}

?>
