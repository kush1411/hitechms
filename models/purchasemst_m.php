<?php

class Purchasemst_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllPurchase() {
        //$str = $this->db->query("SELECT j.*,cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName,sp.Name as ProviderName FROM `purchasemst` j LEFT JOIN `cmpmachpartmst` cmp ON cmp.autoserialno = j.BarcodeNo LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID LEFT JOIN serviceprovider sp ON sp.SerProvID = j.refProviderID WHERE j.refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' ORDER BY j.InsDateTime DESC ");
        $str = $this->db->query("SELECT p.PurchaseID,p.refJobID,p.PurAmt,p.UpdDateTime,cmp.WarrantyFrom,cmp.WarrantyTo,cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName,sp.Name as ProviderName FROM `purchasemst` p LEFT JOIN `cmpmachpartmst` cmp ON cmp.CmpMachPartID = p.refCmpMachPartID LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID LEFT JOIN serviceprovider sp ON sp.SerProvID = p.refProviderID WHERE p.refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' ORDER BY p.UpdDateTime DESC ");
        return $str->result();
    }
    
    function getPurchaseByID($PurchaseID){
        $str = $this->db->query("SELECT j.*,cm.MachCode,cm.MachName,cm.refMfgID as MachMfgID,mpm.PartName,mspm.SubPartName,mfg.MfgName FROM `purchasemst` j LEFT JOIN `cmpmachpartmst` cmp ON cmp.autoserialno = j.BarcodeNo LEFT JOIN `cmpmachmst` cm ON cm.MachID = cmp.refMachID LEFT JOIN `machpartsmst` mpm ON mpm.MachPartID = cmp.refMachPartID LEFT JOIN `machsubpartsmst` mspm ON mspm.MachSubPartID = cmp.refMachSubPartID LEFT JOIN `mfgmst` mfg ON mfg.MfgID = cmp.refMfgID WHERE j.refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' AND j.PurchaseID = '".$PurchaseID."' ");
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
    
    function insert($data,$account) {
        $this->db->insert('purchasemst', $data);
        if ($this->db->affected_rows() > 0) {
            $last = $this->db->insert_id();
            $account['refPurchaseID'] = $last;
            $this->db->insert('account', $account);
            $this->db->update('jobmst', array('Status' => 'Purchase'), array('JobID' => $data['refJobID']));
            return $last;
        }
        return FALSE;
    }
    
    function insert_part($data) {
        $this->db->insert('cmpmachpartmst', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function checkQuotation($PurchaseID){
        $str = $this->db->query("SELECT j.Status FROM `purchasemst` j  WHERE j.PurchaseID = '".$PurchaseID."' ");
        $res = $str->row();
        if($res->Status == 'Quotation Request Sent'){
            return FALSE;
        }
        return TRUE;
    }
    
    function getQuotationByPurchaseId($PurchaseID){
        $q = "SELECT m1.*,s.Name FROM quotation m1 LEFT JOIN quotation m2 ON (m1.refSerProvID = m2.refSerProvID AND m1.QuotationID < m2.QuotationID) LEFT JOIN serviceprovider s ON s.SerProvID = m1.refSerProvID WHERE m2.QuotationID IS NULL AND m1.refPurchaseID = '".$PurchaseID."' ORDER BY m1.InsDateTime";
        $str = $this->db->query($q);
        //$str = $this->db->query("SELECT q.*,s.Name FROM `quotation` q LEFT JOIN serviceprovider s ON s.SerProvID = q.refSerProvID WHERE q.refPurchaseID = '".$PurchaseID."' ORDER BY q.InsDateTime ");
        return $str->result();
    }
    
    function insert_quotation($data){
        $this->db->insert('quotation', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    function getProviderEmail(){
        $str = $this->db->query("SELECT SerProvID, Email, Name FROM `serviceprovider` WHERE refCompID='" . $this->session->userdata(SITE_NAME . '_operator_data')['CompID'] . "' OR refCompID='0' ORDER BY Name ");
        return $str->result();
    }
    
    function update($data, $id) {
        if ($this->db->update('purchasemst', $data, array('PurchaseID' => $id)) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function delete($PurchaseID) {
        $this->db->where('PurchaseID', $PurchaseID)->delete('purchasemst');
        return $this->db->affected_rows() > 0;
    }
    
    function getDataBySrNo($barc){
        $str = $this->db->query("SELECT p.* FROM `pomst` p INNER JOIN jobmst j ON j.JobID = p.refJobID WHERE p.refCompID='".$this->session->userdata(SITE_NAME . '_operator_data')['CompID']."' AND j.BarcodeNo = '".$barc."' AND (p.Status = 'Job Pending' OR p.Status = 'Quotation Applied') ");
        return $str->row();
    }
    
    function checkDataBySrNo($barc){
        $str = $this->db->query("SELECT COUNT(*) as cnt FROM jobmst WHERE BarcodeNo = '".$barc."' AND (Status = 'Purchase Order Generated')");
        $res = $str->row();
        return $res->cnt;
    }
    
    function getJobIDBySrNo($barc){
        $str = $this->db->query("SELECT JobID FROM jobmst WHERE BarcodeNo = '".$barc."' AND (Status = 'Discardable')");
        $res = $str->row();
        return $res->JobID;
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
    
    function getPart($refMachID) {
        $str = $this->db->query("SELECT p.* FROM `machpartsmst` p INNER JOIN cmpmachmst cm ON cm.refTypeID = p.refTypeID WHERE p.Status = 1 AND cm.MachID = '" . $refMachID . "'");
        return $str->result();
    }
    function getSubPart($refPartID) {
        $str = $this->db->query("SELECT p.* FROM `machsubpartsmst` p  WHERE p.Status = 1 AND p.refMachPartID = '" . $refPartID . "'");
        return $str->result();
    }
    function getMfgByPartsID($partid) {
        $str = $this->db->query("SELECT m.* FROM `machpartsmfg` p INNER JOIN mfgmst m ON m.MfgID = p.refMfgID WHERE m.Status = 1 AND p.refMachPartID = '" . $partid . "'");
        return $str->result();
    }
    function getMfgBySubPartsID($subpartid) {
        $str = $this->db->query("SELECT m.* FROM `machsubpartsmfg` sp INNER JOIN mfgmst m ON m.MfgID = sp.refMfgID WHERE m.Status = 1 AND sp.refMachSubPartID = '" . $subpartid . "'");
        return $str->result();
    }
    function checkserialparts($name, $MachPartID) {
        $seesiondata = $this->session->userdata(SITE_NAME . '_operator_data');
        $user_id = $seesiondata['CompID'];
        if ($MachPartID == '') {
            $sql = "SELECT * FROM `cmpmachpartmst` WHERE SerialNo = '" . $name . "' AND refCompID = '" . $user_id . "'";
        } else {
            $sql = "SELECT * FROM `cmpmachpartmst` WHERE MachPartID <> '" . $MachPartID . "' AND SerialNo = '" . $name . "' AND refCompID = '" . $user_id . "' ";
        }
        $str = $this->db->query($sql);
        return $str->row();
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
