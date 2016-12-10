<?php

class Providermst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getProvider() {
        $str = $this->db->query("SELECT * FROM `serviceprovider` WHERE refCompID='" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "' OR refCompID='0' ORDER BY UpdDateTime DESC ");
        return $str->result();
    }

    function getProviderByID($SerProvID) {
        $str = $this->db->query("SELECT * FROM `serviceprovider` WHERE SerProvID = '" . $SerProvID . "' ");
        return $str->row();
    }

    function insert($data) {
        $this->db->insert('serviceprovider', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    function update($data, $id) {
        if ($this->db->update('serviceprovider', $data, array('SerProvID' => $id)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function deleteAll($SerProvID) {
        $this->db
                ->where_in('SerProvID', $SerProvID)
                ->delete('serviceprovider');

        return $this->db->affected_rows() > 0;
    }

    function delete($SerProvID) {
        $this->db
                ->where('SerProvID', $SerProvID)
                ->delete('serviceprovider');

        return $this->db->affected_rows() > 0;
    }

    function check($name, $SerProvID) {
        if ($SerProvID == '') {
            $sql = "SELECT * FROM `serviceprovider` WHERE Name = '" . $name . "' ";
        } else {
            $sql = "SELECT * FROM `serviceprovider` WHERE SerProvID <> '" . $SerProvID . "' AND Name = '" . $name . "' ";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

    function checkemail($name, $SerProvID) {
        if ($SerProvID == '') {
            $sql = "SELECT * FROM `serviceprovider` WHERE Email = '" . $name . "' ";
        } else {
            $sql = "SELECT * FROM `serviceprovider` WHERE SerProvID <> '" . $SerProvID . "' AND Email = '" . $name . "' ";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

}
