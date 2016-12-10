<?php

class Mfgmst extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getMfg() {
        $str = $this->db->query("SELECT * FROM `mfgmst` ORDER BY UpdDateTime DESC ");
        return $str->result();
    }

    function getMfgByID($MfgID) {
        $str = $this->db->query("SELECT * FROM `mfgmst` WHERE MfgID = '" . $MfgID . "' ");
        return $str->row();
    }

    function insert($data) {
        $this->db->insert('mfgmst', $data);
        if ($this->db->affected_rows() > 0) {
            $last = $this->db->insert_id();
            $insert = array();
            $insert['refCompID'] = 0;
            $insert['refMfgID'] = $last;
            $insert['Name'] = $data['MfgName'];
            $insert['Addr1'] = $data['MfgAddr1'];
            $insert['Addr2'] = $data['MfgAddr2'];
            $insert['City'] = $data['MfgCity'];
            $insert['State'] = $data['MfgState'];
            $insert['Country'] = $data['MfgCountry'];
            $insert['Pincode'] = $data['MfgPincode'];
            $insert['Contact1'] = $data['MfgContactNumber1'];
            $insert['Contact2'] = $data['MfgContactNumber2'];
            $insert['Email'] = $data['MfgEmail'];
            $insert['Status'] = 1;
            $insert['InsDateTime'] = date("Y:m:d H:i:s");
            $insert['InsTerminal'] = $this->input->ip_address();
            $insert['UpdDateTime'] = date("Y:m:d H:i:s");
            $insert['UpdTerminal'] = $this->input->ip_address();
            $this->db->insert('serviceprovider', $insert);
            return $last;
        }
        return FALSE;
    }

    function update($data, $id) {
        if ($this->db->update('mfgmst', $data, array('MfgID' => $id)) > 0) {
            $insert = array();
            $insert['Name'] = isset($data['MfgName']) ? $data['MfgName'] : '';
            $insert['Addr1'] = isset($data['MfgAddr1']) ? $data['MfgAddr1']:'';
            $insert['Addr2'] = isset($data['MfgAddr2']) ? $data['MfgAddr2']:'';
            $insert['City'] = isset($data['MfgCity']) ? $data['MfgCity']:'';
            $insert['State'] = isset($data['MfgState']) ? $data['MfgState']:'';
            $insert['Country'] = isset($data['MfgCountry']) ? $data['MfgCountry']:'';
            $insert['Pincode'] = isset($data['MfgPincode']) ? $data['MfgPincode']:'';
            $insert['Contact1'] = isset($data['MfgContactNumber1']) ? $data['MfgContactNumber1']:'';
            $insert['Contact2'] = isset($data['MfgContactNumber2']) ? $data['MfgContactNumber2']:'';
            $insert['Email'] = isset($data['MfgEmail']) ? $data['MfgEmail']:'';
            $insert['Status'] = 1;
            $insert['InsDateTime'] = date("Y:m:d H:i:s");
            $insert['InsTerminal'] = $this->input->ip_address();
            $insert['UpdDateTime'] = date("Y:m:d H:i:s");
            $insert['UpdTerminal'] = $this->input->ip_address();
            $insert = array_filter($insert);
            $this->db->update('serviceprovider', $insert, array('refMfgID' => $id));
            return TRUE;
        }
        return FALSE;
    }

    function deleteAll($MfgID) {
        $this->db
                ->where_in('MfgID', $MfgID)
                ->delete('mfgmst');

        if ($this->db->affected_rows() > 0) {
            $this->db
                    ->where_in('refMfgID', $MfgID)
                    ->delete('serviceprovider');
            return TRUE;
        }
        return FALSE;
    }

    function delete($MfgID) {
        $this->db
                ->where('MfgID', $MfgID)
                ->delete('mfgmst');

        if ($this->db->affected_rows() > 0) {
            $this->db
                    ->where('refMfgID', $MfgID)
                    ->delete('serviceprovider');
            return TRUE;
        }
        return FALSE;
    }

    function check($name, $MfgID) {
        if ($MfgID == '') {
            $sql = "SELECT * FROM `mfgmst` WHERE MfgName = '" . $name . "' ";
        } else {
            $sql = "SELECT * FROM `mfgmst` WHERE MfgID <> '" . $MfgID . "' AND MfgName = '" . $name . "' ";
        }
        $str = $this->db->query($sql);
        return $str->row();
    }

}
