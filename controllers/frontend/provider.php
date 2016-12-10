<?php

/*
 * -----------------------------
 * ----Author Kushal
 * ----Class Provider
 * ----For Machine Provider
 * ----Important Function index,add,edit,delete,active,deactive
 * -----------------------------
 */

class Provider extends My_front {

    public function __construct() {
        parent::__construct();
        $this->data['menuaction'] = 'provider';
        $this->load->model('providermst');
    }

    /**
     * function index
     * @descp Used to list all frontend provider
     * @where view page datatable list in providers/view (view folder)
     * */
    public function index($SerProvID = '') {
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'provider/view';
        $this->metas['title'] = array('Client | Provider List');
        $data['allprovider'] = $this->providermst->getProvider();
        /*
         * checking user all rights and sent to view
         * for its permission view
         */
        $this->data['userRights'] = $this->check_rights();
        $this->display_view('frontend', $view, $data);
    }

    public function add() {
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'provider/add';
        $this->metas['title'] = array('Client | Provider | Add');
        $config = array(
            array('field' => 'Name', 'label' => 'Name', 'rules' => 'required|is_unique[serviceprovider.Name]'),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
            array('field' =>'Addr1', 'label' => 'Addr1', 'rules' => 'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Addr2', 'label' => 'Addr2', 'rules' => 'trim|trim|xss_clean|strip_tags'),
            array('field' =>'City', 'label' => 'City', 'rules' => 'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'State', 'label' => 'State', 'rules' => 'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Country','label' =>  'Country','rules' =>  'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Pincode', 'label' => 'Pincode', 'rules' => 'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Contact1','label' =>  'Contact1','rules' =>  'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Contact2','label' =>  'Contact2','rules' =>  'trim|trim|xss_clean|strip_tags'),
            array('field' => 'Email', 'label' => 'Email', 'rules' =>'trim|required|trim|xss_clean|strip_tags|valid_email'),
            array('field' => 'WebUrl', 'label' => 'WebUrl', 'rules' =>'trim|trim|xss_clean|strip_tags|valid_url')
        );
        $this->form_validation->set_rules($config);
        $seesiondata = $this->session->userdata(SITE_NAME . '_user_data');
        $user_id = $seesiondata['user_id'];
        $data = array();
        if ($this->form_validation->run()) {
            $data = array();
            $data['refCompID'] = $user_id;
            $data['Name'] = $this->form_validation->set_value('Name');
            $data['Addr1'] = $this->form_validation->set_value('Addr1');
            $data['Addr2'] = $this->form_validation->set_value('Addr2');
            $data['City'] = $this->form_validation->set_value('City');
            $data['State'] = $this->form_validation->set_value('State');
            $data['Country'] = $this->form_validation->set_value('Country');
            $data['Pincode'] = $this->form_validation->set_value('Pincode');
            $data['Contact1'] = $this->form_validation->set_value('Contact1');
            $data['Contact2'] = $this->form_validation->set_value('Contact2');
            $data['Email'] = $this->form_validation->set_value('Email');
            $data['WebUrl'] = $this->form_validation->set_value('WebUrl');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['InsDateTime'] = date("Y:m:d H:i:s");
            $data['InsTerminal'] = $this->input->ip_address();
            $data['UpdDateTime'] = date("Y:m:d H:i:s");
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->providermst->insert($data)) {
                $this->_show_message('Provider is added successfully', 'success');
                redirect('provider');
            }
        } else {
            if ($this->input->post())
                $this->data['provider'] = (object) $this->input->post();
        }
        $this->display_view('frontend', $view, $data);
    }

