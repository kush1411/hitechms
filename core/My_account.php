<?php

//@author name Shafiq
/*
 * Class My_front
 * Use for the front end extend
 * and checking for the valide login 
 * in contrustor
 * 
 */
class My_account extends MY_base {

    function __construct() {
        parent::__construct();
        $this->front_js_css();
        $this->data['folder_type'] = ACCOUNTFOLDERNAME;
        if(!$this->session->userdata(SITE_NAME . '_account_data')){ 
            redirect('/account');
        }else{
//            $seesiondata = $this->session->userdata(SITE_NAME . '_account_data');
//            $user_id = $seesiondata['account_id'];
//            $this->data['CompDetails'] = Userprofile::find('first',array('conditions' => array('user_id = ?', $user_id)));
        }
    }

    function front_js_css() {
        array_push($this->scripts['js'],'admin/js/libs/jquery/jquery-1.11.2.min.js', 'admin/js/libs/jquery/jquery-migrate-1.2.1.min.js', 'admin/js/libs/bootstrap/bootstrap.min.js','admin/js/libs/spin.js/spin.min.js','admin/js/libs/autosize/jquery.autosize.min.js','admin/js/libs/DataTables/jquery.dataTables.min.js','admin/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js','admin/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js','admin/js/libs/nanoscroller/jquery.nanoscroller.min.js','admin/js/libs/select2/select2.min.js', 'admin/js/libs/bootstrap-datepicker/bootstrap-datepicker.js','admin/js/core/source/App.js','admin/js/core/source/AppNavigation.js','admin/js/core/source/AppOffcanvas.js','admin/js/core/source/AppCard.js','admin/js/core/source/AppForm.js','admin/js/core/source/AppNavSearch.js','admin/js/core/source/AppVendor.js','admin/js/core/demo/Demo.js','admin/js/core/demo/DemoTableDynamic.js','admin/js/core/demo/DemoFormComponents.js');
        array_push($this->scripts['css'],'admin/css/bootstrap.css','admin/css/style.css','admin/css/font-awesome.min.css','admin/css/material-design-iconic-font.min.css','admin/css/libs/DataTables/jquery.dataTables.css','admin/css/libs/DataTables/extensions/dataTables.colVis.css','admin/css/libs/DataTables/extensions/dataTables.tableTools.css','admin/css/libs/select2/select2.css','admin/css/libs/multi-select/multi-select.css','admin/css/libs/bootstrap-datepicker/datepicker3.css');
    }

    function _api_require_user($params = array()) {
        if (empty($params['except']))
            $params['except'] = array();
        if (empty($params['only']))
            $params['only'] = array();
        if (count($params['except']) > 0 AND in_array($this->data['action'], $params['except']))
            return TRUE;
        if (count($params['only']) > 0 AND !in_array($this->data['action'], $params['only']))
            return TRUE;
        if ($this->session->userdata(SITE_NAME . '_account_data') && $this->session->userdata[SITE_NAME . '_account_data']['account_id'] > 0) {
            return TRUE; //user is logged in    
        }
        redirect('login');
    }

    function pagination($count = 0, $url = '', $limit = 0) {
        $config['base_url'] = $url;
        $config['total_rows'] = $count;
        $config['per_page'] = $limit;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['prev_link'] = '<i style="top:2px;" class="glyphicon glyphicon-arrow-left"></i>&nbsp; Previous';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next &nbsp;<i style="top:2px;" class="glyphicon glyphicon-arrow-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><span class="selected">';
        $config['cur_tag_close'] = '</span></li>';
        $config['last_link'] = 'Last';
        $config['first_link'] = 'First';
        $config['last_tag_open'] = '<li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        return $config;
    }
	
