<?php

class Inmst_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllInBound() {
        $str = $this->db->query("SELECT o.*,j.BarcodeNo, j.Status, cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName,sp.Name as ProviderName  FROM `inmst` o LEFT JOIN jobmst j ON j.JobID = o.refJobID LEFT JOIN `cmpmachpartmst` cmp ON cmp.autoserialno = j.BarcodeNo LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID LEFT JOIN serviceprovider sp ON sp.SerProvID = j.refProviderID  WHERE o.refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' ORDER BY InsDateTime DESC ");
        return $str->result();
    }

    function getInBoundByID($InID) {
        $str = $this->db->query("SELECT o.*,j.BarcodeNo, j.Status, cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName,sp.Name as ProviderName FROM `inmst` o LEFT JOIN jobmst j ON j.JobID = o.refJobID LEFT JOIN `cmpmachpartmst` cmp ON cmp.autoserialno = j.BarcodeNo LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID LEFT JOIN serviceprovider sp ON sp.SerProvID = j.refProviderID WHERE o.refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' AND o.InID = '" . $InID . "' ");
        return $str->row();
    }

    function getJob() {
        $str = $this->db->query("SELECT * FROM `jobmst` WHERE refCompID = '" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' AND Status='Out' ");
        return $str->result();
    }

    function getDataBySrNo($barc) {
        $str = $this->db->query("SELECT o.OutID, j.JobID, j.IsWarranty FROM `outmst` o LEFT JOIN `jobmst` j ON j.JobID = o.refJobID WHERE o.refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' AND j.BarcodeNo = '" . $barc . "' AND j.Status='Out' ");
        return $str->row();
    }

    function checkWarranty($JobID) {
        $str = $this->db->query("SELECT IsWarranty FROM `jobmst` WHERE JobID = " . $JobID);
        $res = $str->row();
        if (!empty($res)) {
            if ($res->IsWarranty == 0) {
                return TRUE;
            }
            return FALSE;
        }
        return FALSE;
    }
    
    function quotationAmt($JobID){
        $str = $this->db->query("SELECT QuotAmt FROM `jobmst` WHERE JobID = " . $JobID);
        $res = $str->row();
        if (!empty($res)) {
            if ($res->QuotAmt > 0) {
                return $res->QuotAmt;
            }
            return 0;
        }
        return 0;
    }

    function getDetailDataBySrNo($barc) {
        $str = $this->db->query("SELECT cmp.*,cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName FROM `cmpmachpartmst` cmp LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID WHERE cmp.refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' AND cmp.autoserialno = '" . $barc . "' ");
        return $str->row();
    }

    function insert($data, $product, $account) {
        $this->db->trans_begin();
            $this->db->insert('inmst', $data);
            $last = $this->db->insert_id();
            $this->db->update('jobmst', array('Status' => $data['Status']), array('JobID' => $data['refJobID']));
            if(!empty($account)){
                $this->db->insert('account', $account);
            }
            if(!empty($product)){
                $q = $this->db->query('SELECT c.CmpMachPartID FROM `jobmst` j LEFT JOIN cmpmachpartmst c ON c.autoserialno = j.BarcodeNo WHERE j.JobID = '.$data['refJobID']);
                $res = $q->row();
                $machpartid = $res->CmpMachPartID;
                $this->db->update('cmpmachpartmst', $product, array('CmpMachPartID' => $machpartid));
            }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $last;
        }
    }

    function update($data, $InID) {
        if ($this->db->update('inmst', $data, array('InID' => $InID)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function delete($InID) {
        $this->db
                ->where('InID', $InID)
                ->delete('inmst');

        return $this->db->affected_rows() > 0;
    }

}
