<?php

/*
 * @auther Kushal
 */

class Ajax extends MY_admin {

    function __construct() {
        parent::__construct();
        $this->check_method();
    }

    public function uploadimage() {
        $this->load->library('Upload');
        $upload = '';
        foreach ($_FILES as $f => $fv) {
            $this->upload->initialize($this->set_upload_options());
            $_FILES['userfile']['name'] = $fv['name'];
            $_FILES['userfile']['type'] = $fv['type'];
            $_FILES['userfile']['tmp_name'] = $fv['tmp_name'];
            $_FILES['userfile']['error'] = $fv['error'];
            $_FILES['userfile']['size'] = $fv['size'];
            if (!$this->upload->do_upload()) {
                $message['error'] = $this->upload->display_errors();
                $this->write_logs('', $message);
                echo json_encode($message);
                exit;
            } else {
                $temp = $upload [] = $this->upload->data();
                /**
                 * Resizing image
                 */
                $this->resize(PRODUCTIMAGE_PATH, $temp);
            }
        }
        if ($data = $this->database_query_photo($upload)) {
            $message['message'] = $data;
            echo json_encode($message);
            exit;
        } else {
            $message['error'] = $this->lang->line('some_thing_wrong');
            echo json_encode($message);
            exit;
        }
    }

    public function uploaddesign() {
        $this->load->library('Upload');
        $upload = '';
        foreach ($_FILES as $f => $fv) {
            $this->upload->initialize($this->set_upload_options(PRODUCTDESIGN_PATH));
            $_FILES['userfile']['name'] = $fv['name'];
            $_FILES['userfile']['type'] = $fv['type'];
            $_FILES['userfile']['tmp_name'] = $fv['tmp_name'];
            $_FILES['userfile']['error'] = $fv['error'];
            $_FILES['userfile']['size'] = $fv['size'];
            if (!$this->upload->do_upload()) {
                $message['error'] = $this->upload->display_errors();
                $this->write_logs('', $message);
                echo json_encode($message);
                exit;
            } else {
                $temp = $upload [] = $this->upload->data();
                /**
                 * Resizing image
                 */
                if ($message = $this->resize(PRODUCTDESIGN_PATH, $temp)) {
                    echo json_encode($message);
                    exit;
                }
            }
        }
        if ($data = $this->database_query_design($upload)) {
            $message['message'] = $data;
            echo json_encode($message);
            exit;
        } else {
            $message['error'] = $this->lang->line('some_thing_wrong');
            echo json_encode($message);
            exit;
        }
    }

    public function slider_image() {
        $this->load->library('Upload');
        $upload = '';
        foreach ($_FILES as $f => $fv) {
            $this->upload->initialize($this->set_upload_options(SLIDER_PATH));
            $_FILES['userfile']['name'] = $fv['name'];
            $_FILES['userfile']['type'] = $fv['type'];
            $_FILES['userfile']['tmp_name'] = $fv['tmp_name'];
            $_FILES['userfile']['error'] = $fv['error'];
            $_FILES['userfile']['size'] = $fv['size'];
            if (!$this->upload->do_upload()) {
                $message['error'] = $this->upload->display_errors();
                $this->write_logs('', $message);
                echo json_encode($message);
                exit;
            } else {
                $temp = $upload [] = $this->upload->data();
                /**
                 * Resizing image
                 */
                if ($message = $this->resize(SLIDER_PATH, $temp)) {
                    echo json_encode($message);
                    exit;
                }
            }
        }
        if ($data = $this->database_query_slider_photo($upload)) {
            $message['message'] = $data;
            echo json_encode($message);
            exit;
        } else {
            $message['error'] = $this->lang->line('some_thing_wrong');
            echo json_encode($message);
            exit;
        }
    }

    public function resize($path = PRODUCTIMAGE_PATH, $data = '') {
        $config_resize['image_library'] = 'gd2';
        $config_resize['source_image'] = $path . '/' . $data['file_name'];
        $config_resize['new_image'] = $path . '/thumb/';
        $config_resize['maintain_ratio'] = TRUE;
        $config_resize['width'] = 200;
        $config_resize['height'] = 200;
        $this->load->library('image_lib', $config_resize);
        if (!$this->image_lib->resize()) {
            $message = $this->image_lib->display_errors();
            $this->write_logs('', $message);
            return $message;
        } else {
            return false;
        }
    }

