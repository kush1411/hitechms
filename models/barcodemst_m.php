<?php

class Barcodemst_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getBarcodeList() {
        $str = $this->db->query("SELECT e.*, u.firstname, u.lastname FROM `erpsrn` e INNER JOIN users u ON u.id = e.refCompID ");
        return $str->result();
    }

    function getBarcodeByCon($id) {
        $str = $this->db->query("SELECT * FROM `erpsrn` WHERE refCompID = '" . $id . "' ");
        return $str->row();
    }

    function getBarcodeByTypeCon($refCompID) {
        $str = $this->db->query("SELECT * FROM `erpsrn` WHERE refCompID = '" . $refCompID . "' ");
        return $str->row();
    }

    function getDataByBarcodeId($id) {
        $str = $this->db->query("SELECT e.*,u.firstname, u.lastname FROM `erpsrn` e INNER JOIN users u ON u.id = e.refCompID WHERE e.ErpSrnID = '" . $id . "'");
        return $str->row();
    }

    function getLastRecordByCon($refCompID, $RevDate, $id) {
        $sql = "SELECT * FROM `barcode` WHERE refCompID = '" . $refCompID . "' AND refERPsrnID='" . $id . "' AND InsDateTime >= '" . $RevDate . "' ORDER BY barcodeID DESC LIMIT 1 ";
        $str = $this->db->query($sql);
        return $str->row();
    }

    function chck_duplicate($newBarcodeStr, $data, $id, $eid,$refCompID) {
        $str = $this->db->query("SELECT COUNT(*) as cnt FROM `cmpmachpartmst` where refCompID = '" . $refCompID . "' AND autoserialno = '" . trim($newBarcodeStr) . "'  ");
        $row = $str->row();

        $str1 = $this->db->query("SELECT COUNT(*) as cnt FROM `cmpmachmst` where refCompID = '" . $refCompID . "' AND autoserialno = '" . trim($newBarcodeStr) . "'  ");
        $row1 = $str1->row();

        $total = $row->cnt + $row1->cnt;
        if ($total > 0) {
            if ($id != '' && $id > 0) {
                $data['InsTerminal'] = $this->input->ip_address();
                $data['InsDateTime'] = date('Y-m-d H:i:s');
                $this->db->update('barcode',$data,array('barcodeID'=>$id));
                return true;
            } else {
                $tmpdata = array();
                $tmpdata['F1'] = isset($data['F1']) ? $data['F1'] : '';
                $tmpdata['F2'] = isset($data['F2']) ? $data['F2'] : '';
                $tmpdata['F3'] = isset($data['F3']) ? $data['F3'] : '';
                $tmpdata['F4'] = isset($data['F4']) ? $data['F4'] : '';
                $tmpdata['F5'] = isset($data['F5']) ? $data['F5'] : '';
                $tmpdata['F6'] = isset($data['F6']) ? $data['F6'] : '';
                $tmpdata['F7'] = isset($data['F7']) ? $data['F7'] : '';
                $tmpdata['InsTerminal'] = $this->input->ip_address();
                $tmpdata['InsDateTime'] = date('Y-m-d H:i:s');
                $this->db->insert('barcode', $tmpdata);
                return true;
            }
        } else {
            if ($eid > 0 && $eid != '') {
                $tmpdata = array();
                $tmpdata['refERPsrnID'] = $eid;
                $tmpdata['refCompID'] = $refCompID;
                $tmpdata['F1'] = isset($data['F1']) ? $data['F1'] : '';
                $tmpdata['F2'] = isset($data['F2']) ? $data['F2'] : '';
                $tmpdata['F3'] = isset($data['F3']) ? $data['F3'] : '';
                $tmpdata['F4'] = isset($data['F4']) ? $data['F4'] : '';
                $tmpdata['F5'] = isset($data['F5']) ? $data['F5'] : '';
                $tmpdata['F6'] = isset($data['F6']) ? $data['F6'] : '';
                $tmpdata['F7'] = isset($data['F7']) ? $data['F7'] : '';
                $tmpdata['InsTerminal'] = $this->input->ip_address();
                $tmpdata['InsDateTime'] = date('Y-m-d H:i:s');
                $this->db->insert('barcode', $tmpdata);
                return false;
            }
            return false;
        }
    }

    function getID($id,$refCompID) {
        $sql = "SELECT * FROM `barcode` WHERE refCompID = '" . $refCompID . "' AND refERPsrnID='" . $id . "'  ORDER BY barcodeID DESC LIMIT 1 ";
        $str = $this->db->query($sql);
        $res = $str->row();
        return $res->barcodeID;
    }

    function getSerialDataByMasterPrdId($id,$refCompID) {
        $str = $this->db->query("SELECT * FROM `erpsrnbarcode` WHERE refCompID = '" . $refCompID . "' AND refProductID = '" . $id . "' ");
        return $str->result();
    }

    function check_erpsrn($chk_array) {
        $query = $this->db->get_where('erpsrn', $chk_array);
        $data = $query->result();
        if (!empty($data)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function insert_erpsrn($data) {
        $this->db->insert('erpsrn', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    function update_erpsrn($data, $id) {
        if ($this->db->update('erpsrn', $data, array('ErpSrnID' => $id)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

}
