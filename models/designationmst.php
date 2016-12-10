<?php

class Designationmst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getDesignation(){
        $str = $this->db->query("SELECT * FROM `designmst` WHERE refCompID='".$this->session->userdata(SITE_NAME . '_user_data')['user_id']."' OR refCompID='0' ORDER BY UpdDateTime DESC ");
        return $str->result();
    }
    
    function getDesignationByID($DesignID){
        $str = $this->db->query("SELECT * FROM `designmst` WHERE DesignID = '".$DesignID."' ");
        return $str->row();
    }
    
    function insert($data){
        $this->db->insert('designmst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function update($data,$id){
        if ($this->db->update('designmst',$data,array('DesignID'=>$id))>0) {   
            return TRUE;
        }
        return FALSE;
    }
    
    function deleteAll($DesignID){
        $this->db
        ->where_in('DesignID', $DesignID)
        ->delete('designmst');
        
        return $this->db->affected_rows() > 0;
    }
    
    function delete($DesignID){
        $this->db
        ->where('DesignID', $DesignID)
        ->delete('designmst');
        
        return $this->db->affected_rows() > 0;
    }
	
	function check($name, $DesignID){
		if($DesignID == ''){
			$sql = "SELECT * FROM `designmst` WHERE Name = '".$name."' ";
		}else{
			$sql = "SELECT * FROM `designmst` WHERE DesignID <> '".$DesignID."' AND Name = '".$name."' ";
		}
		$str = $this->db->query($sql);
        return $str->row();
	}

}
