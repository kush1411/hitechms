<?php

class Accountmst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function checkCompCode($code){
        $str = $this->db->query("SELECT COUNT(*) as cnt FROM `userprofiles` WHERE code='".$code."'");
        $res = $str->row();
        if($res->cnt > 0){
            return true;
        }
        return false;
    }
    
    function getAccount(){
        $str = $this->db->query("SELECT * FROM `account` WHERE refCompID = '" . $this->session->userdata(SITE_NAME . '_account_data')['CompID'] . "' ");
        return $str->result();
    }
    
    function getAccountByID($AccountID){
        $str = $this->db->query("SELECT * FROM `account` WHERE refCompID = '" . $this->session->userdata(SITE_NAME . '_account_data')['CompID'] . "' AND AccountID = ".$AccountID);
        return $str->row();
    }
    
    function getProviderByPurchase($refPurchaseID){
        $str = $this->db->query("SELECT s.* FROM purchasemst p INNER JOIN serviceprovider s ON s.SerProvID = p.refProviderID WHERE p.PurchaseID = ".$refPurchaseID);
        return $str->row();
    }
    
    function getProviderByJob($refJobID){
        $str = $this->db->query("SELECT s.* FROM jobmst p INNER JOIN serviceprovider s ON s.SerProvID = p.refProviderID WHERE p.JobID = ".$refJobID);
        return $str->row();
    }
    function getOperatorByID($email,$code){
        $str = $this->db->query("SELECT e.* FROM `empmst` e LEFT JOIN userprofiles u ON u.user_id = e.refCompID WHERE e.EmpEmail='".$email."' AND u.code='".$code."' AND e.refDesgnID = '2' ");
        return $str->row();
    }
    
    function getParts(){
        $str = $this->db->query("SELECT t.*, c.CatName,m.MfgName FROM `machpartsmst` t LEFT JOIN categorymst c ON c.CatID = t.refCatID  LEFT JOIN mfgmst m ON m.MfgID = t.refMfgID  GROUP BY t.refCatID,t.PartName ORDER BY t.UpdDateTime DESC ");
        return $str->result();
    }
    
    function getPartsByID($MachPartID){
        $str = $this->db->query("SELECT * FROM `machpartsmst` WHERE MachPartID = '".$MachPartID."' ");
        return $str->row();
    }
    
    function getMfgByMachPartID($MachPartID){
        $str = $this->db->query("SELECT refMfgID FROM `typemfgmst` WHERE refMachPartID='".$MachPartID."' ");
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
        $this->db->insert('machpartsmst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function update($data,$id){
        if ($this->db->update('account',$data,array('AccountID'=>$id))>0) {   
            return TRUE;
        }
        return FALSE;
    }
    
    function delete($MachPartID){
        $this->db
        ->where('MachPartID', $MachPartID)
        ->delete('machpartsmst');
        
        return $this->db->affected_rows() > 0;
    }
	
	function check($name,$MachPartID){
		if($MachPartID == ''){
			$sql = "SELECT * FROM `machpartsmst` WHERE PartName = '".$name."' ";
		}else{
			$sql = "SELECT * FROM `machpartsmst` WHERE MachPartID <> '".$MachPartID."' AND PartName = '".$name."' ";
		}
		$str = $this->db->query($sql);
        return $str->row();
	}

}
