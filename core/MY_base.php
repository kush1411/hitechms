<?php

/**
 * @author shafiq
 * */
class MY_base extends CI_Controller {

    public $scripts = array();
    public $metas = array();
    var $regions = array(
        '_scripts' => array(),
        '_styles' => array(),
    );
    var $js = array();
    var $css = array();

    function __construct() {

        parent::__construct();
//        echo '<pre>';
//        print_r($_SERVER['HTTP_REFERER']);
//        exit;
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'common', 'string', 'html'));
        $this->load->library('tank_auth');
        $this->load->library('security');
        $this->data['controller'] = $this->router->fetch_class();
        $this->data['action'] = $this->router->fetch_method();
        $this->metas = array('keyword' => array(), 'description' => array(), 'title' => array());
        $this->scripts = array('js' => array(), 'css' => array(), 'embed' => array(), 'media' => array());
        $this->data['add_css'] = '';
        $this->data['add_js'] = '';
        $this->data['add_warning'] = '';
        $this->data['add_success'] = '';
        $this->data['add_error'] = '';
        $this->data['add_info'] = '';
        $this->data['add_key'] = '';
        $this->data['row_sortable'] = '';
        $this->data['add_description'] = '';
        $this->data['add_title'] = '';
        $this->data['track_code'] = "";
       
        $class = $this->router->fetch_class();
        $method = $this->router->fetch_method();
        
        
