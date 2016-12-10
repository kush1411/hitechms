<?php

class Home_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getDesignation() {
        $str = $this->db->query("SELECT COUNT(*) as cnt FROM `designmst` WHERE (refCompID='" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "' OR refCompID = 0 ) ");
        return $str->row();
    }

    function getLocation() {
        $str = $this->db->query("SELECT COUNT(*) as cnt FROM `locationmst` WHERE refCompID='" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "' ");
        return $str->row();
    }

    function getEmployee() {
        $str = $this->db->query("SELECT COUNT(*) as cnt FROM `empmst` e  WHERE e.refCompID = '" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "' ");
        return $str->row();
    }

    function getProvider() {
        $str = $this->db->query("SELECT COUNT(*) as cnt FROM `serviceprovider` WHERE refCompID='" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "' OR refCompID='0' ");
        return $str->row();
    }
    
    function getMachine() {
        $str = $this->db->query("SELECT COUNT(*) as cnt FROM `cmpmachmst` cm  WHERE cm.refCompID='" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "'  ");
        return $str->row();
    }
    
    function insert_contact($data){
        $this->db->insert('contactus',$data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
}