	function check_rights($rights = '', $module = '', $check = FALSE) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
    }

    public function getMaxNum($fixNum,$last_number){
        $newBarcodeStr = '';
        $maxLen = strlen($fixNum);
        $newNum = (int)$last_number + 1;
        $newLen = strlen((string)$newNum);
        if($newLen > $maxLen){
           $newBarcodeStr .= 'error';
        }else{
            $numdata = (int) $maxLen - (int) $newLen;
            $str = '';
            if ($numdata > 0) {
                for ($i = 0; $i < $numdata; $i++) {
                    $str .='0';
                }
            }
            $newBarcodeStr .= $str.$newNum;
        }
        return $newBarcodeStr;
    }
    
    function _get_auto_id() {
        $this->load->model('barcodemst_m');
        $refCompID = $this->session->userdata(SITE_NAME . '_account_data')['CompID'];
        $masterValue = $this->barcodemst_m->getBarcodeByTypeCon($refCompID);
        $last_insert = $this->barcodemst_m->getLastRecordByCon($refCompID, $masterValue->RevDate, $masterValue->ErpSrnID);
        $barcode_pattern = array();
        $new_inser_id = array();
        $newBarCode = '';

        if ($masterValue->F1SrMode != '') {
            $f1str = '';
            $barcode_pattern['F1']['Type'] = $masterValue->F1SrMode;
            if ($masterValue->F1SrMode == 'manual') {
                $f1str = $masterValue->F1SrValue;
                $barcode_pattern['F1']['value'] = $f1str;
                $barcode_pattern['F1']['revType'] = '';
            }
            if ($masterValue->F1SrMode == 'auto') {
                if ($masterValue->F1SrType == 'Number') {
                    $num_length = strlen((string) ($masterValue->F1SrValue));
                    if ($num_length == $masterValue->F1SrValLength) {
                        $f1str = $masterValue->F1SrValue;
                    } else {
                        $numdata = (int) $masterValue->F1SrValLength - (int) $num_length;
                        $str = '';
                        if ($numdata > 0) {
                            for ($i = 0; $i < $numdata; $i++) {
                                $str .='0';
                            }
                        }
                        $f1str = $str . $masterValue->F1SrValue;
                    }
                }
                if ($masterValue->F1SrType == 'Date') {
                    if ($masterValue->F1SrTypeMode === 'ddmmyy') {
                        $f1str = date('dmY');
                    }
                    if ($masterValue->F1SrTypeMode === 'mmddyy') {
                        $f1str = date('mdY');
                    }
                }
                if ($masterValue->F1SrType == 'Month') {
                    if ($masterValue->F1SrTypeMode === 'mm') {
                        $f1str = date('m');
                    }
                    if ($masterValue->F1SrTypeMode === 'M') {
                        $f1str = strtoupper(date('F'));
                    }
                }
                if ($masterValue->F1SrType == 'Year') {
                    if ($masterValue->F1SrTypeMode === 'yy') {
                        $f1str = date('y');
                    }
                    if ($masterValue->F1SrTypeMode === 'Y') {
                        $f1str = date('Y');
                    }
                }
                $barcode_pattern['F1']['value'] = $f1str;
                $barcode_pattern['F1']['Type'] = $masterValue->F1SrType;
                $barcode_pattern['F1']['revType'] = $masterValue->F1SrTypeMode;
            }
            $newBarCode .= $new_inser_id['F1'] =  $f1str;
        }
        if ($masterValue->F2SrMode != '') {
            $f1str = '';
            $barcode_pattern['F2']['Type'] = $masterValue->F2SrMode;
            if ($masterValue->F2SrMode == 'manual') {
                $f1str = $masterValue->F2SrValue;
                $barcode_pattern['F2']['value'] = $f1str;
                $barcode_pattern['F2']['revType'] = '';
            }
            if ($masterValue->F2SrMode == 'auto') {
                if ($masterValue->F2SrType == 'Number') {
                    $num_length = strlen((string) ($masterValue->F2SrValue));
                    if ($num_length == $masterValue->F2SrValLength) {
                        $f1str = $masterValue->F2SrValue;
                    } else {
                        $numdata = (int) $masterValue->F2SrValLength - (int) $num_length;
                        $str = '';
                        if ($numdata > 0) {
                            for ($i = 0; $i < $numdata; $i++) {
                                $str .='0';
                            }
                        }
                        $f1str = $str . $masterValue->F2SrValue;
                    }
                }
                if ($masterValue->F2SrType == 'Date') {
                    if ($masterValue->F2SrTypeMode === 'ddmmyy') {
                        $f1str = date('dmY');
                    }
                    if ($masterValue->F2SrTypeMode === 'mmddyy') {
                        $f1str = date('mdY');
                    }
                }
                if ($masterValue->F2SrType == 'Month') {
                    if ($masterValue->F2SrTypeMode === 'mm') {
                        $f1str = date('m');
                    }
                    if ($masterValue->F2SrTypeMode === 'M') {
                        $f1str = strtoupper(date('F'));
                    }
                }
                if ($masterValue->F2SrType == 'Year') {
                    if ($masterValue->F2SrTypeMode === 'yy') {
                        $f1str = date('y');
                    }
                    if ($masterValue->F2SrTypeMode === 'Y') {
                        $f1str = date('Y');
                    }
                }
                $barcode_pattern['F2']['value'] = $f1str;
                $barcode_pattern['F2']['Type'] = $masterValue->F2SrType;
                $barcode_pattern['F2']['revType'] = $masterValue->F2SrTypeMode;
            }
            $newBarCode .= $new_inser_id['F2'] = $f1str;
        }
        if ($masterValue->F3SrMode != '') {
            $f1str = '';
            $barcode_pattern['F3']['Type'] = $masterValue->F3SrMode;
            if ($masterValue->F3SrMode == 'manual') {
                $f1str = $masterValue->F3SrValue;
                $barcode_pattern['F3']['value'] = $f1str;
                $barcode_pattern['F3']['revType'] = '';
            }
            if ($masterValue->F3SrMode == 'auto') {
                if ($masterValue->F3SrType == 'Number') {
                    $num_length = strlen((string) ($masterValue->F3SrValue));
                    if ($num_length == $masterValue->F3SrValLength) {
                        $f1str = $masterValue->F3SrValue;
                    } else {
                        $numdata = (int) $masterValue->F3SrValLength - (int) $num_length;
                        $str = '';
                        if ($numdata > 0) {
                            for ($i = 0; $i < $numdata; $i++) {
                                $str .='0';
                            }
                        }
                        $f1str = $str . $masterValue->F3SrValue;
                    }
                }
                if ($masterValue->F3SrType == 'Date') {
                    if ($masterValue->F3SrTypeMode === 'ddmmyy') {
                        $f1str = date('dmY');
                    }
                    if ($masterValue->F3SrTypeMode === 'mmddyy') {
                        $f1str = date('mdY');
                    }
                }
                if ($masterValue->F3SrType == 'Month') {
                    if ($masterValue->F3SrTypeMode === 'mm') {
                        $f1str = date('m');
                    }
                    if ($masterValue->F3SrTypeMode === 'M') {
                        $f1str = strtoupper(date('F'));
                    }
                }
                if ($masterValue->F3SrType == 'Year') {
                    if ($masterValue->F3SrTypeMode === 'yy') {
                        $f1str = date('y');
                    }
                    if ($masterValue->F3SrTypeMode === 'Y') {
                        $f1str = date('Y');
                    }
                }
                $barcode_pattern['F3']['value'] = $f1str;
                $barcode_pattern['F3']['Type'] = $masterValue->F3SrType;
                $barcode_pattern['F3']['revType'] = $masterValue->F3SrTypeMode;
            }
            $newBarCode .= $new_inser_id['F3'] =  $f1str;
        }
        if ($masterValue->F4SrMode != '') {
            $f1str = '';
            $barcode_pattern['F4']['Type'] = $masterValue->F4SrMode;
            if ($masterValue->F4SrMode == 'manual') {
                $f1str = $masterValue->F4SrValue;
                $barcode_pattern['F4']['value'] = $f1str;
                $barcode_pattern['F4']['revType'] = '';
            }
            if ($masterValue->F4SrMode == 'auto') {
                if ($masterValue->F4SrType == 'Number') {
                    $num_length = strlen((string) ($masterValue->F4SrValue));
                    if ($num_length == $masterValue->F4SrValLength) {
                        $f1str = $masterValue->F4SrValue;
                    } else {
                        $numdata = (int) $masterValue->F4SrValLength - (int) $num_length;
                        $str = '';
                        if ($numdata > 0) {
                            for ($i = 0; $i < $numdata; $i++) {
                                $str .='0';
                            }
                        }
                        $f1str = $str . $masterValue->F4SrValue;
                    }
                }
                if ($masterValue->F4SrType == 'Date') {
                    if ($masterValue->F4SrTypeMode === 'ddmmyy') {
                        $f1str = date('dmY');
                    }
                    if ($masterValue->F4SrTypeMode === 'mmddyy') {
                        $f1str = date('mdY');
                    }
                }
                if ($masterValue->F4SrType == 'Month') {
                    if ($masterValue->F4SrTypeMode === 'mm') {
                        $f1str = date('m');
                    }
                    if ($masterValue->F4SrTypeMode === 'M') {
                        $f1str = strtoupper(date('F'));
                    }
                }
                if ($masterValue->F4SrType == 'Year') {
                    if ($masterValue->F4SrTypeMode === 'yy') {
                        $f1str = date('y');
                    }
                    if ($masterValue->F4SrTypeMode === 'Y') {
                        $f1str = date('Y');
                    }
                }
                $barcode_pattern['F4']['value'] = $f1str;
                $barcode_pattern['F4']['Type'] = $masterValue->F4SrType;
                $barcode_pattern['F4']['revType'] = $masterValue->F4SrTypeMode;
            }
            $newBarCode .= $new_inser_id['F4'] = $f1str;
        }
        if ($masterValue->F5SrMode != '') {
            $f1str = '';
            $barcode_pattern['F5']['Type'] = $masterValue->F5SrMode;
            if ($masterValue->F5SrMode == 'manual') {
                $f1str = $masterValue->F5SrValue;
                $barcode_pattern['F5']['value'] = $f1str;
                $barcode_pattern['F5']['revType'] = '';
            }
            if ($masterValue->F5SrMode == 'auto') {
                if ($masterValue->F5SrType == 'Number') {
                    $num_length = strlen((string) ($masterValue->F5SrValue));
                    if ($num_length == $masterValue->F5SrValLength) {
                        $f1str = $masterValue->F5SrValue;
                    } else {
                        $numdata = (int) $masterValue->F5SrValLength - (int) $num_length;
                        $str = '';
                        if ($numdata > 0) {
                            for ($i = 0; $i < $numdata; $i++) {
                                $str .='0';
                            }
                        }
                        $f1str = $str . $masterValue->F5SrValue;
                    }
                }
                if ($masterValue->F5SrType == 'Date') {
                    if ($masterValue->F5SrTypeMode === 'ddmmyy') {
                        $f1str = date('dmY');
                    }
                    if ($masterValue->F5SrTypeMode === 'mmddyy') {
                        $f1str = date('mdY');
                    }
                }
                if ($masterValue->F5SrType == 'Month') {
                    if ($masterValue->F5SrTypeMode === 'mm') {
                        $f1str = date('m');
                    }
                    if ($masterValue->F5SrTypeMode === 'M') {
                        $f1str = strtoupper(date('F'));
                    }
                }
                if ($masterValue->F5SrType == 'Year') {
                    if ($masterValue->F5SrTypeMode === 'yy') {
                        $f1str = date('y');
                    }
                    if ($masterValue->F5SrTypeMode === 'Y') {
                        $f1str = date('Y');
                    }
                }
                $barcode_pattern['F5']['value'] = $f1str;
                $barcode_pattern['F5']['Type'] = $masterValue->F5SrType;
                $barcode_pattern['F5']['revType'] = $masterValue->F5SrTypeMode;
            }
            $newBarCode .= $new_inser_id['F5'] = $f1str;
        }
        if ($masterValue->F6SrMode != '') {
            $f1str = '';
            $barcode_pattern['F6']['Type'] = $masterValue->F6SrMode;
            if ($masterValue->F6SrMode == 'manual') {
                $f1str = $masterValue->F6SrValue;
                $barcode_pattern['F6']['value'] = $f1str;
                $barcode_pattern['F6']['revType'] = '';
            }
            if ($masterValue->F6SrMode == 'auto') {
                if ($masterValue->F6SrType == 'Number') {
                    $num_length = strlen((string) ($masterValue->F6SrValue));
                    if ($num_length == $masterValue->F6SrValLength) {
                        $f1str = $masterValue->F6SrValue;
                    } else {
                        $numdata = (int) $masterValue->F6SrValLength - (int) $num_length;
                        $str = '';
                        if ($numdata > 0) {
                            for ($i = 0; $i < $numdata; $i++) {
                                $str .='0';
                            }
                        }
                        $f1str = $str . $masterValue->F6SrValue;
                    }
                }
                if ($masterValue->F6SrType == 'Date') {
                    if ($masterValue->F6SrTypeMode === 'ddmmyy') {
                        $f1str = date('dmY');
                    }
                    if ($masterValue->F6SrTypeMode === 'mmddyy') {
                        $f1str = date('mdY');
                    }
                }
                if ($masterValue->F6SrType == 'Month') {
                    if ($masterValue->F6SrTypeMode === 'mm') {
                        $f1str = date('m');
                    }
                    if ($masterValue->F6SrTypeMode === 'M') {
                        $f1str = strtoupper(date('F'));
                    }
                }
                if ($masterValue->F6SrType == 'Year') {
                    if ($masterValue->F6SrTypeMode === 'yy') {
                        $f1str = date('y');
                    }
                    if ($masterValue->F6SrTypeMode === 'Y') {
                        $f1str = date('Y');
                    }
                }
                $barcode_pattern['F6']['value'] = $f1str;
                $barcode_pattern['F6']['Type'] = $masterValue->F6SrType;
                $barcode_pattern['F6']['revType'] = $masterValue->F6SrTypeMode;
            }
             $newBarCode .= $new_inser_id['F6'] = $f1str;
        }
        if ($masterValue->F7SrMode != '') {
            $f1str = '';
            $barcode_pattern['F7']['Type'] = $masterValue->F7SrMode;
            if ($masterValue->F7SrMode == 'manual') {
                $f1str = $masterValue->F7SrValue;
                $barcode_pattern['F7']['value'] = $f1str;
                $barcode_pattern['F7']['revType'] = '';
            }
            if ($masterValue->F7SrMode == 'auto') {
                if ($masterValue->F7SrType == 'Number') {
                    $num_length = strlen((string) ($masterValue->F7SrValue));
                    if ($num_length == $masterValue->F7SrValLength) {
                        $f1str = $masterValue->F7SrValue;
                    } else {
                        $numdata = (int) $masterValue->F7SrValLength - (int) $num_length;
                        $str = '';
                        if ($numdata > 0) {
                            for ($i = 0; $i < $numdata; $i++) {
                                $str .='0';
                            }
                        }
                        $f1str = $str . $masterValue->F7SrValue;
                    }
                }
                if ($masterValue->F7SrType == 'Date') {
                    if ($masterValue->F7SrTypeMode === 'ddmmyy') {
                        $f1str = date('dmY');
                    }
                    if ($masterValue->F7SrTypeMode === 'mmddyy') {
                        $f1str = date('mdY');
                    }
                }
                if ($masterValue->F7SrType == 'Month') {
                    if ($masterValue->F7SrTypeMode === 'mm') {
                        $f1str = date('m');
                    }
                    if ($masterValue->F7SrTypeMode === 'M') {
                        $f1str = strtoupper(date('F'));
                    }
                }
                if ($masterValue->F7SrType == 'Year') {
                    if ($masterValue->F7SrTypeMode === 'yy') {
                        $f1str = date('y');
                    }
                    if ($masterValue->F7SrTypeMode === 'Y') {
                        $f1str = date('Y');
                    }
                }
                $barcode_pattern['F7']['value'] = $f1str;
                $barcode_pattern['F7']['Type'] = $masterValue->F7SrType;
                $barcode_pattern['F7']['revType'] = $masterValue->F7SrTypeMode;
            }
             $newBarCode .= $new_inser_id['F7'] = $f1str;
        }

        if (!empty($last_insert)) {
            //echo 'OLD Barcode :: '.$last_insert->F1.$last_insert->F2.$last_insert->F3.$last_insert->F4.$last_insert->F5.$last_insert->F6.$last_insert->F7.'<br>';die;
            $newBarcodeStr = '';
            $last_insert_id = array();
            $last_insert_id['F1'] = $last_insert->F1;
            $last_insert_id['F2'] = $last_insert->F2;
            $last_insert_id['F3'] = $last_insert->F3;
            $last_insert_id['F4'] = $last_insert->F4;
            $last_insert_id['F5'] = $last_insert->F5;
            $last_insert_id['F6'] = $last_insert->F6;
            $last_insert_id['F7'] = $last_insert->F7;
            $last_insert_id = array_filter($last_insert_id);

            $new_pattern_length = count($barcode_pattern);
            $old_pattern_length = count($last_insert_id);
            if($new_pattern_length === $old_pattern_length){
                foreach ($barcode_pattern as $key => $value) {
                    if($value['Type'] === 'manual'){
                        $newBarcodeStr .= $new_inser_id[$key]= $value['value'];
                    }else{
                        if($value['Type'] === 'Date'){
                           $newBarcodeStr .= $new_inser_id[$key]= $value['value'];
                        }
                        if($value['Type'] === 'Month'){
                           $newBarcodeStr .= $new_inser_id[$key]= $value['value'];
                        }
                        if($value['Type'] === 'Year'){
                           $newBarcodeStr .= $new_inser_id[$key]= $value['value'];
                        }
                        if($value['Type'] === 'Number'){
                           $last_number = $last_insert_id[$key];
                            if($value['revType'] === '*'){
                                $newBarcodeStr .= $new_inser_id[$key]= $this->getMaxNum($value['value'],$last_number);
                            }
                            if($value['revType'] === '*d'){
                                $last_date = explode(' ', $last_insert->InsDateTime);
                                $last_date = $last_date[0];
                                if(trim($last_date) == date('Y-m-d')){
                                    $newBarcodeStr .= $new_inser_id[$key]= $this->getMaxNum($value['value'],$last_number);
                                }else{
                                    $newBarcodeStr .= $new_inser_id[$key]=$value['value'];
                                }
                            }
                            if($value['revType'] === '*m'){
                                $last_date = explode(' ', $last_insert->InsDateTime);
                                $datestr = explode('-',$last_date[0]);
                                $lastMnth = $datestr[1];
                                if(trim($lastMnth) == date('m')){
                                    $newBarcodeStr .= $new_inser_id[$key]= $this->getMaxNum($value['value'],$last_number);
                                }else{
                                    $newBarcodeStr .= $new_inser_id[$key]= $value['value'];
                                }
                            }
                            if($value['revType'] === '*y'){
                                $last_date = explode(' ', $last_insert->InsDateTime);
                                $datestr = explode('-',$last_date[0]);
                                $lastyear = $datestr[0];

                                if(trim($lastyear) == date('Y')){
                                    $newBarcodeStr .= $new_inser_id[$key]= $this->getMaxNum($value['value'],$last_number);
                                }else{
                                    $newBarcodeStr .= $new_inser_id[$key]= $value['value'];

                                }
                            }
                        }
                    }
                }
                if($this->barcodemst_m->chck_duplicate($newBarcodeStr,$new_inser_id,$last_insert->barcodeID,'',$refCompID)){
                    return $this->_get_auto_id();
                }else{
                     return array('barcode' => $newBarcodeStr, 'barcode_array' => $new_inser_id,'id' => $last_insert->barcodeID);
                }
            }else{
                if($this->barcodemst_m->chck_duplicate($newBarcodeStr,$new_inser_id,$last_insert->barcodeID,'',$refCompID)){
                    return $this->_get_auto_id();
                }else{
                    return array('barcode' => $newBarCode, 'barcode_array' => $new_inser_id,'id' => $last_insert->barcodeID);
                }
            }
        } else {

            if($this->barcodemst_m->chck_duplicate($newBarCode,$new_inser_id,'',$masterValue->ErpSrnID,$refCompID)){
                return $this->_get_auto_id();
            }else{
                $delBarId = $this->barcodemst_m->getID($masterValue->ErpSrnID,$refCompID);
                return array('barcode' => $newBarCode, 'barcode_array' => $new_inser_id,'id' => $delBarId);
            }
            //echo 'New Barcode :: '.$newBarCode.'<br>';
        }
    }

}
