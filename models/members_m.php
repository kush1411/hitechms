<?php

class Members_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function deleteMembersData($ids) {
        $this->db->where_in('user_id', $ids)->delete('userprofiles');
        $this->db->where_in('refCompID', $ids)->delete('serviceprovider');
        $this->db->where_in('refCompID', $ids)->delete('pomst');
        $this->db->where_in('refCompID', $ids)->delete('outmst');
        $this->db->where_in('refCompID', $ids)->delete('locationmst');
        $this->db->where_in('refCompID', $ids)->delete('jobmst');
        $this->db->where_in('refCompID', $ids)->delete('inmst');
        $this->db->where_in('refCompID', $ids)->delete('erpsrn');
        $this->db->where_in('refCompID', $ids)->delete('empmst');
        $this->db->where_in('refCompID', $ids)->delete('designmst');
        $this->db->where_in('refCompID', $ids)->delete('cmpmachpartmst');
        $this->db->where_in('refCompID', $ids)->delete('cmpmachmst');
        $this->db->where_in('refCompID', $ids)->delete('account');
        return TRUE;
    }

    function deleteMemberData($id) {
        $this->db->where('user_id', $id)->delete('userprofiles');
        $this->db->where('refCompID', $id)->delete('serviceprovider');
        $this->db->where('refCompID', $id)->delete('pomst');
        $this->db->where('refCompID', $id)->delete('outmst');
        $this->db->where('refCompID', $id)->delete('locationmst');
        $this->db->where('refCompID', $id)->delete('jobmst');
        $this->db->where('refCompID', $id)->delete('inmst');
        $this->db->where('refCompID', $id)->delete('erpsrn');
        $this->db->where('refCompID', $id)->delete('empmst');
        $this->db->where('refCompID', $id)->delete('designmst');
        $this->db->where('refCompID', $id)->delete('cmpmachpartmst');
        $this->db->where('refCompID', $id)->delete('cmpmachmst');
        $this->db->where('refCompID', $id)->delete('account');
        return TRUE;
    }

}