    function database_query_design($uploaddata) {
        $conn = Design::connection();
        $conn->transaction();
        try {
            foreach ($uploaddata as $k => $data) {
                $data['file_title'] = $data['file_name'];
                $data['created'] = date("Y-m-d H:i:s");
                $data['updated'] = date("Y-m-d H:i:s");
                $design = new Design($data);
                $design->save();
                $savedesign[] = array('id' => $design->id . '|' . $design->file_name, 'path' => base_url(PRODUCTDESIGN_PATH) . "/" . $design->file_name);
            }
            $conn->commit();
            return $savedesign;
        } catch (Exception $e) {
            $this->write_logs($e);
            return false;
        }
    }

    function database_query_photo($uploaddata) {
        $conn = Photo::connection();
        $conn->transaction();
        try {
            foreach ($uploaddata as $k => $data) {
                $data['file_title'] = $data['file_name'];
                $data['created'] = date("Y-m-d H:i:s");
                $data['updated'] = date("Y-m-d H:i:s");
                $photo = new Photo($data);
                $photo->save();
                $savephoto[] = array('id' => $photo->id . '|' . $photo->file_name, 'path' => base_url(PRODUCTIMAGE_PATH) . "/" . $photo->file_name);
            }
            $conn->commit();
            return $savephoto;
        } catch (Exception $e) {
            $this->write_logs($e);
            return false;
        }
    }

    function database_query_slider_photo($uploaddata) {
        $conn = Photo::connection();
        $conn->transaction();
        try {
            foreach ($uploaddata as $k => $data) {
                $data['file_title'] = $data['file_name'];
                $data['created'] = date("Y-m-d H:i:s");
                $data['updated'] = date("Y-m-d H:i:s");
                $photo = new Photo($data);
                $photo->save();
                $savephoto[] = array('id' => $photo->id . '|' . $photo->file_name, 'path' => base_url(SLIDER_PATH) . "/" . $photo->file_name);
            }
            $conn->commit();
            return $savephoto;
        } catch (Exception $e) {
            $this->write_logs($e);
            return false;
        }
    }

    public function variation() {
        try {
            if ($this->input->post('data') && $this->input->post('val')) {
                $id = $this->input->post('data');
                $value = $this->input->post('val');
                $conn = Category::connection();
                $conn->transaction();
                /*
                 * Find variation is present or not
                 */
                $sub = Subcategory::find('first', array('conditions' => array('name = ? ', $value)));
                if ($sub) {
                    echo json_encode(array('error' => 'Already present in database. Possible deativated. Please check in variation'));
                    exit;
                }
                $cat = Category::find('first', array('conditions' => array('id = ?', $id)));
                if ($cat) {
                    $subcat = new Subcategory();
                    $subcat->category_id = $id;
                    $subcat->name = $value;
                    $subcat->status = 1;
                    $subcat->showinfilter = 1;
                    $subcat->created = date('Y-m-d h:i:s');
                    $subcat->updated = date('Y-m-d h:i:s');
                    $subcat->save();
                    $conn->commit();
                    $html = "<span><input type='checkbox' checked value='" . $subcat->id . "' name='variation[" . $cat->name . "][]' / >" . $subcat->name . "</span>";
                    echo json_encode(array('success' => $html));
                    exit;
                } else {
                    echo json_encode(array('error' => "Sorry .Some thing wrong we are not able to add this variation try from variation module"));
                    exit;
                }
            } else {
                echo json_encode(array('error' => 'Sorry .Some thing wrong we are not able to add this variation try from variation module'));
                exit;
            }
        } catch (Exception $e) {
            $this->write_logs($e);
            $conn->rollback();
            echo json_encode(array('error' => 'Sorry .Some thing wrong we are not able to add this variation try from variation module'));
            exit;
        }
    }

