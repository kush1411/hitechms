<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Jobmst
 * ----For Jobmst Job
 * ----Important Function index,add,edit,delete,findbarcode
 * -----------------------------
 */

class Quotation extends MY_base {

    public function __construct() {
        parent::__construct();
        $this->load->model('jobmst_m');
        $this->load->model('purchasejob_m');
    }

    public function index($jobid, $SerProvID) {
        $view = 'add';
        $this->metas['title'] = array('Quotation');
        $jobid1 = $this->encryptionk->decodeData($jobid);
        $SerProvID1 = $this->encryptionk->decodeData($SerProvID);
        if ($jobid1 > 0 && $SerProvID1 > 0) {
            if ($this->jobmst_m->checkQuotation($jobid1)) {
                $this->_show_message('Sorry Work Given To Other', 'error');
                redirect('thankyou');
            } else {
                $data = array();
                if ($this->input->post()) {
                    $data['refJobID'] = $jobid1;
                    $data['refSerProvID'] = $SerProvID1;
                    $data['quotation'] = $this->input->post('quotation');
                    $data['remarks'] = $this->input->post('remarks');
                    try {
                        if (isset($_FILES['file']['tmp_name'])) {
                            $uploaddir = './uploads/quotation/';
                            $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                            $file_name = md5(preg_replace('/[\s]+/', '_', strtolower(trim($_FILES['file']['name']))) . date('s')) . '.' . $ext;
                            $uploadfile = $uploaddir . $file_name;
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                                $data['filename'] = $file_name;
                            }
                        }
                    } catch (Exception $e) {
                        
                    }
                    $data['InsDateTime'] = date('Y-m-d H:i:s');
                    $data['InsTerminal'] = $this->input->ip_address();
                    if ($this->jobmst_m->insert_quotation($data)) {
                        $this->_show_message('Quotation Send Successfuly', 'success');
                        redirect('thankyou');
                    } else {
                        $this->_show_message('Something Went Wrong, Try Again', 'error');
                        redirect('quotation/' . $jobid . '/' . $SerProvID);
                    }
                }
                $this->display_view('quotation', $view, $data, true);
            }
        } else {
            show_404();
        }
    }
    
    public function pjquotation($poid, $SerProvID) {
        $view = 'pjadd';
        $this->metas['title'] = array('Quotation');
        $poid1 = $this->encryptionk->decodeData($poid);
        $SerProvID1 = $this->encryptionk->decodeData($SerProvID);
        if ($poid1 > 0 && $SerProvID1 > 0) {
            if ($this->purchasejob_m->checkQuotation($poid1)) {
                $this->_show_message('Sorry Work Given To Other', 'error');
                redirect('thankyou');
            } else {
                $data = array();
                if ($this->input->post()) {
                    $data['refPOID'] = $poid1;
                    $data['refSerProvID'] = $SerProvID1;
                    $data['quotation'] = $this->input->post('quotation');
                    $data['remarks'] = $this->input->post('remarks');
                    try {
                        if (isset($_FILES['file']['tmp_name'])) {
                            $uploaddir = './uploads/quotation/';
                            $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                            $file_name = md5(preg_replace('/[\s]+/', '_', strtolower(trim($_FILES['file']['name']))) . date('s')) . '.' . $ext;
                            $uploadfile = $uploaddir . $file_name;
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                                $data['filename'] = $file_name;
                            }
                        }
                    } catch (Exception $e) {
                        
                    }
                    $data['InsDateTime'] = date('Y-m-d H:i:s');
                    $data['InsTerminal'] = $this->input->ip_address();
                    if ($this->purchasejob_m->insert_quotation($data)) {
                        $this->_show_message('Quotation Send Successfuly', 'success');
                        redirect('thankyou');
                    } else {
                        $this->_show_message('Something Went Wrong, Try Again', 'error');
                        redirect('pjquotation/' . $poid . '/' . $SerProvID);
                    }
                }
                $this->display_view('quotation', $view, $data, true);
            }
        } else {
            show_404();
        }
    }

    function thankyou() {
        $view = 'thankyou';
        $data = array();
        $this->display_view('quotation', $view, $data, true);
    }

}
