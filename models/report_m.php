<?php

class Report_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getProvider(){
        $str = $this->db->query("SELECT * FROM `serviceprovider` WHERE refCompID='" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "' OR refCompID='0' ORDER BY Name ");
        return $str->result();
    }
    
    function getExpenseSearch(){
        
    }
    
}
