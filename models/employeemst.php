<?php

class Employeemst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getDesignation() {
        $str = $this->db->query("SELECT * FROM `designmst` WHERE (refCompID='" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "' OR refCompID = 0 ) AND Status =1 ORDER BY UpdDateTime DESC ");
        return $str->result();
    }

    function getLocation() {
        $str = $this->db->query("SELECT * FROM `locationmst` WHERE refCompID='" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "' AND Status = 1 ORDER BY UpdDateTime DESC ");
        return $str->result();
    }

    function getEmployee() {
        $str = $this->db->query("SELECT e.*, d.Name as DesigName, l.Name as LocationName FROM `empmst` e LEFT JOIN designmst d ON d.DesignID = e.refDesgnID LEFT JOIN locationmst l ON l.LocID = e.refLocID WHERE e.refCompID = '" . $this->session->userdata(SITE_NAME . '_user_data')['user_id'] . "' ORDER BY UpdDateTime DESC ");
        return $str->result();
    }

    function getEmployeeByID($EmpID) {
        $str = $this->db->query("SELECT * FROM `empmst` WHERE EmpID = '" . $EmpID . "' ");
        return $str->row();
    }

    function insert($data) {
        $this->db->insert('empmst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    function update($data, $id) {
        if ($this->db->update('empmst', $data, array('EmpID' => $id)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function deleteAll($EmpID) {
        $this->db
                ->where_in('EmpID', $EmpID)
                ->delete('empmst');

        return $this->db->affected_rows() > 0;
    }

    function delete($EmpID) {
        $this->db
                ->where('EmpID', $EmpID)
                ->delete('empmst');

        return $this->db->affected_rows() > 0;
    }

    function check($name, $EmpID) {
        if ($EmpID == '') {
            $sql = "SELECT * FROM `empmst` WHERE EmpCode = '" . $name . "' ";
        } else {
            $sql = "SELECT * FROM `empmst` WHERE EmpID <> '" . $EmpID . "' AND EmpCode = '" . $name . "' ";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

    function checkemail($name, $EmpID) {
        if ($EmpID == '') {
            $sql = "SELECT * FROM `empmst` WHERE EmpEmail = '" . $name . "' ";
        } else {
            $sql = "SELECT * FROM `empmst` WHERE EmpID <> '" . $EmpID . "' AND EmpEmail = '" . $name . "' ";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

}
