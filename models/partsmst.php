<?php

class Partsmst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCat() {
        $str = $this->db->query("SELECT CatID, CatName FROM `categorymst` WHERE Status=1 ORDER BY CatName ");
        return $str->result();
    }

    function getMfg() {
        $str = $this->db->query("SELECT MfgID, MfgName FROM `mfgmst` WHERE Status=1 AND IsPartsMfg=1 ORDER BY MfgName ");
        return $str->result();
    }

    function getType($refCatID) {
        $str = $this->db->query("SELECT * FROM `typemst` WHERE refCatID = '" . $refCatID . "' AND Status = 1 ORDER BY TypeName DESC ");
        return $str->result();
    }

    function getParts() {
        $str = $this->db->query("SELECT t.*,ty.TypeName, c.CatName,group_concat(m.MfgName) as MfgName FROM `machpartsmst` t LEFT JOIN categorymst c ON c.CatID = t.refCatID LEFT JOIN typemst ty ON ty.TypeID = t.refTypeID LEFT JOIN machpartsmfg sm ON sm.refMachPartID = t.MachPartID LEFT JOIN mfgmst m ON m.MfgID = sm.refMfgID  GROUP BY t.MachPartID ORDER BY t.UpdDateTime DESC "); //t.refCatID,t.PartName
        return $str->result();
    }

    function getPartsByID($MachPartID) {
        $str = $this->db->query("SELECT * FROM `machpartsmst` WHERE MachPartID = '" . $MachPartID . "' ");
        return $str->row();
    }

    function getMfgByMachPartID($MachPartID) {
        $str = $this->db->query("SELECT refMfgID FROM `typemfgmst` WHERE refMachPartID='" . $MachPartID . "' ");
        $res = $str->result();
        $arr = array();
        if (!empty($res)) {
            foreach ($res as $k => $value) {
                array_push($arr, $value->refMfgID);
            }
        }
        return $arr;
    }

    function insert($data) {
        $this->db->insert('machpartsmst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    function update($data, $id) {
        if ($this->db->update('machpartsmst', $data, array('MachPartID' => $id)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function deleteAll($MachPartID){
        $this->db
        ->where_in('MachPartID', $MachPartID)
        ->delete('machpartsmst');
        if($this->db->affected_rows() > 0){
            $this->db
                    ->where('refMachPartID', $MachPartID)
                    ->delete('machpartsmfg');
            return TRUE;
        }
        return FALSE;
    }
    
    function delete($MachPartID) {
        $this->db
                ->where('MachPartID', $MachPartID)
                ->delete('machpartsmst');
        if($this->db->affected_rows() > 0){
            $this->db
                    ->where('refMachPartID', $MachPartID)
                    ->delete('machpartsmfg');
            return TRUE;
        }
        return FALSE;
    }

    function check($name,$refTypeID, $MachPartID) {
        if ($MachPartID == '') {
            $sql = "SELECT * FROM `machpartsmst` WHERE PartName = '" . $name . "' AND refTypeID = '".$refTypeID."' ";
        } else {
            $sql = "SELECT * FROM `machpartsmst` WHERE MachPartID <> '" . $MachPartID . "' AND PartName = '" . $name . "' AND refTypeID = '".$refTypeID."' ";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

    function getMfgByPartsID($PartsID) {
        $str = $this->db->query("SELECT refMfgID FROM `machpartsmfg` WHERE refMachPartID='" . $PartsID . "' ");
        $res = $str->result();
        $arr = array();
        if (!empty($res)) {
            foreach ($res as $k => $value) {
                array_push($arr, $value->refMfgID);
            }
        }
        return $arr;
    }

    function insertbatch($data) {
        $this->db->insert_batch('machpartsmfg', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function deletebatch($PartsID) {
        $this->db
                ->where('refMachPartID', $PartsID)
                ->delete('machpartsmfg');

        return $this->db->affected_rows() > 0;
    }

}
