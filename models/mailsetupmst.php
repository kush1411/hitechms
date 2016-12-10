<?php

class Mailsetupmst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getMailsetup(){
        $str = $this->db->query("SELECT ml.refMfgID1, m.MfgName, group_concat(m2.MfgName) as sendmail, ml.InsDateTime FROM `mailmst` ml LEFT JOIN mfgmst m ON m.MfgID = ml.refMfgID1 LEFT JOIN mfgmst m2 ON m2.MfgID = ml.refMfgID2 GROUP BY ml.refMfgID1 ORDER BY ml.InsDateTime DESC ");
        return $str->result();
    }
    function getMfg() {
        $str = $this->db->query("SELECT * FROM `mfgmst` ORDER BY MfgName");
        return $str->result();
    }
    
    function getMailsetupByID($refMfgID1){
        $str = $this->db->query("SELECT refMfgID1, group_concat(refMfgID2) as refMfgID2, InsDateTime FROM `mailmst` WHERE refMfgID1 = '".$refMfgID1."' GROUP BY refMfgID1  ");
        return $str->row();
    }
    
    function insert($data){
        $this->db->insert_batch('mailmst', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
    
    function deleteAll($refMfgID1){
        $this->db
        ->where_in('refMfgID1', $refMfgID1)
        ->delete('mailmst');
        
        return $this->db->affected_rows() > 0;
    }
    
    function delete($refMfgID1){
        $this->db
        ->where('refMfgID1', $refMfgID1)
        ->delete('mailmst');
        
        return $this->db->affected_rows() > 0;
    }

}
