<?php

class Machinemst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCategory() {
        $str = $this->db->query("SELECT * FROM `categorymst` WHERE Status = 1 ORDER BY CatName DESC ");
        return $str->result();
    }

    function getType($refCatID) {
        $str = $this->db->query("SELECT * FROM `typemst` WHERE refCatID = '" . $refCatID . "' AND Status = 1 ORDER BY TypeName DESC ");
        return $str->result();
    }

    function getMfg($refTypeID) {
        $str = $this->db->query("SELECT m.* FROM `typemfgmst` t LEFT JOIN mfgmst m ON m.MfgID = t.refMfgID WHERE t.refTypeID = '" . $refTypeID . "' AND m.Status = 1 ORDER BY m.MfgName DESC ");
        return $str->result();
    }

    function getLocation($user_id) {
        $str = $this->db->query("SELECT * FROM `locationmst` WHERE refCompID='" . $user_id . "' AND Status = 1 ORDER BY UpdDateTime DESC ");
        return $str->result();
    }

    function getMachine($user_id) {
        $str = $this->db->query("SELECT cm.*, c.CatName, t.TypeName, m.MfgName,l.Name as LocName FROM `cmpmachmst` cm LEFT JOIN categorymst c ON c.CatID = cm.refCatID LEFT JOIN typemst t ON t.TypeID = cm.refTypeID LEFT JOIN mfgmst m ON m.MfgID = cm.refMfgID LEFT JOIN locationmst l ON l.LocID = cm.refLocID WHERE cm.refCompID='" . $user_id . "' ORDER BY cm.UpdDateTime DESC ");
        return $str->result();
    }

    function getMachineByCompID($id) {
        $str = $this->db->query("SELECT * FROM `cmpmachmst` WHERE refCompID='" . $id . "' ORDER BY UpdDateTime DESC ");
        return $str->result();
    }

    function getMachineByID($MachID) {
        $str = $this->db->query("SELECT * FROM `cmpmachmst` WHERE MachID = '" . $MachID . "' ");
        return $str->row();
    }

    function insert($data, $barcode, $barcodeID) {
        $this->db->insert('cmpmachmst', $data);
        if ($this->db->affected_rows() > 0) {
            $last = $this->db->insert_id();
            if (!empty($barcode)) {
                $tmpdata['F1'] = isset($barcode['F1']) ? $barcode['F1'] : '';
                $tmpdata['F2'] = isset($barcode['F2']) ? $barcode['F2'] : '';
                $tmpdata['F3'] = isset($barcode['F3']) ? $barcode['F3'] : '';
                $tmpdata['F4'] = isset($barcode['F4']) ? $barcode['F4'] : '';
                $tmpdata['F5'] = isset($barcode['F5']) ? $barcode['F5'] : '';
                $tmpdata['F6'] = isset($barcode['F6']) ? $barcode['F6'] : '';
                $tmpdata['F7'] = isset($barcode['F7']) ? $barcode['F7'] : '';
                $tmpdata['InsTerminal'] = $this->input->ip_address();
                $tmpdata['InsDateTime'] = date('Y-m-d H:i:s');
                $this->db->update('barcode', $tmpdata, array('barcodeID' => $barcodeID));
            }
            return $last;
        }
        return FALSE;
    }

    function update($data, $id) {
        if ($this->db->update('cmpmachmst', $data, array('MachID' => $id)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function deleteAll($MachID) {
        $this->db
                ->where_in('MachID', $MachID)
                ->delete('cmpmachmst');

        if ($this->db->affected_rows() > 0) {
            $this->db
                    ->where_in('refMachID', $MachID)
                    ->delete('cmpmachpartmst');

            return $this->db->affected_rows() > 0;
        }
        return TRUE;
    }

    function delete($MachID) {
        $this->db
                ->where('MachID', $MachID)
                ->delete('cmpmachmst');

        if ($this->db->affected_rows() > 0) {
            $this->db
                    ->where('refMachID', $MachID)
                    ->delete('cmpmachpartmst');
            return $this->db->affected_rows() > 0;
        }
        return TRUE;
    }

    function getMachineDetailsByID($MachID) {
        $str = $this->db->query("SELECT m.*,c.CatName,t.TypeName,mf.MfgName,l.Name as LocName FROM `cmpmachmst` m LEFT JOIN categorymst c ON c.CatID = m.refCatID LEFT JOIN typemst t ON t.TypeID = m.refTypeID LEFT JOIN mfgmst mf ON mf.MfgID = m.refMfgID LEFT JOIN locationmst l ON l.LocID = m.refLocID WHERE m.MachID = '" . $MachID . "' ");
        return $str->row();
    }

    function getMachinePartsByMachID($MachID) {
        $str = $this->db->query("SELECT cmp.*, m.MachName, p.PartName, sp.SubPartName, mc.MfgName  FROM `cmpmachpartmst` cmp LEFT JOIN cmpmachmst m ON m.MachID = cmp.refMachID LEFT JOIN machpartsmst p ON p.MachPartID = cmp.refMachPartID LEFT JOIN machsubpartsmst sp ON sp.MachSubPartID = cmp.refMachSubPartID LEFT JOIN mfgmst mc ON mc.MfgID = cmp.refMfgID WHERE cmp.refMachID = '" . $MachID . "' ORDER BY cmp.UpdDateTime DESC "); //cmp.refCompID='" . $user_id . "' AND 
        return $str->result();
    }

    function getMachinePartsByID($MachPartID,$user_id) {
        $str = $this->db->query("SELECT cmp.*, m.MachName, p.PartName, sp.SubPartName  FROM `cmpmachpartmst` cmp LEFT JOIN cmpmachmst m ON m.MachID = cmp.refMachID LEFT JOIN machpartsmst p ON p.MachPartID = cmp.refMachPartID LEFT JOIN machsubpartsmst sp ON sp.MachSubPartID = cmp.refMachSubPartID WHERE cmp.refCompID='" . $user_id . "' AND cmp.CmpMachPartID = '" . $MachPartID . "' ORDER BY cmp.UpdDateTime DESC ");
        return $str->row();
    }

    function insertparts($data, $barcode, $barcodeID) {
        $this->db->insert('cmpmachpartmst', $data);
        if ($this->db->affected_rows() > 0) {
            $last = $this->db->insert_id();
            if (!empty($barcode)) {
                $tmpdata['F1'] = isset($barcode['F1']) ? $barcode['F1'] : '';
                $tmpdata['F2'] = isset($barcode['F2']) ? $barcode['F2'] : '';
                $tmpdata['F3'] = isset($barcode['F3']) ? $barcode['F3'] : '';
                $tmpdata['F4'] = isset($barcode['F4']) ? $barcode['F4'] : '';
                $tmpdata['F5'] = isset($barcode['F5']) ? $barcode['F5'] : '';
                $tmpdata['F6'] = isset($barcode['F6']) ? $barcode['F6'] : '';
                $tmpdata['F7'] = isset($barcode['F7']) ? $barcode['F7'] : '';
                $tmpdata['InsTerminal'] = $this->input->ip_address();
                $tmpdata['InsDateTime'] = date('Y-m-d H:i:s');
                $this->db->update('barcode', $tmpdata, array('barcodeID' => $barcodeID));
            }
            return $last;
        }
        return FALSE;
    }

    function updateparts($data, $id) {
        if ($this->db->update('cmpmachpartmst', $data, array('CmpMachPartID' => $id)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function deleteAllparts($MachID) {
        $this->db
                ->where_in('CmpMachPartID', $MachID)
                ->delete('cmpmachpartmst');

        return $this->db->affected_rows() > 0;
    }

    function deleteparts($MachID) {
        $this->db
                ->where('CmpMachPartID', $MachID)
                ->delete('cmpmachpartmst');

        return $this->db->affected_rows() > 0;
    }

    function getPart($refMachID) {
        $str = $this->db->query("SELECT p.* FROM `machpartsmst` p INNER JOIN cmpmachmst cm ON cm.refTypeID = p.refTypeID WHERE p.Status = 1 AND cm.MachID = '" . $refMachID . "'");
        return $str->result();
    }

    function getSubPart($refPartID) {
        $str = $this->db->query("SELECT p.* FROM `machsubpartsmst` p  WHERE p.Status = 1 AND p.refMachPartID = '" . $refPartID . "'");
        return $str->result();
    }

    function check($name, $MachID, $user_id) {
        if ($MachID == '') {
            $sql = "SELECT * FROM `cmpmachmst` WHERE MachCode = '" . $name . "' AND refCompID = '" . $user_id . "'";
        } else {
            $sql = "SELECT * FROM `cmpmachmst` WHERE MachID <> '" . $MachID . "' AND MachCode = '" . $name . "' AND refCompID = '" . $user_id . "'";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

    function checkserial($name, $MachID, $user_id) {
        if ($MachID == '') {
            $sql = "SELECT * FROM `cmpmachmst` WHERE MachSerialNo = '" . $name . "' AND refCompID = '" . $user_id . "'";
        } else {
            $sql = "SELECT * FROM `cmpmachmst` WHERE MachID <> '" . $MachID . "' AND MachSerialNo = '" . $name . "' AND refCompID = '" . $user_id . "' ";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

    function checkserialparts($name, $MachPartID,$user_id) {
        if ($MachPartID == '') {
            $sql = "SELECT * FROM `cmpmachpartmst` WHERE SerialNo = '" . $name . "' AND refCompID = '" . $user_id . "'";
        } else {
            $sql = "SELECT * FROM `cmpmachpartmst` WHERE MachPartID <> '" . $MachPartID . "' AND SerialNo = '" . $name . "' AND refCompID = '" . $user_id . "' ";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

    function getMfgByPartsID($partid) {
        $str = $this->db->query("SELECT m.* FROM `machpartsmfg` p INNER JOIN mfgmst m ON m.MfgID = p.refMfgID WHERE m.Status = 1 AND p.refMachPartID = '" . $partid . "'");
        return $str->result();
    }

    function getMfgBySubPartsID($subpartid) {
        $str = $this->db->query("SELECT m.* FROM `machsubpartsmfg` sp INNER JOIN mfgmst m ON m.MfgID = sp.refMfgID WHERE m.Status = 1 AND sp.refMachSubPartID = '" . $subpartid . "'");
        return $str->result();
    }
    
    function checkparts($MachID){
        $str = $this->db->query('SELECT COUNT(*) as cnt FROM `cmpmachpartmst` WHERE refMachID = '.$MachID);
        $res = $str->row();
        if($res->cnt > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
