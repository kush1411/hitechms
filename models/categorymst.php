<?php

class Categorymst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCategory(){
        $str = $this->db->query("SELECT * FROM `categorymst` ORDER BY UpdDateTime DESC ");
        return $str->result();
    }
    
    function getCategoryByID($CatID){
        $str = $this->db->query("SELECT * FROM `categorymst` WHERE CatID = '".$CatID."' ");
        return $str->row();
    }
    
    function insert($data){
        $this->db->insert('categorymst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function update($data,$id){
        if ($this->db->update('categorymst',$data,array('CatID'=>$id))>0) {   
            return TRUE;
        }
        return FALSE;
    }
    
    function deleteAll($CatID){
        $this->db
        ->where_in('CatID', $CatID)
        ->delete('categorymst');
        
        return $this->db->affected_rows() > 0;
    }
    
    function delete($CatID){
        $this->db
        ->where('CatID', $CatID)
        ->delete('categorymst');
        
        return $this->db->affected_rows() > 0;
    }
	
	function check($name, $CatID){
		if($CatID == ''){
			$sql = "SELECT * FROM `categorymst` WHERE CatName = '".$name."' ";
		}else{
			$sql = "SELECT * FROM `categorymst` WHERE CatID <> '".$CatID."' AND CatName = '".$name."' ";
		}
		$str = $this->db->query($sql);
        return $str->row();
	}

}
