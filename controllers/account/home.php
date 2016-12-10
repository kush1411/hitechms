<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends My_account {

    function __construct() {
        parent::__construct();
        $this->load->model('accountmst');
       // $this->_api_require_user(array('only' => array('checkout', 'addaddress', 'confirm')));
    }

    public function index() {
        $this->data['menuaction'] = 'dashboard';
        $view = 'home/dashboard';
        $this->data['allaccount'] = $this->accountmst->getAccount();
        if(!empty($this->data['allaccount'])){
            foreach ($this->data['allaccount'] as $key => $value) {
                if($value->refPurchaseID != NULL && $value->refPurchaseID != 0 && $value->refPurchaseID !=''){
                    $this->data['allaccount'][$key]->provider = $this->accountmst->getProviderByPurchase($value->refPurchaseID);
                }else{
                    $this->data['allaccount'][$key]->provider = $this->accountmst->getProviderByJob($value->refJobID);
                }
            }
        }
        $this->display_view('account', $view, $this->data);
    }
    
    public function edit($AccountID){
        if (!$AccountID)
            show_404();

        $view = 'home/edit';
        $this->metas['title'] = array('Operator | Job | Add');
        $config = array(
            array('field' => 'PaymentDate', 'label' => 'PaymentDate', 'rules' => 'trim|required'),
            array('field' => 'PaymentType', 'label' => 'PaymentType', 'rules' => 'trim|required'),
            array('field' => 'PaymentTakenPerson', 'label' => 'PaymentTakenPerson', 'rules' => 'trim'),
        );
        $this->form_validation->set_rules($config);

        $this->data['account'] = $this->accountmst->getAccountByID($AccountID);

        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $old = $this->form_validation->set_value('PaymentDate');
            $new = explode('/', $old);
            $data['PaymentDate'] = $new[2] . '-' . $new[1] . '-' . $new[0].' '.date('H:i:s');
            $data['PaymentType'] = $this->form_validation->set_value('PaymentType');
            $data['PaymentTakenPerson'] = $this->form_validation->set_value('PaymentTakenPerson');
            $data['UpdUser'] = $this->session->userdata(SITE_NAME . '_account_data')['account_id'];
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if($data['PaymentType'] != ''){
                $data['Status'] = 'Done';
            }
            if ($this->accountmst->update($data, $AccountID)) {
                $this->_show_message('Account Is Edited Successfully', 'success');
                redirect('account/dashboard');
            }
        } else {
            if ($this->input->post())
                $this->data['account'] = (object) $this->input->post();
        }
        $this->display_view('account', $view, $data);
    }
    

}

?>
