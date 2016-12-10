<?php

class Jobmst_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllJob() {
        $str = $this->db->query("SELECT j.*,cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName,sp.Name as ProviderName FROM `jobmst` j LEFT JOIN `cmpmachpartmst` cmp ON cmp.autoserialno = j.BarcodeNo LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID LEFT JOIN serviceprovider sp ON sp.SerProvID = j.refProviderID WHERE j.refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' ORDER BY j.InsDateTime DESC ");
        return $str->result();
    }
    
    function getJobByID($JobID){
        $str = $this->db->query("SELECT j.*,cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,cm.MachPurDate,cm.MachWarrantyFrom,cm.MachWarrantyTo,mpm.PartName,mspm.SubPartName,mfg.MfgName, cmp.WarrantyFrom,cmp.WarrantyTo,cmp.SerialNo FROM `jobmst` j LEFT JOIN `cmpmachpartmst` cmp ON cmp.autoserialno = j.BarcodeNo LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID WHERE j.refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' AND j.JobID = '".$JobID."' ");
        return $str->row();
    }
    
    function getMachine() {
        $str = $this->db->query("SELECT * FROM `cmpmachmst` WHERE refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' AND MachStatus=1 ORDER BY MachCode");
        return $str->result();
    }

    function getProvider() {
        $str = $this->db->query("SELECT * FROM `serviceprovider` WHERE refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' OR refCompID='0' ORDER BY Name ");
        return $str->result();
    }

    function getEmployee() {
        $str = $this->db->query("SELECT e.*, d.Name as DesigName, l.Name as LocationName FROM `empmst` e LEFT JOIN designmst d ON d.DesignID = e.refDesgnID LEFT JOIN locationmst l ON l.LocID = e.refLocID WHERE e.refCompID = '" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' ORDER BY EmpName");
        return $str->result();
    }
    
    function insert($data) {
        $this->db->insert('jobmst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function checkQuotation($JobID){
        $str = $this->db->query("SELECT j.Status FROM `jobmst` j  WHERE j.JobID = '".$JobID."' ");
        $res = $str->row();

        if(!empty($res) && $res->Status == 'Quotation Request Sent'){
            return FALSE;
        }
        return TRUE;
    }
    
    function getQuotationByJobId($JobID){
        $q = "SELECT m1.*,s.Name FROM quotation m1 LEFT JOIN quotation m2 ON (m1.refSerProvID = m2.refSerProvID AND m1.QuotationID < m2.QuotationID) LEFT JOIN serviceprovider s ON s.SerProvID = m1.refSerProvID WHERE m2.QuotationID IS NULL AND m1.refJobID = '".$JobID."' ORDER BY m1.InsDateTime";
        $str = $this->db->query($q);
        //$str = $this->db->query("SELECT q.*,s.Name FROM `quotation` q LEFT JOIN serviceprovider s ON s.SerProvID = q.refSerProvID WHERE q.refJobID = '".$JobID."' ORDER BY q.InsDateTime ");
        return $str->result();
    }
    
    function insert_quotation($data){
        $this->db->insert('quotation', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function getProviderEmail($barcodeid){
        $sql = "(SELECT SerProvID, Email, Name FROM `serviceprovider` WHERE refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "') UNION (SELECT SerProvID, Email, Name FROM `serviceprovider` WHERE refMfgID IN (SELECT ml.refMfgID2 FROM `cmpmachpartmst` cmp INNER JOIN mailmst ml ON ml.refMfgID1 = cmp.refMfgID  WHERE cmp.autoserialno = '".$barcodeid."') )";
        $str = $this->db->query($sql);
        return $str->result();
    }
    
    function update($data, $id) {
        if ($this->db->update('jobmst', $data, array('JobID' => $id)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function delete($JobID) {
        $this->db->where('JobID', $JobID)->delete('jobmst');
        return $this->db->affected_rows() > 0;
    }
    
    function getDataBySrNo($barc){
        $str = $this->db->query("SELECT * FROM `cmpmachpartmst` WHERE refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' AND autoserialno = '".$barc."' ");
        return $str->row();
    }
    
    function checkDataBySrNo($barc){
		$q = "SELECT COUNT(*) as cnt FROM jobmst WHERE BarcodeNo = '".$barc."' AND Status <> 'Done' AND Status <> 'Discardable' AND Status <> 'Deleted' "; //
		//echo $q; die;
        $str = $this->db->query($q);
        $res = $str->row();
        return $res->cnt;
    }
    
    function getDetailDataBySrNo($barc){
        $str = $this->db->query("SELECT cmp.*,cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName FROM `cmpmachpartmst` cmp LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID WHERE cmp.refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' AND cmp.autoserialno = '".$barc."' ");
        return $str->row();
    }
    
    function checkWarrantyBySrNo($barc){
        $str = $this->db->query("SELECT COUNT(*) as cnt FROM `cmpmachpartmst` cmp LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID WHERE cmp.refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' AND cmp.autoserialno = '".$barc."' AND cm.MachWarrantyFrom <= '".date('Y-m-d')."' AND MachWarrantyTo >=  '".date('Y-m-d')."'");
        $res = $str->row();
        return $res->cnt;
    }
    
    function getProviderByMfg($MachMfgID){
        $str = $this->db->query("SELECT SerProvID FROM `serviceprovider` WHERE 	refMfgID='".$MachMfgID."' ");
        $res = $str->row();
        return $res->SerProvID;
    }
    
    
    
    
    
    function getMfgByTypeID($TypeID) {
        $str = $this->db->query("SELECT refMfgID FROM `typemfgmst` WHERE refTypeID='" . $TypeID . "' ");
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
        $this->db->insert_batch('typemfgmst', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    

    function deleteAll($TypeID) {
        $this->db
                ->where_in('TypeID', $TypeID)
                ->delete('typemst');

        return $this->db->affected_rows() > 0;
    }

    

    function deletebatch($TypeID) {
        $this->db
                ->where('refTypeID', $TypeID)
                ->delete('typemfgmst');

        return $this->db->affected_rows() > 0;
    }

    function check($name, $refCatID, $TypeID) {
        if ($TypeID == '') {
            $sql = "SELECT * FROM `typemst` WHERE TypeName = '" . $name . "' AND refCatID = '" . $refCatID . "'";
        } else {
            $sql = "SELECT * FROM `typemst` WHERE TypeID <> '" . $TypeID . "' AND TypeName = '" . $name . "' AND refCatID = '" . $refCatID . "'";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

}