    function set_upload_options($path = "") {
        $config = array();
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

    function productdetails($id) {
        $this->data['category'] = Category::find('all', array('conditions' => array('status = ? and showinfilter = ? and id != ?', 1, 1, 7)));
        $this->data['products'] = Product::find('first', array('conditions' => array('id= ?', $id)));
        $this->load->view('admin/products/ajaxview', $this->data);
    }

//    ajax for  coushion photo

    public function uploadedimagee() {
        $this->load->library('Upload');
        $upload = '';
//        echo'<pre>';
//        print_r($_FILES);exit;
        foreach ($_FILES as $f => $fv) {
            $this->upload->initialize($this->set_upload_coushionoptions(COUSHIONIMAGE_PATH));
            $_FILES['userfile']['name'] = $fv['name'];
            $_FILES['userfile']['type'] = $fv['type'];
            $_FILES['userfile']['tmp_name'] = $fv['tmp_name'];
            $_FILES['userfile']['error'] = $fv['error'];
            $_FILES['userfile']['size'] = $fv['size'];
            if (!$this->upload->do_upload()) {
                $message['error'] = $this->upload->display_errors();
                $this->write_logs('', $message);
                echo json_encode($message);
                exit;
            } else {
                $temp = $upload [] = $this->upload->data();
                /**
                 * Resizing image
                 */
                $this->resizei(COUSHIONIMAGE_PATH, $temp);
            }
        }
        if ($data = $this->database_query_coushionphoto($upload)) {
//            echo'<pre>';
//            print_r($data);exit;
            $message['message'] = $data;
            echo json_encode($message);
            exit;
        } else {
            $message['error'] = $this->lang->line('some_thing_wrong');
            echo json_encode($message);
            exit;
        }
    }

    public function printimage() {
        $this->load->library('Upload');
        $upload = '';
//        echo'<pre>';
//        print_r($_FILES);exit;
        foreach ($_FILES as $f => $fv) {
            $this->upload->initialize($this->set_upload_coushionoptions(PRINTIMAGE_PATH));
            $_FILES['userfile']['name'] = $fv['name'];
            $_FILES['userfile']['type'] = $fv['type'];
            $_FILES['userfile']['tmp_name'] = $fv['tmp_name'];
            $_FILES['userfile']['error'] = $fv['error'];
            $_FILES['userfile']['size'] = $fv['size'];
            if (!$this->upload->do_upload()) {
                $message['error'] = $this->upload->display_errors();
                $this->write_logs('', $message);
                echo json_encode($message);
                exit;
            } else {
                $temp = $upload [] = $this->upload->data();
                /**
                 * Resizing image
                 */
                $this->resizei(PRINTIMAGE_PATH, $temp);
            }
        }
        if ($data = $this->database_query_printimages($upload)) {
//            echo'<pre>';
//            print_r($data);exit;
            $message['message'] = $data;
            echo json_encode($message);
            exit;
        } else {
            $message['error'] = $this->lang->line('some_thing_wrong');
            echo json_encode($message);
            exit;
        }
    }

//    resize function

    public function resizei($path = COUSHIONIMAGE_PATH, $data = '') {
//          echo'<pre>';
//          print_r($path);
//          print_r($data);
//          exit;
        $config_resize['image_library'] = 'gd2';
        $config_resize['source_image'] = $path . '/' . $data['file_name'];
        $config_resize['new_image'] = $path . '/thumb/';
        $config_resize['maintain_ratio'] = TRUE;
        $config_resize['width'] = 200;
        $config_resize['height'] = 200;
        $this->load->library('image_lib', $config_resize);
        if (!$this->image_lib->resize()) {
            $message = $this->image_lib->display_errors();
            $this->write_logs('', $message);
            return $message;
        } else {

            return false;
        }
    }

    function database_query_coushionphoto($uploaddata) {
        $conn = Photo::connection();
        $conn->transaction();
        try {
            foreach ($uploaddata as $k => $data) {
                $data['file_title'] = $data['file_name'];
                $data['created'] = date("Y-m-d H:i:s");
                $data['updated'] = date("Y-m-d H:i:s");
                $photo = new Photo($data);
//                echo'<pre>';
//                print_r( $photo);exit;
                $photo->save();
                $savephoto[] = array('id' => $photo->id . '|' . $photo->file_name, 'path' => base_url(COUSHIONIMAGE_PATH) . "/" . $photo->file_name);
            }
            $conn->commit();
            return $savephoto;
        } catch (Exception $e) {
            $this->write_logs($e);
            return false;
        }
    }

    function database_query_printimages($uploaddata) {
        $conn = Photo::connection();
        $conn->transaction();
        try {
            foreach ($uploaddata as $k => $data) {
                $data['file_title'] = $data['file_name'];
                $data['created'] = date("Y-m-d H:i:s");
                $data['updated'] = date("Y-m-d H:i:s");
                $photo = new Photo($data);
//                echo'<pre>';
//                print_r( $photo);exit;
                $photo->save();
                $savephoto[] = array('id' => $photo->id . '|' . $photo->file_name, 'path' => base_url(PRINTIMAGE_PATH) . "/" . $photo->file_name);
            }
            $conn->commit();
            return $savephoto;
        } catch (Exception $e) {
            $this->write_logs($e);
            return false;
        }
    }

    function set_upload_coushionoptions($path = "") {
        $config = array();
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

    function viewproduct($id = "") {
        $data['category'] = Category::find('all', array('conditions' => array('status = ? and showinfilter = ? and id != ?', 1, 1, 7)));
        $data['order'] = Order::find('first', array('conditions' => array('id =? ', $id)));
        $this->load->view('admin/order/viewproduct', $data);
    }

    function viewstatus($id = "") {
        $data['id'] = $id;
        $this->load->view('admin/order/viewstatus', $data);
    }
	

}
