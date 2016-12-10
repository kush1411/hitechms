<?php

class Outmst_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllOutBound() {
        $str = $this->db->query("SELECT o.*,j.BarcodeNo, j.Status, cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName,sp.Name as ProviderName  FROM `outmst` o LEFT JOIN jobmst j ON j.JobID = o.refJobID LEFT JOIN `cmpmachpartmst` cmp ON cmp.autoserialno = j.BarcodeNo LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID LEFT JOIN serviceprovider sp ON sp.SerProvID = j.refProviderID  WHERE o.refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' ORDER BY InsDateTime DESC ");
        return $str->result();
    }

    function getOutBoundByID($OutID) {
        $str = $this->db->query("SELECT o.*,j.BarcodeNo, j.Status, cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName,sp.Name as ProviderName FROM `outmst` o LEFT JOIN jobmst j ON j.JobID = o.refJobID LEFT JOIN `cmpmachpartmst` cmp ON cmp.autoserialno = j.BarcodeNo LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID LEFT JOIN serviceprovider sp ON sp.SerProvID = j.refProviderID WHERE o.refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' AND o.OutID = '" . $OutID . "' ");
        return $str->row();
    }

    function getJob() {
        $str = $this->db->query("SELECT * FROM `jobmst` WHERE refCompID = '" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' AND Status='Pending' ");
        return $str->result();
    }

    function getDataBySrNo($barc) {
        $str = $this->db->query("SELECT * FROM `jobmst` WHERE refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' AND BarcodeNo = '" . $barc . "' AND (Status='Pending' OR Status='Quotation Applied') ");
        return $str->row();
    }

    function getDetailDataBySrNo($barc) {
        $str = $this->db->query("SELECT cmp.*,cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName FROM `cmpmachpartmst` cmp LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID WHERE cmp.refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' AND cmp.autoserialno = '" . $barc . "' ");
        return $str->row();
    }

    function insert($data) {
        $this->db->insert('outmst', $data);
        if ($this->db->affected_rows() > 0) {
            $last = $this->db->insert_id();
            if ($this->db->update('jobmst', array('Status' => 'Out'), array('JobID' => $data['refJobID'])) > 0) {
                return $last;
            }
        }
        return FALSE;
    }

    function update($data, $OutID) {
        if ($this->db->update('outmst', $data, array('OutID' => $OutID)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function delete($OutID) {
        $this->db
                ->where('OutID', $OutID)
                ->delete('outmst');

        return $this->db->affected_rows() > 0;
    }

}
