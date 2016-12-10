<?php

class Contactmst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllContact() {
        $str = $this->db->query("SELECT * FROM `contactus` ORDER BY InsertDateTime DESC ");
        return $str->result();
    }

    function deleteAll($id) {
        $this->db
                ->where_in('id', $id)
                ->delete('contactus');

        return $this->db->affected_rows() > 0;
    }

    function delete($id) {
        $this->db
                ->where('id', $id)
                ->delete('contactus');

        return $this->db->affected_rows() > 0;
    }

}