    function edit($SerProvID = '') {
        if (!$SerProvID)
            show_404();
        /*
         * @var view : view Name
         * @title :title of page
         */
        $view = 'provider/add';
        $this->metas['title'] = array('Client | Provider | Edit');
        $this->data['provider'] = $this->providermst->getProviderByID($SerProvID);
        if($this->input->post('Name') != $this->data['provider']->Name) {
            $is_unique1 =  '|is_unique[serviceprovider.Name]';
        } else {
           $is_unique1 =  '';
        }
        $config = array(
            array('field' => 'Name', 'label' => 'Name', 'rules' => 'required|'.$is_unique1),
            array('field' => 'Status', 'label' => 'Status', 'rules' => 'required'),
            array('field' =>'Addr1', 'label' => 'Addr1', 'rules' => 'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Addr2', 'label' => 'Addr2', 'rules' => 'trim|trim|xss_clean|strip_tags'),
            array('field' =>'City', 'label' => 'City', 'rules' => 'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'State', 'label' => 'State', 'rules' => 'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Country','label' =>  'Country','rules' =>  'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Pincode', 'label' => 'Pincode', 'rules' => 'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Contact1','label' =>  'Contact1','rules' =>  'trim|required|trim|xss_clean|strip_tags'),
            array('field' =>'Contact2','label' =>  'Contact2','rules' =>  'trim|trim|xss_clean|strip_tags'),
            array('field' => 'Email', 'label' => 'Email', 'rules' =>'trim|required|trim|xss_clean|strip_tags|valid_email'),
            array('field' => 'WebUrl', 'label' => 'WebUrl', 'rules' =>'trim|trim|xss_clean|strip_tags|valid_url')
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $data = array();
            $data['Name'] = $this->form_validation->set_value('Name');
            $data['Addr1'] = $this->form_validation->set_value('Addr1');
            $data['Addr2'] = $this->form_validation->set_value('Addr2');
            $data['City'] = $this->form_validation->set_value('City');
            $data['State'] = $this->form_validation->set_value('State');
            $data['Country'] = $this->form_validation->set_value('Country');
            $data['Pincode'] = $this->form_validation->set_value('Pincode');
            $data['Contact1'] = $this->form_validation->set_value('Contact1');
            $data['Contact2'] = $this->form_validation->set_value('Contact2');
            $data['Email'] = $this->form_validation->set_value('Email');
            $data['WebUrl'] = $this->form_validation->set_value('WebUrl');
            $data['Status'] = $this->form_validation->set_value('Status');
            $data['UpdDateTime'] = date('Y-m-d H:i:s');
            $data['UpdTerminal'] = $this->input->ip_address();
            if ($this->providermst->update($data, $SerProvID)) {
                $this->_show_message('Provider is edited successfully', 'success');
                redirect('provider');
            }
        } else {
            if ($this->input->post()) {
                $this->data['provider'] = (object) $this->input->post();
                $this->_show_message('Error while Editing', 'error');
            }
        }
        $this->display_view('frontend', $view, $this->data);
    }

    function delete($SerProvID = '') {
        if ($this->input->post('option')) {
            $SerProvIDs = $this->input->post('option');
            if($this->providermst->deleteAll($SerProvIDs)){
                $this->_show_message("Provider deleted", 'success');
            }
        } else {
            if (!$SerProvID)
                show_404();
            if($this->providermst->delete($SerProvID)){
                $this->_show_message("Provider deleted", 'success');
            }
            
        }
        redirect('provider');
    }

    function activate($SerProvID = '') {
        if (!$SerProvID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '1';
        if ($this->providermst->update($editActivation, $SerProvID)) {
            $this->_show_message("Provider activated successfully", 'success');
            redirect('provider');
        }
    }

    function deactivate($SerProvID = '') {
        if (!$SerProvID)
            show_404();
        $editActivation = array();
        $editActivation['Status'] = '0';
        if ($this->providermst->update($editActivation, $SerProvID)){
            $this->_show_message("Provider deactivated successfully", 'success');
            redirect('provider');
        }
    }
	
	function check($SerProvID = '') {
		$name = $this->input->get('Name');
        $category = $this->providermst->check($name, $SerProvID);
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }
	
	function checkfirst() {
		$name = $this->input->get('Name');
        $category = $this->providermst->check($name, '');
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }
	
	function checkemail($SerProvID = '') {
		$name = $this->input->get('Email');
        $category = $this->providermst->checkemail($name, $SerProvID);
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }
	
	function checkemailfirst() {
		$name = $this->input->get('Email');
        $category = $this->providermst->checkemail($name, '');
		if(empty($category)){
			echo 'true';
		}else{
			echo 'false';
		}
		die;
    }

}
