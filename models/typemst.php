<?php

class Typemst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCat(){
        $str = $this->db->query("SELECT CatID, CatName FROM `categorymst` WHERE Status=1 ORDER BY CatName ");
        return $str->result();
    }
    function getMfg(){
        $str = $this->db->query("SELECT MfgID, MfgName FROM `mfgmst` WHERE Status=1 ORDER BY MfgName "); //AND IsPartsMfg=0
        return $str->result();
    }
    
    function getType(){
        $str = $this->db->query("SELECT t.*, c.CatName,group_concat(m.MfgName) as MfgName FROM `typemst` t LEFT JOIN categorymst c ON c.CatID = t.refCatID LEFT JOIN typemfgmst tm ON tm.refTypeID = t.TypeID LEFT JOIN mfgmst m ON m.MfgID = tm.refMfgID  GROUP BY t.refCatID,t.TypeName ORDER BY t.UpdDateTime DESC ");
        return $str->result();
    }
    
    function getTypeByID($TypeID){
        $str = $this->db->query("SELECT * FROM `typemst` WHERE TypeID = '".$TypeID."' ");
        return $str->row();
    }
    
    function getMfgByTypeID($TypeID){
        $str = $this->db->query("SELECT refMfgID FROM `typemfgmst` WHERE refTypeID='".$TypeID."' ");
        $res = $str->result();
        $arr = array();
        if(!empty($res)){
            foreach ($res as $k => $value) {
                array_push($arr, $value->refMfgID);
            }
        }
        return $arr;
    }
    
    function insert($data){
        $this->db->insert('typemst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function insertbatch($data){
        $this->db->insert_batch('typemfgmst', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
    
    function update($data,$id){
        if ($this->db->update('typemst',$data,array('TypeID'=>$id))>0) {   
            return TRUE;
        }
        return FALSE;
    }
    
    function deleteAll($TypeID){
        $this->db
        ->where_in('TypeID', $TypeID)
        ->delete('typemst');
        
        return $this->db->affected_rows() > 0;
    }
    
    function delete($TypeID){
        $this->db
        ->where('TypeID', $TypeID)
        ->delete('typemst');
        
        return $this->db->affected_rows() > 0;
    }
    
    function deletebatch($TypeID){
        $this->db
        ->where('refTypeID', $TypeID)
        ->delete('typemfgmst');
        
        return $this->db->affected_rows() > 0;
    }
	
	function check($name,$refCatID,$TypeID){
		if($TypeID == ''){
			$sql = "SELECT * FROM `typemst` WHERE TypeName = '".$name."' AND refCatID = '".$refCatID."'";
		}else{
			$sql = "SELECT * FROM `typemst` WHERE TypeID <> '".$TypeID."' AND TypeName = '".$name."' AND refCatID = '".$refCatID."'";
		}
		$str = $this->db->query($sql);
        return $str->row();
	}

}
