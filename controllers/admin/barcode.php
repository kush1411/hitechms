<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Barcode
 * ----For Machine Barcode
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Barcode extends MY_admin {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'barcode';
        $this->load->model('barcodemst_m');
    }

    /**
     * function index
     * @descp Used to list all admin barcode
     * @where view page datatable list in admin/barcodes/view (view folder)
     * */
    public function index($ErpSrnID = '') {
        /*
         * @var view : view CatName
         * @title :title of page
         */
        $view = 'barcode/index';
        $this->metas['title'] = array('Admin | Barcode List');
        $data['allbarcode'] = $this->barcodemst_m->getBarcodeList();
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('admin', $view, $data);
    }

    function getbarcode(){
        $view = 'barcode/ajaxbarcode';
        $refconsumer = $this->session->userdata(SITE_NAME . '_user_data')['consumer_id'];
        $this->data['menuaction'] = 'barcodemst';
        $this->data['title'] = 'Inventory | Barcode';
        $this->data['masterName'] = 'Barcode';
        $this->data['masterData'] = $this->barcodemst_m->getBarcodeByCon($refconsumer);
        $data['result'] = $this->load->view('inventory/' . $view, $this->data, true);
        echo json_encode($data);
        die;
    }
    function getbarcodetype(){
        $view = 'barcode/ajaxdata';
        $this->data['type'] = $this->input->get('type');
        $masterId = $this->input->get('id');
        $this->data['masterValue'] = $this->barcodemst_m->getDataByBarcodeId($masterId);
        $this->data['masterID'] = $masterId;
        $data['result'] = $this->load->view('admin/' . $view, $this->data, true);
        echo json_encode($data);
        die;
    }
    function updatebarcode(){
        // need check first than update
        if ($this->input->post()) {
            $masterId = $this->input->post('id');
            $type = $this->input->post('type');
            $SrMode = $this->input->post('SrMode');
            $SrType = $this->input->post('SrType');
            $nSrTypeMode = $this->input->post('nSrTypeMode');
            $dSrTypeMode = $this->input->post('dSrTypeMode');
            $mSrTypeMode = $this->input->post('mSrTypeMode');
            $ySrTypeMode = $this->input->post('ySrTypeMode');
            $SrValue = trim($this->input->post('SrValue'));
            $SrValLength = $this->input->post('SrValLength');
            $SrValue1 = trim($this->input->post('SrValue1'));
            $res = '';
            $updateArray = array();
            $chk_array = array();
            $chk_array['ErpSrnID'] = $masterId;
            $chk_array[$type.'SrMode'] = $updateArray[$type.'SrMode'] = $SrMode;
            if($SrMode == 'manual'){
                $BarType = 'Fix';
                $res = $chk_array[$type.'SrValue'] = $updateArray[$type.'SrValue'] = $SrValue1;
            }
            if($SrMode == 'auto'){
                $BarType = 'Auto';
                $updateArray[$type.'SrType'] = $updateArray[$type.'SrType'] = $SrType;
                if($SrType == 'Number'){
                    $chk_array[$type.'SrTypeMode'] = $updateArray[$type.'SrTypeMode'] = $nSrTypeMode;
                    $chk_array[$type.'SrValue'] = $updateArray[$type.'SrValue'] = $SrValue;
                    $chk_array[$type.'SrValLength'] = $updateArray[$type.'SrValLength'] = $SrValLength;

                        $num_length = strlen((string)($chk_array[$type.'SrValue']));
                        if($num_length == $chk_array[$type.'SrValLength']) {
                           $res = $chk_array[$type.'SrValue'];
                        } else {
                            $numdata = (int)$chk_array[$type.'SrValLength'] - (int)$num_length;
                            $str = '';
                            if($numdata > 0){
                                for($i = 0; $i < $numdata; $i++){
                                    $str .='0';
                                }
                            }
                            $res = $str.$chk_array[$type.'SrValue'];
                        }

                }
                if($SrType == 'Date'){
                    $res = $chk_array[$type.'SrTypeMode'] = $updateArray[$type.'SrTypeMode'] = $dSrTypeMode;
                }
                if($SrType == 'Month'){
                    $res = $chk_array[$type.'SrTypeMode'] = $updateArray[$type.'SrTypeMode'] = $mSrTypeMode;
                }
                if($SrType == 'Year'){
                    $res = $chk_array[$type.'SrTypeMode'] = $updateArray[$type.'SrTypeMode'] = $ySrTypeMode;
                }
            }
            if($res == 'ddmmyy'){
                $res = date('dmY');
            }
            if($res == 'mmddyy'){
                $res = date('mdY');
            }
            if($res == 'mm'){
                $res = date('m');
            }
            if($res == 'M'){
                $res = strtoupper(date('F'));
            }
            if($res == 'yy'){
                $res = date('y');
            }
            if($res == 'Y'){
                $res = date('Y');
            }
            
            if(!empty($updateArray)){
                $updateArray['UpdTerminal'] = $this->input->ip_address();
                $updateArray['UpdDateTime'] = databasedate();
                if($this->barcodemst_m->check_erpsrn($chk_array)){
                    $updateArray['RevDate'] = date('Y-m-d H:i:s');
                }
                if ($this->barcodemst_m->update_erpsrn($updateArray, $masterId)) {
                    echo json_encode(array('res'=>'success','msg'=>$res,'type' => $type,'BarType'=>$BarType));
                    die;
                }else{
                    echo json_encode(array('res'=>'error','msg'=>'Something Went To Wrong, Try Again Later'));
                    die;
                }
            }else{
                 echo json_encode(array('res'=>'error','msg'=>'No Parameter Pass, Try Again'));
                die;
            }
        }else{
            echo json_encode(array('res'=>'error','msg'=>'invalid method'));
            die;
        }
    }

    function deletebarcodetype(){
        if ($this->input->get()) {
            $masterId = $this->input->get('id');
            $type = strtoupper($this->input->get('type'));
            $BarType = $res = '';
            $updateArray = array();
            $updateArray[$type.'SrMode'] = NULL;
            $updateArray[$type.'SrType'] = NULL;
            $updateArray[$type.'SrTypeMode'] = NULL;
            $updateArray[$type.'SrValue'] = '';
            $updateArray[$type.'SrValLength'] = 0;
            $updateArray['RevDate'] = date('Y-m-d H:i:s');
            $updateArray['UpdTerminal'] = $this->input->ip_address();
            $updateArray['UpdDateTime'] = databasedate();
            if ($this->barcodemst_m->update_erpsrn($updateArray, $masterId)) {
                echo json_encode(array('res'=>'success','msg'=>$res,'type' => $type,'BarType'=>$BarType));
                die;
            }else{
                echo json_encode(array('res'=>'error','msg'=>'Something Went To Wrong, Try Again Later'));
                die;
            }
        }else{
            echo json_encode(array('res'=>'error','msg'=>'invalid method'));
            die;
        }
    }

    function edit($ErpSrnID = '') {
        if (!$ErpSrnID)
            show_404();
        /*
         * @var view : view CatName
         * @title :title of page
         */
        $view = 'barcode/update';
        $this->metas['title'] = array('Admin | Barcode | Edit');
        $this->data['barcode'] = $this->barcodemst_m->getDataByBarcodeId($ErpSrnID);
        $this->display_view('admin', $view, $this->data);
    }

}
