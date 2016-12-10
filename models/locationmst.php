<?php

class Locationmst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getLocation(){
        $str = $this->db->query("SELECT * FROM `locationmst` WHERE refCompID='".$this->session->userdata(SITE_NAME . '_user_data')['user_id']."' ORDER BY UpdDateTime DESC ");
        return $str->result();
    }
    
    function getLocationByID($LocID){
        $str = $this->db->query("SELECT * FROM `locationmst` WHERE LocID = '".$LocID."' ");
        return $str->row();
    }
    
    function insert($data){
        $this->db->insert('locationmst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function update($data,$id){
        if ($this->db->update('locationmst',$data,array('LocID'=>$id))>0) {   
            return TRUE;
        }
        return FALSE;
    }
    
    function deleteAll($LocID){
        $this->db
        ->where_in('LocID', $LocID)
        ->delete('locationmst');
        
        return $this->db->affected_rows() > 0;
    }
    
    function delete($LocID){
        $this->db
        ->where('LocID', $LocID)
        ->delete('locationmst');
        
        return $this->db->affected_rows() > 0;
    }
	
	function check($name, $LocID){
		if($LocID == ''){
			$sql = "SELECT * FROM `locationmst` WHERE Code = '".$name."' ";
		}else{
			$sql = "SELECT * FROM `locationmst` WHERE LocID <> '".$LocID."' AND Code = '".$name."' ";
		}
		$str = $this->db->query($sql);
        return $str->row();
	}

}
