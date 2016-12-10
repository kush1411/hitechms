<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Jobmst
 * ----For Jobmst Job
 * ----Important Function index,add,edit,delete,findbarcode
 * -----------------------------
 */

class Jobmst extends My_operator {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'jobmst';
        $this->load->model('jobmst_m');
    }

    public function index() {
//        echo base_url('quotation/' . $this->encryptionk->encodeData(3) . '/' . $this->encryptionk->encodeData(16)); die;
        $view = 'job/index';
        $this->metas['title'] = array('Operator | Job List');
        $this->data['alljobs'] = $this->jobmst_m->getAllJob();
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('operator', $view, $this->data);
    }

    public function add() {
        $view = 'job/add';
        $this->metas['title'] = array('Operator | Job | Add');
        $config = array(
            array('field' => 'refMachID', 'label' => 'refMachID', 'rules' => 'trim|required'),
            array('field' => 'BarcodeNo', 'label' => 'BarcodeNo', 'rules' => 'trim|required'),
            array('field' => 'refProviderID', 'label' => 'refProviderID', 'rules' => 'trim'),
            array('field' => 'refEmpID', 'label' => 'refEmpID', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'Issue', 'label' => 'Issue', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'Remarks', 'label' => 'Remarks', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'QuotAmt', 'label' => 'QuotAmt', 'rules' => 'trim|xss_clean|strip_tags'),
        );
        $this->form_validation->set_rules($config);

//        $this->data['machine'] = $this->jobmst_m->getJobmst();
        $this->data['provider'] = $this->jobmst_m->getProvider();
        $this->data['employee'] = $this->jobmst_m->getEmployee();

        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCompID'] = $this->session->userdata(SITE_NAME . '_operator_data')['CompID'];
            $data['refEmpID'] = $this->form_validation->set_value('refEmpID');
            $data['refMachID'] = $this->form_validation->set_value('refMachID');
            $data['BarcodeNo'] = $this->form_validation->set_value('BarcodeNo');
            $data['refProviderID'] = $this->form_validation->set_value('refProviderID');
            $data['Issue'] = $this->form_validation->set_value('Issue');
            $data['Remarks'] = $this->form_validation->set_value('Remarks');
            $data['QuotAmt'] = $this->form_validation->set_value('QuotAmt');
            $data['IsWarranty'] = $this->input->post('IsWarranty');
            if ($data['IsWarranty'] == 1) {
                $data['Status'] = 'Pending';
            } else {
                $data['Status'] = 'Quotation Request Sent';
            }
            $data['InsUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($jobid = $this->jobmst_m->insert($data)) {
                if ($data['IsWarranty'] == 0) {
                    $provider = $this->jobmst_m->getProviderEmail($data['BarcodeNo']);
					$email['subject'] = ' Need Quoation';
                    $email['company'] = User::find('first', array('conditions' => array('id = ?', $this->session->userdata(SITE_NAME . '_operator_data')['CompID'])));
                    $email['Product'] = $this->jobmst_m->getDetailDataBySrNo($data['BarcodeNo']);
                    if ($email['Product']->SubPartName == NULL) {
                        $email['Product']->ProductName = $email['Product']->PartName;
                    } else {
                        $email['Product']->ProductName = $email['Product']->SubPartName;
                    }
                    if (!empty($provider)) {
                        foreach ($provider as $key => $value) {
                            $email['link'] = base_url('quotation/' . $this->encryptionk->encodeData($jobid) . '/' . $this->encryptionk->encodeData($value->SerProvID));
                            $email['Name'] = $value->Name;
                            $emailid = $value->Email;
                            $this->_send_email('require_quotation', $emailid, $email);
                        }
                    }
                }
                $this->_show_message('Job Is Created Successfully', 'success');
                redirect('operator/jobmst');
            }
        } else {
            if ($this->input->post())
                $this->data['jobmst'] = (object) $this->input->post();
        }
        $this->display_view('operator', $view, $data);
    }

    public function quotation($JobID = '') {
        if (!$JobID)
            show_404();

        $view = 'job/quotation';
        $this->metas['title'] = array('Operator | Job | Quotation');
        $data['quotationlist'] = $this->jobmst_m->getQuotationByJobId($JobID);
        $data['job'] = $this->jobmst_m->getJobByID($JobID);
        if ($this->input->post()) {
            $selectedProvider = $this->input->post('selectedProvider');
            $selprv = explode('__11__', $selectedProvider);
            $ins = array();
            $ins['refProviderID'] = $selprv[0];
            $ins['QuotAmt'] = $selprv[1];
            $ins['Remarks'] = $this->input->post('Remarks');
            $ins['Status'] = 'Quotation Applied';
            try {
                if (isset($_FILES['file']['tmp_name'])) {
                    $uploaddir = './uploads/quotation/';
                    $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                    $file_name = md5(preg_replace('/[\s]+/', '_', strtolower(trim($_FILES['file']['name']))) . date('Ymdhis')) . '.' . $ext;
                    $uploadfile = $uploaddir . $file_name;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                        $ins['filename'] = $file_name;
                    } else {
                        $this->_show_message('File Not Uploaded', 'error');
                        redirect('operator/jobmst/quotation/' . $JobID);
                    }
                }
            } catch (Exception $e) {
                $this->_show_message('Something Went Wrong, Try Again', 'error');
                redirect('operator/jobmst/quotation/' . $JobID);
            }
            if ($this->jobmst_m->update($ins, $JobID)) {
                $this->_show_message('Quoation Applied Successfully', 'success');
                redirect('operator/jobmst');
            } else {
                $this->_show_message('Quoation Not Applied, Try Again', 'error');
                redirect('operator/jobmst/quotation/' . $JobID);
            }
        }
        $this->display_view('operator', $view, $data);
    }

    public function pdf($JobID = '') {
        if (!$JobID)
            show_404();

        $quotationlist = $this->jobmst_m->getQuotationByJobId($JobID);
        $partsdata = $this->jobmst_m->getJobByID($JobID);
        $partname = $partsdata->PartName;
        if($partsdata->SubPartName != '' || $partsdata->SubPartName != NULL){
            $partname = $partsdata->SubPartName;
        }
        $warranty = $partsdata->MachWarrantyFrom.' To '.$partsdata->MachWarrantyTo;
        if($partsdata->WarrantyFrom != '' || $partsdata->WarrantyFrom != '0000-00-00'){
            $warranty = $partsdata->WarrantyFrom.' To '.$partsdata->WarrantyTo;
        }
        $warranty = trim($warranty) == 'To' ? 'NA' : $warranty;
        $tbl = '';
        if (isset($quotationlist) && !empty($quotationlist)) {
            $tbl .= '<table width="100%" class="one" style="margin-bottom: 3em;border-collapse: collapse;display: inline-block;">' .
                    '<thead>' .
                    '<tr style="height: 1em;">' .
                    '<th colspan="3" style="width: 50%;text-align: left;border: 1px solid grey;padding: 1em;background-color: #fff;color: white;"><img src="' . base_url() . 'assets/admin/img/logoadmin.png"></th>' .
                    '<th colspan="3" style="border: 1px solid grey;width: 50%;color: #425065;font-size: 18px;text-align: right;line-height: 150%;font-weight: bold;letter-spacing: 2px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 1em;background-color: #fff;" valign="middle" align="right">Quotation</th>' .
                    '</tr>' .
                    '<tr><td colspan="6">&nbsp;</td></tr><tr><td colspan="6">'.
                    '<p><b>Machine :</b> '.$partsdata->MachCode .'-'.$partsdata->MachName.'</p>'.
                    '<p><b>Parts :</b> '.$partname.' ('.$partsdata->SerialNo.')</p>'.
                    '<p><b>Mfg :</b> '.$partsdata->MfgName.'</p>'.
                    '<p><b>Purchase :</b> '.$partsdata->MachPurDate.'</p>'.
                    '<p><b>Warranty :</b> '.$warranty.'</p>'.
                    '</td></tr><tr><td colspan="6">&nbsp;</td></tr>'.
                    '<tr style="height: 1em; background-color: #eee;">' .
                    '<td colspan="6" style="text-align: right;width: 100%;border: 1px solid grey;padding: 1em;">&nbsp;</td>' .
                    '</tr>' .
                    '</thead>' .
                    '<tbody>' .
                    '<tr style="height: 1em;">' .
                    '<td style="text-align: center;width: 10%;border: 1px solid grey;padding: 1em;">Select#</td>' .
                    '<td style="text-align: center;width: 35%;border: 1px solid grey;padding: 1em;">Provider Name</td>' .
                    '<td style="text-align: center;width: 15%;border: 1px solid grey;padding: 1em;">Quotation Amt</td>' .
                    '<td style="text-align: center;width: 20%;border: 1px solid grey;padding: 1em;">Remarks</td>' .
                    '<td style="text-align: center;width: 20%;border: 1px solid grey;padding: 1em;">Date</td>' .
                    '</tr>';
            foreach ($quotationlist as $k => $user) {
                $style = $k % 2 == 0 ? 'style="height: 1em; background-color: #eee;"' : 'style="height: 1em;"';
                $tbl .='<tr ' . $style . '>' .
                        '<td style="text-align: center;width: 10%;border: 1px solid grey;padding: 1em;">&nbsp;</td>' .
                        '<td style="text-align: left;width: 35%;border: 1px solid grey;padding: 1em;">' . $user->Name . '</td>' .
                        '<td style="text-align: right;width: 15%;border: 1px solid grey;padding: 1em;">' . number_format($user->quotation, 2) . '</td>' .
                        '<td style="text-align: left;width: 20%;border: 1px solid grey;padding: 1em;">' . $user->remarks . '</td>' .
                        '<td style="text-align: center;width: 20%;border: 1px solid grey;padding: 1em;">' . date("d-m-Y", strtotime($user->InsDateTime)) . '</td>' .
                        '</tr>';
            }

            $tbl .= '</tbody>' .
                    '</table>';

            $this->load->library('Pdf');
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor(SITE_NAME);
            $pdf->SetTitle('Quotation');
            $pdf->SetSubject('Quotation');
            $pdf->SetKeywords('Quotation, print, pdf');
            $pdf->setPrintHeader(true);
            $pdf->setPrintFooter(true);

            $pdf->setHeaderData('', 0, '', '', array(255, 255, 255), array(255, 255, 255));

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            // set some language dependent data:
            $lg = Array();
            $lg['a_meta_charset'] = 'UTF-8';
            $lg['a_meta_dir'] = 'ltr';
            $lg['a_meta_language'] = 'fa';
            $lg['w_page'] = 'page';
            // set some language-dependent strings (optional)
            $pdf->setLanguageArray($lg);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->startPageGroup();
            $pdf->setRTL(false);
            $pdf->AddPage();
            $pdf->writeHTML($tbl, true, false, false, false, '');
            $date = date("Y_m_d_H_i_s");
            $pdfName = 'Quotation_' . str_replace(' ', '', $date) . '.pdf';
            $pdf->Output($pdfName, 'D'); //D,F
            die;
        } else {
            $this->_show_message('Quotation List Not Generated', 'error');
            redirect('operator/jobmst/quotation/' . $JobID);
        }
    }

    public function edit($JobID = '') {
        if (!$JobID)
            show_404();

        $view = 'job/edit';
        $this->metas['title'] = array('Operator | Job | Add');
        $config = array(
            array('field' => 'refMachID', 'label' => 'refMachID', 'rules' => 'trim|required'),
            array('field' => 'BarcodeNo', 'label' => 'BarcodeNo', 'rules' => 'trim|required'),
            array('field' => 'refProviderID', 'label' => 'refProviderID', 'rules' => 'trim'),
            array('field' => 'refEmpID', 'label' => 'refEmpID', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'Issue', 'label' => 'Issue', 'rules' => 'trim|required|xss_clean|strip_tags'),
            array('field' => 'Remarks', 'label' => 'Remarks', 'rules' => 'trim|xss_clean|strip_tags'),
            array('field' => 'QuotAmt', 'label' => 'QuotAmt', 'rules' => 'trim|xss_clean|strip_tags'),
        );
        $this->form_validation->set_rules($config);

        $this->data['jobmst'] = $this->jobmst_m->getJobByID($JobID);
        $this->data['quotationlist'] = $this->jobmst_m->getQuotationByJobId($JobID);
//        $this->data['machine'] = $this->jobmst_m->getJobmst();
        $this->data['provider'] = $this->jobmst_m->getProvider();
        $this->data['employee'] = $this->jobmst_m->getEmployee();

        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refEmpID'] = $this->form_validation->set_value('refEmpID');
            $data['refProviderID'] = $this->form_validation->set_value('refProviderID');
            $data['Issue'] = $this->form_validation->set_value('Issue');
            $data['Remarks'] = $this->form_validation->set_value('Remarks');
            $data['QuotAmt'] = $this->form_validation->set_value('QuotAmt');
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_operator_data')['operator_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
//            if($this->data['jobmst']->Status == 'Quotation Applied'){
//                
//            }else if($this->data['jobmst']->Status == 'Quotation Request Sent'){
//                $data['Status'] = '';
//            }else if($this->data['jobmst']->Status == 'Pending'){
//                
//            }
            if ($this->jobmst_m->update($data, $JobID)) {
                $this->_show_message('Job Is Edited Successfully', 'success');
                redirect('operator/jobmst');
            }
        } else {
            if ($this->input->post())
                $this->data['jobmst'] = (object) $this->input->post();
        }
        $this->display_view('operator', $view, $data);
    }

    function findbarcode() {
        $barc = $this->input->get('barc');
        if ($barc != '') {
            $parts = $this->jobmst_m->getDataBySrNo($barc);
            if (!empty($parts)) {
                $chckmate = $this->jobmst_m->checkDataBySrNo($barc);
                if ($chckmate == 0) {
                    $data = $this->jobmst_m->getDetailDataBySrNo($barc);
                    $warranty = $this->jobmst_m->checkWarrantyBySrNo($barc);
                    if ($warranty > 0) {
                        $data->ProviderID = $this->jobmst_m->getProviderByMfg($data->MachMfgID);
                        $data->Warranty = 1;
                    } else {
                        $data->Warranty = 0;
                        $data->ProviderID = 0;
                    }
                    if ($data->SubPartName == NULL) {
                        $data->ProductName = $data->PartName;
                    } else {
                        $data->ProductName = $data->SubPartName;
                    }
                    $response['res'] = 'success';
                    $response['msg'] = $data;
                } else {
                    $response['res'] = 'alert';
                    $response['msg'] = 'Part Already In Service';
                }
            } else {
                $response['res'] = 'error';
                $response['msg'] = 'Invalid Barcode';
            }
        } else {
            $response['res'] = 'error';
            $response['msg'] = 'Wrong Method';
        }
        echo json_encode($response);
        die;
    }

    function delete() {
        if ($this->input->post()) {
			$JobID = $this->input->post('JobID');
            $data = array();
            $data['Remarks'] = $this->input->post('Remarks');
            $data['Status'] = 'Deleted';
            if ($this->jobmst_m->update($data, $JobID)) {
                $this->_show_message('Job Is Deleted Successfully', 'success');
                redirect('operator/jobmst');
            } else {
                $this->_show_message('Job Is Not Deleted Successfully, Try Again', 'error');
                redirect('operator/jobmst/edit/' . $JobID);
            }
        } else {
            $this->_show_message('Some thing went wrong, Try Again', 'error');
            redirect('operator/jobmst/edit/' . $JobID);
        }
    }

    public function addquot($jobid) {
        $view = 'job/addquot';
        $this->metas['title'] = array('Operator | Job | AddQuotation');

        if ($jobid > 0) {
            $this->data['provider'] = $this->jobmst_m->getProvider();
            $data = array();
            if ($this->input->post()) {
                $data['refJobID'] = $jobid;
                $data['refSerProvID'] = $this->input->post('refProviderID');
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
                    $this->_show_message('Quotation Add Successfuly', 'success');
                    redirect('operator/jobmst/quotation/'.$jobid);
                }
            }
            $this->display_view('operator', $view, $data);
        }else{
            show_404();
        }
    }
}