//        $this->data['country'] = Country::find_assoc(array('conditions' => array('status = ?', 1)));
        array_push($this->metas['title'], ucfirst($this->data['controller']) . ' | ' . ucfirst($this->data['action']));
      
        //array_push($this->scripts['js'], "frontend/js/visualizer.js");
        $this->output->enable_profiler(FALSE);
    }

    function render_metakey_metadesc() {

        if (empty($this->metas)) {
            return false;
        }
        if (!empty($this->metas['keyword'])) {
            $this->metas['keyword'] = array_unique($this->metas['keyword']);

            foreach ($this->metas['keyword'] as $key => $value) {
                $this->data['add_key'] .= "<meta name = 'keywords' content = '$value' />";
            }
        }
        if (!empty($this->metas['description'])) {
            $this->metas['description'] = array_unique($this->metas['description']);
            foreach ($this->metas['description'] as $key => $value) {
                $this->data['add_description'] .= "<meta name = 'description' content = '$value' />";
            }
        }
        if (!empty($this->metas['title'])) {
            $this->metas['title'] = array_unique($this->metas['title']);
            foreach ($this->metas['title'] as $key => $value) {
                $this->data['add_title'] .= ucfirst($value);
            }
        }
    }

    function render_flash_messages() {
        if (($this->session->flashdata('warning'))) {
            $this->data['add_message'] = $this->session->flashdata('warning');
        }
        if (($this->session->flashdata('success'))) {
            $this->data['add_success'] = $this->session->flashdata('success');
        }
        if (($this->session->flashdata('error'))) {
            $this->data['add_error'] = $this->session->flashdata('error');
        }
        if (($this->session->flashdata('info'))) {
            $this->data['add_info'] = $this->session->flashdata('info');
        }
        //$this->display($this->data);
    }

    function render_scripts() {
        if (empty($this->scripts)) {
            return false;
        }

        if (!empty($this->scripts['css'])) {
            $this->scripts['css'] = array_unique($this->scripts['css']);
            foreach ($this->scripts['css'] as $key => $value) {
                $this->add_css(base_url() . 'assets/' . $value);
            }
        }
        if (!empty($this->scripts['media'])) {
            $this->scripts['media'] = array_unique($this->scripts['media']);
            foreach ($this->scripts['media'] as $key => $value) {
                $this->add_css($value, 'media', true);
            }
        }
        if (!empty($this->scripts['js'])) {
            $this->scripts['js'] = array_unique($this->scripts['js']);
            foreach ($this->scripts['js'] as $key => $value) {
                $this->add_js(base_url() . 'assets/' . $value, 'import');
            }
        }
        $this->add_js('var site_url="' . base_url() . '";', 'embed', true);
        if (!empty($this->scripts['embed'])) {
            $this->scripts['embed'] = array_unique($this->scripts['embed']);
            foreach ($this->scripts['embed'] as $key => $value) {
                $this->add_js($value, 'embed', true);
            }
        }
    }

    function display($variable, $exit = true) {
        echo '<pre>';
        print_r($variable);
        echo '</pre>';

        if (true == $exit) {
            exit;
        }
    }

    function add_js($script, $type = 'import', $defer = FALSE) {
        $success = TRUE;
        $js = NULL;

        $this->load->helper('url');

        switch ($type) {
            case 'import':

                $filepath = $script;
                $js = '<script type="text/javascript" src="' . $filepath . '"';
                if ($defer) {
                    $js .= ' defer="defer"';
                }
                $js .= "></script>\n";
                break;

            case 'embed':
                $defer = true;
                $js = '<script type="text/javascript"';
                if ($defer) {
                    $js .= ' defer="defer"';
                }
                $js .= ">";
                $js .= $script;
                $js .= '</script>';
                break;

            default:
                $success = FALSE;
                break;
        }

// Add to js array if it doesn't already exist
        if ($js != NULL && !in_array($js, $this->js)) {

            $this->data['add_js'] .= $js;
            $this->js[] = $js;
        }
    }

    function add_css($style, $type = 'link', $media = FALSE) {
        $success = TRUE;
        $css = NULL;

        $this->load->helper('url');
        $filepath = $style;

        switch ($type) {
            case 'link':

                $css = '<link type="text/css" rel="stylesheet" href="' . $filepath . '"';
                if ($media) {
                    $css .= ' media="' . $media . '"';
                }
                $css .= " />\n";
                break;
            case 'media':
                $css = '<link type="text/css" rel="stylesheet" href="' . $filepath . '"';
                $css .= " media='print' />\n";
                break;
            case 'import':
                $css = '<style type="text/css">@import url(' . $filepath . ');</style>\n';
                break;

            case 'embed':
                $css = '<style type="text/css">';
                $css .= $style;
                $css .= '</style>';
                break;

            default:
                $success = FALSE;
                break;
        }

// Add to js array if it doesn't already exist
        if ($css != NULL && !in_array($css, $this->css)) {

            $this->data['add_css'] .= $css;
        }
    }

    function display_view($type, $view, $out = '', $login = FALSE) {
        if ($out != '') {
            foreach ($out as $k => $v) {
                $this->data[$k] = $v;
            }
        }

        $this->render_scripts();
        $this->render_metakey_metadesc();
        $this->render_flash_messages();
        if (!$login)
            $this->load->view($type . '/header', $this->data);
        $this->load->view($type . '/' . $view, $this->data);
        if (!$login)
            $this->load->view($type . '/footer', $this->data);
    }

    function _send_email($type, $email, $data) {
        try {
            $data['site_name'] = $this->config->item('website_name', 'tank_auth');
//            $config = array(
//                'protocol' => 'smtp',
//                'mailtype' => 'html',
//                'charset' => 'iso-8859-1',
//                'smtp_auth' => TRUE,
//                'send_multipart' => TRUE,
//                'smtp_host' => 'ssl://smtp.gmail.com',
//                'smtp_port' => 465,
//                'smtp_user' => 'decordigitization@gmail.com',
//                'smtp_pass' => 'decor@123',
//                'validate' => 'false',
//                'wordwrap' => TRUE,
//                'crlf' => "\r\n",
//                'smtp_timeout' => '100',
//                'newline' => "\r\n",
//            );
            $config = array(
                'protocol' => 'mail',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'send_multipart' => TRUE,
                'validate' => 'false',
                'wordwrap' => TRUE,
                'crlf' => "\r\n",
                'newline' => "\r\n",
            );

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
            $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
            $this->email->to($email);
            $this->email->subject("HiTechMS ".$data['subject']);

            $this->email->message($this->load->view('email/' . $type . '-html', $data, TRUE));
            $this->email->set_alt_message($this->load->view('email/' . $type . '-txt', $data, TRUE));

            $mail = $this->email->send();
            //echo $this->email->print_debugger(); die;
            //if($mail){ echo 1; die; }else{ echo ''; die;}
        } catch (Exception $e) {
//            print_r($e->getMessage());
//            exit;
        }
    }

    /**
     * Show info message
     *
     * @param  string
     * @return  void
     */
    function _show_message($message, $type = 'message', $css = '') {
        if ($type == 'success') {
            $tag_start = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</h5></strong> ';
        } else if ($type == 'warning') {
            $tag_start = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> ';
        } else if ($type == 'error') {
            $tag_start = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> ';
        } else {
            $tag_start = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Info!</strong> ';
        }
        $tag_end = '</div>';
        if ($css) {
            foreach ($css as $k => $v) {
                if ($k == 'start') {
                    $tag_start = $v;
                } elseif ($k == 'end') {
                    $tag_end = $v;
                }
            }
        }
        $message = $tag_start . $message . $tag_end;
        $this->session->set_flashdata($type, $message);
    }

    /*     *
     * This function use for data picker js where you want to call date picker js then just call this function with two parameter 
     * */

    function datepicker($id, $monyear = false, $option = '') {
        array_push($this->scripts['js'], "js/datepicker_new.js");
        //array_push($this->scripts ['css'], "css/datePicker.css");
        $datejs = '$(document).ready(function(){
    $(function() {
       var datepicker =  $( ".' . $id . '" ).datepicker(';
        if ($monyear) {
            //$datejs .= 
            $datejs .= '{yearRange: "1950:" + new Date().getFullYear(),
        changeMonth: true,
        changeYear: true,
        dateFormat:"dd-mm-yy",' . $option
                    . '
        }';
        }
        $datejs .=');});});';
        array_push($this->scripts['embed'], $datejs);
    }

    function write_logs($e = '', $m = '') {
        if ($e && $m) {
            console_log($e->getMessage() . ' Controller :' . $this->data['controller'] . ' function : ' . $this->data['action'], 'error', true);
            error_log($e->getMessage() . ' Controller :' . $this->data['controller'] . ' function : ' . $this->data['action']);
            console_log($m, 'error', true);
            error_log($m);
        } else if ($e) {
            console_log($e->getMessage() . ' Controller :' . $this->data['controller'] . ' function : ' . $this->data['action'], 'error', true);
            error_log($e->getMessage() . ' Controller :' . $this->data['controller'] . ' function : ' . $this->data['action']);
        } else if ($m) {
            if (is_array($m)) {
                $str = '';
                foreach ($m as $k => $v) {
                    $str .= $k . ' : ' . $v . ' --';
                }
                $m = $str;
            } else if (is_object($m)) {
                /*
                 * Need to handle this
                 */
            }
            console_log($m, 'error', true);
            error_log($m);
        }
    }

    public function check_method() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
    }

//    public function right_menu() {
//        /*
//         * Side Menu
//         */
//        array_push($this->scripts['css'], 'frontend/css/basic.css', 'frontend/css/template.css', 'frontend/css/style.css', 'frontend/css/jquery_ui.css');
//        array_push($this->scripts['js'], "frontend/js/jquery-ui.js", "frontend/js/zoom.js", "frontend/js/jquery.tooltipster.js");
//        $this->session->unset_userdata(SITE_NAME . '_cart_product');
//        array_push($this->scripts['js'], "frontend/js/visualizer.js");
//        $this->data['category'] = Category::find('all', array('conditions' => array('status = ? and showinfilter = ?', 1, 1), 'include' => 'filtersubcategory'));
//        $this->data['product'] = Product::find('all', array('limit' => LIMIT, 'conditions' => array('status=?', 1), 'order' => 'updated desc'));
//        $this->data['offset'] = LIMIT;
//        $this->data['total'] = Product::count(array('conditions' => array('status=?', 1)));
//        $this->data['page'] = LIMIT;
//        if ($this->data['total'] < LIMIT)
//            $this->data['page'] = $this->data['total'];
//
//        /*      Add style category   * */
//        $join = "left join style_categories on style_categories.id = style_images.category_id";
//        $condition = "style_categories.status = '1' and style_images.status = '1'";
//        $this->data['style_images'] = StyleImage::all(array('joins' => $join, 'conditions' => $condition, 'include' => 'photo'));
//
//        $this->data['style_total'] = StyleImage::count(array('joins' => $join, 'conditions' => $condition));
//        $this->data['style_page'] = LIMIT;
//        if ($this->data['style_total'] < LIMIT)
//            $this->data['style_page'] = $this->data['style_total'];
//        $this->data['style_category'] = StyleCategory::find('all', array('conditions' => array('status=?', 1), 'order' => 'updated desc'));
//    }

}

?>
