<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Newsletters extends MY_admin {

    function index() {
//        $data['userRight'] = $this->get_rights();
        $data['alldata'] = Newsletter::find('all', array('order' => 'updated desc'));
        $view = "newsletter/view";
        $this->display_view('admin', $view, $data);
    }

    function add() {
        $view = "newsletter/add";
        array_push($this->scripts['js'], 'admin/tinymc/tinymce.min.js', 'frontend/js/jquery-ui.js', 'admin/js/products/product.js');
        array_push($this->scripts['css'], 'frontend/css/jquery_ui.css');
        $desc = 'tinymce.init({ selector: "#newsletter_content"});tinymce.init({ selector: "#washcare"}); ';
        array_push($this->scripts['embed'], $desc);
        $this->form_validation->set_rules('newsletterName', 'Newsletter Name', 'required');
        if ($this->form_validation->run()) {
            $conn = Newsletter::connection();
            $conn->transaction();
            try {
                $addnews['newsletterName'] = $this->form_validation->set_value('newsletterName');
                $addnews['newsletter_content'] = $this->input->post('newsletter_content');
                $addnews['created'] = date("Y-m-d");
                $addnews['updated'] = date("Y-m-d");
                $news = new Newsletter($addnews);
                $news->save();
                $conn->commit();
                $this->_show_message("Newslwtter added succeessfully", 'success');
                redirect('admin/newsletters/list');
            } catch (Exception $e) {
                $this->write_logs($e);
            }
        }
        $this->display_view('admin', $view);
    }

    function edit($id = "") {
        $view = "newsletter/add";
        array_push($this->scripts['js'], 'admin/tinymc/tinymce.min.js', 'frontend/js/jquery-ui.js', 'admin/js/products/product.js');
        array_push($this->scripts['css'], 'frontend/css/jquery_ui.css');
        $desc = 'tinymce.init({ selector: "#newsletter_content"});tinymce.init({ selector: "#washcare"}); ';
        array_push($this->scripts['embed'], $desc);
        $data['editdata'] = Newsletter::find($id);
        $this->form_validation->set_rules('newsletterName', 'Newsletter Name', 'required');
        if ($this->form_validation->run()) {
            $conn = Newsletter::connection();
            $conn->transaction();
            try {
                $editnews = Newsletter::find($id);
                $editnews->newslettername = $this->form_validation->set_value('newsletterName');
                $editnews->newsletter_content = $this->input->post('newsletter_content');
                $editnews->updated = date("Y-m-d");
                $editnews->save();
                $conn->commit();
                $this->_show_message("Newslwtter updated succeessfully", 'success');
                redirect('admin/newsletters/list');
            } catch (Exception $e) {
                $this->write_logs($e);
            }
        } else {
            if ($this->input->post())
                $data['postdata'] = $this->input->postdata();
        }
        $this->display_view('admin', $view, $data);
    }

    function delete($id = "") {
        if ($this->input->post()) {
            $ids = $this->input->post('option');
            $deleteObj = Newsletter::find('all', array('conditions' => array('id in (?)', $ids)));
            foreach ($deleteObj as $obj) {
                $obj->delete();
            }
            $this->_show_message("Newsletter deleted", 'success');
            redirect('admin/newsletters');
        } else {
            if (!$id)
                show_404();
            $deleteObj = Newsletter :: find($id);
            $deleteObj->delete();
            $this->_show_message("Newsletter deleted", 'success');
            redirect('admin/newsletters');
        }
    }

    function send_mail($id) {
        if (!empty($id)) {
            $this->data['id'] = $id;
        }
        $this->session->set_userdata('id', $id);
        $view = "newsletter/alluser";
        $data['alluser'] = Subscribnewsletters::find('all');
        $this->display_view('admin', $view, $data);
    }

    function mail() {
        if ($list = $this->input->post('mail')) {
            $newslwtter = Newsletter::find_by_id($this->session->userdata('id'));
            $data['contents'] = $newslwtter->newsletter_content;
            $data['site_name'] = 'cozysham';
            $data['link'] = base_url("frontend/home/subscribenewsletter/" . $auto_id);

            $data['name'] = $newslwtter->newslettername;
            $data['subject'] = 'newsletters';
            foreach ($list as $k => $email) {
                $emails = $email;
                $this->_send_email("admin_newsletter", $emails, $data);
            }
            $this->_show_message("Newsletter send successfully", "success");
            redirect('admin/newsletters/list');
        } else {

            $this->_show_message('error_message', 'Please Check atleast one checkbox');
            redirect('admin/newsletters/send_mail/' . $this->input->post('newsletter_id'));
        }
    }

    function send_to_all($id) {
        $newsletter = Newsletter::find_by_id($id);
        $data['contents'] = $newsletter->newsletter_content;
        $data['name'] = $newsletter->newslettername;
        $data['subject'] = 'newsletters';
        $user = Subscribnewsletters::all(array('conditions' => array('status= ?', '1')));
        foreach ($user as $email) {
            $mail = $email->email;
            $this->_send_email("admin_newsletter", $mail, $data);
        }
        $this->_show_message("Newsletter send successfully", "success");
        redirect('admin/newsletters/list');
    }

    function activate($id = '') {
        if (!$id)
            show_404();

        $editCategory = Subscribnewsletters::find_by_id($id);
        $editCategory->status = '1';
        $editCategory->save();
        $this->_show_message("User activated successfully", 'success');
        redirect('admin/newsletters/send_mail/' . $this->session->userdata('id'));
    }

    function deactivate($id = '') {
        if (!$id)
            show_404();
        $editCategory = Subscribnewsletters::find_by_id($id);
        $editCategory->status = '0';
        $editCategory->save();
        $this->_show_message("user deactivated successfully", 'success');
        redirect('admin/newsletters/send_mail/' . $this->session->userdata('id'));
    }

}

?>
