<?php

class Subpartsmst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getpart(){
        $str = $this->db->query("SELECT m.MachPartID, m.PartName, t.TypeName FROM `machpartsmst` m INNER JOIN typemst t ON t.TypeID = m.refTypeID WHERE m.Status=1 ORDER BY m.PartName ");
        return $str->result();
    }
    function getMfg(){
        $str = $this->db->query("SELECT MfgID, MfgName FROM `mfgmst` WHERE Status=1 AND IsPartsMfg=1 ORDER BY MfgName ");
        return $str->result();
    }
    
    function getSubparts(){
        $str = $this->db->query("SELECT t.*, c.PartName,group_concat(m.MfgName) as MfgName FROM `machsubpartsmst` t LEFT JOIN machpartsmst c ON c.MachPartID = t.refMachPartID LEFT JOIN machsubpartsmfg sm ON sm.refMachSubPartID = t.MachSubPartID LEFT JOIN mfgmst m ON m.MfgID = sm.refMfgID  GROUP BY t.MachSubPartID ORDER BY t.UpdDateTime DESC ");
        return $str->result();
    }
    
    function getSubpartsByID($MachSubPartID){
        $str = $this->db->query("SELECT * FROM `machsubpartsmst` WHERE MachSubPartID = '".$MachSubPartID."' ");
        return $str->row();
    }
    
    function getMfgByMachSubPartID($MachSubPartID){
        $str = $this->db->query("SELECT refMfgID FROM `typemfgmst` WHERE refMachSubPartID='".$MachSubPartID."' ");
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
        $this->db->insert('machsubpartsmst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function update($data,$id){
        if ($this->db->update('machsubpartsmst',$data,array('MachSubPartID'=>$id))>0) {   
            return TRUE;
        }
        return FALSE;
    }
    
    function deleteAll($MachSubPartID){
        $this->db
        ->where_in('MachSubPartID', $MachSubPartID)
        ->delete('machsubpartsmst');
        
        return $this->db->affected_rows() > 0;
    }
    
    function delete($MachSubPartID){
        $this->db
        ->where('MachSubPartID', $MachSubPartID)
        ->delete('machsubpartsmst');
        
        return $this->db->affected_rows() > 0;
    }
	
	function check($name,$refMachPartID,$MachSubPartID){
		if($MachSubPartID == ''){
			$sql = "SELECT * FROM `machsubpartsmst` WHERE SubPartName = '".$name."' AND refMachPartID = '".$refMachPartID."' ";
		}else{
			$sql = "SELECT * FROM `machsubpartsmst` WHERE MachSubPartID <> '".$MachSubPartID."' AND refMachPartID = '".$refMachPartID." AND SubPartName = '".$name."' ";
		}
		$str = $this->db->query($sql);
        return $str->row();
	}
	
	function getMfgBySubPartsID($SubPartsID){
        $str = $this->db->query("SELECT refMfgID FROM `machsubpartsmfg` WHERE refMachSubPartID='".$SubPartsID."' ");
        $res = $str->result();
        $arr = array();
        if(!empty($res)){
            foreach ($res as $k => $value) {
                array_push($arr, $value->refMfgID);
            }
        }
        return $arr;
    }
	
	function insertbatch($data){
        $this->db->insert_batch('machsubpartsmfg', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
	
	function deletebatch($SubPartsID){
        $this->db
        ->where('refMachSubPartID', $SubPartsID)
        ->delete('machsubpartsmfg');
        
        return $this->db->affected_rows() > 0;
    }

}
