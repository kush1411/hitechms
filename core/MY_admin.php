<?php

/*
 * @auther Shafiq
 */

Class MY_admin extends MY_base {

    function __construct() {
        parent::__construct();
        $this->admincss_js();
        $this->data['userRights'] = $this->check_rights();
        $this->_api_require_user();
    }

    function admincss_js() {
//        if ($this->data['action'] == 'index') {
//            array_push($this->scripts['js'], "admin/js/table/jquery.dataTables.min.js");
//            $datatableJs = '$(document).ready(function() {
//               var oTable= $("#product-table").dataTable( {
//                    "sPaginationType": "full_numbers",
//                    "oLanguage": { "sSearch": "Search Record:"},
//                    "oLanguage": { "sZeroRecords": "No matching Record(s) found" },
//                    "aoColumnDefs" : [{"bSortable" : false,"aTargets":[0]}],
//                    "fnDrawCallback": function() {
//                        if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
//                            jQuery("#table_sec_processing").remove();
//                            jQuery("#product-table_info").remove();
//                        }else {
//                            jQuery("#product-table_paginate").remove();
//                            jQuery("#product-table_info").remove();
//                        }
//                    }
//                    });
//                });';
//            array_push($this->scripts['embed'], $datatableJs);
//        }
        array_push($this->scripts['js'], 'admin/js/libs/jquery/jquery-1.11.2.min.js', 'admin/js/libs/jquery/jquery-migrate-1.2.1.min.js', 'admin/js/libs/bootstrap/bootstrap.min.js', 'admin/js/libs/spin.js/spin.min.js', 'admin/js/libs/autosize/jquery.autosize.min.js', 'admin/js/libs/DataTables/jquery.dataTables.min.js', 'admin/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js', 'admin/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js', 'admin/js/libs/nanoscroller/jquery.nanoscroller.min.js', 'admin/js/libs/select2/select2.min.js', 'admin/js/libs/bootstrap-datepicker/bootstrap-datepicker.js', 'admin/js/core/source/App.js', 'admin/js/core/source/AppNavigation.js', 'admin/js/core/source/AppOffcanvas.js', 'admin/js/core/source/AppCard.js', 'admin/js/core/source/AppForm.js', 'admin/js/core/source/AppNavSearch.js', 'admin/js/core/source/AppVendor.js', 'admin/js/core/demo/Demo.js', 'admin/js/core/demo/DemoTableDynamic.js', 'admin/js/core/demo/DemoFormComponents.js');
        array_push($this->scripts['css'], 'admin/css/bootstrap.css', 'admin/css/style.css', 'admin/css/font-awesome.min.css', 'admin/css/material-design-iconic-font.min.css', 'admin/css/libs/DataTables/jquery.dataTables.css', 'admin/css/libs/DataTables/extensions/dataTables.colVis.css', 'admin/css/libs/DataTables/extensions/dataTables.tableTools.css', 'admin/css/libs/select2/select2.css', 'admin/css/libs/multi-select/multi-select.css', 'admin/css/libs/bootstrap-datepicker/datepicker3.css');
        //array_push($this->scripts['css'], "admin/css/style.css", "admin/css/reset.css", 'admin/css/grid.css', 'admin/css/layout.css', 'admin/css/nav.css');
        array_push($this->scripts['js'], "js/admin.js");
    }

    function _api_require_user($params = array()) {
        if (empty($params['except']))
            $params['except'] = array();
        if (empty($params['only']))
            $params['only'] = array();
        if (count($params['except']) > 0 AND in_array($this->data['action'], $params['except']))
            return TRUE;
        if (count($params['only']) > 0 AND ! in_array($this->data['action'], $params['only']))
            return TRUE;
        if ($this->session->userdata(SITE_NAME . '_admin_user_data') && $this->session->userdata[SITE_NAME . '_admin_user_data']['user_id'] > 0) {
            return TRUE; //user is logged in    
        }
        redirect('admin');
    }

    function check_rights($rights = '', $module = '', $check = FALSE) {
//        $rightData['read'] = 1;
//        $rightData['add'] = 1;
//        $rightData['edit'] = 1;
//        $rightData['delete'] = 1;
//        $this->data['userRights'] = $rightData;
//        return $rightData;

        if ($this->data['controller'] == 'myaccount') {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
        }
        
        if ($this->data['controller'] == 'admingroups' && ($this->data['action'] == 'checkfirst' || $this->data['action'] == 'check')) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
        }
        if ($this->data['controller'] == 'members' && ($this->data['action'] == 'details' || $this->data['action'] == 'pdf' || $this->data['action'] == 'machinedeactivate' || $this->data['action'] == 'machineactivate')) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            $rightData['download'] = 1;
            return $rightData;
        }
        if ($this->data['controller'] == 'category' && ($this->data['action'] == 'checkfirst' || $this->data['action'] == 'check')) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
        }
        if ($this->data['controller'] == 'mfg' && ($this->data['action'] == 'checkfirst' || $this->data['action'] == 'check')) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
        }
        if ($this->data['controller'] == 'type' && ($this->data['action'] == 'checkfirst' || $this->data['action'] == 'check')) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
        }
        if ($this->data['controller'] == 'parts' && ($this->data['action'] == 'copy' || $this->data['action'] == 'checkfirst' || $this->data['action'] == 'check' || $this->data['action'] == 'gettype')) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
        }
        if ($this->data['controller'] == 'subparts' && ($this->data['action'] == 'copy' || $this->data['action'] == 'checkfirst' || $this->data['action'] == 'check')) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
        }
        if ($this->data['controller'] == 'barcode' && ($this->data['action'] == 'getbarcodetype' || $this->data['action'] == 'deletebarcodetype' || $this->data['action'] == 'updatebarcode')) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
        }

        if ($this->data['controller'] == 'ajax' && !$check) {
            $rightData['read'] = 1;
            $rightData['add'] = 1;
            $rightData['edit'] = 1;
            $rightData['delete'] = 1;
            return $rightData;
        }
        /*
         * Read 1
         * add 2
         * edit 4
         * delte 8
         */
        $this->_api_require_user();
        $rightData = array('read' => 0, 'edit' => 0, 'delete' => 0, 'add' => 0, 'send_email' => 0, 'copy_product' => 0, 'download' => 0);
        if ($module == '') {
            $key = array_search(ucfirst($this->data['controller']), $this->session->userdata(SITE_NAME . '_menus'));
            if ($key && $this->session->userdata[SITE_NAME . '_userRights'][$key]) {
                $userRights = $this->session->userdata[SITE_NAME . '_userRights'][$key];
            } else {
                $data = Adminright::find(array('conditions' => array('modules.name = ? and adminuser_id = ? ', $this->data['controller'], $this->session->userdata[SITE_NAME . '_admin_user_data']['user_id']), 'joins' => "left join modules on adminrights.module_id = modules.id"));
                if ($data->right)
                    $userRights = $data->right;
            }
        } else if (is_int($module)) {
            if ($this->session->userdata[SITE_NAME . '_userRights'][$module]) {
                $data = $this->session->userdata[SITE_NAME . '_userRights'][$module];
            } else {
                $data = Adminright::find(array('conditions' => array('module_id = ? and adminuser_id = ? ', $module, $this->session->userdata[SITE_NAME . '_admin_user_data']['user_id'])));
                if ($data->right)
                    $userRights = $data->right;
            }
        } else if ($module) {
            $key = array_search($module, $this->session->userdata(SITE_NAME . '_menus'));
            if ($key && $this->session->userdata[SITE_NAME . '_userRights'][$key]) {
                $data = $this->session->userdata[SITE_NAME . '_userRights'][$key];
            } else {
                $join = "left join modules on `module_id`  = modules.id where modules.name  = '" . $module . "'and adminrights.adminuser_id = " . $this->session->userdata[SITE_NAME . '_admin_user_data']['user_id'];
                $data = Adminright::find(array('joins' => $join));
                if ($data->right)
                    $userRights = $data->right;
            }
        } else {
            $join = "left join modules on `module_id`  = modules.id where modules.name  = '" . $this->data['controller'] . "'and adminrights.adminuser_id = " . $this->session->userdata[SITE_NAME . '_admin_user_data']['user_id'];
            $data = Adminright::find(array('joins' => $join));
            if ($data->right)
                $userRights = $data->right;
        }

        if ($rights == '') {
            $rights = $this->get_rights();
        } else {
            /*
             * 
             */
            if ($userRights & $rights)
                return true;
            else
                return false;
        }
        //echo '<pre>UserRights '; print_r($userRights);echo '<pre>Rights '; print_r($rights);echo '<pre>'; print_r($userRights & $rights); 
        if (isset($userRights) && isset($rights) && ($userRights & $rights)) {
            /*             * *admin has the right to use module ** */

            if ($userRights & READ_MODULE) {
                $rightData['read'] = 1;
            }
            if ($userRights & ADD_MODULE) {
                $rightData['add'] = 1;
            }
            if ($userRights & EDIT_MODULE) {
                $rightData['edit'] = 1;
            }
            if ($userRights & DELETE_MODULE) {
                $rightData['delete'] = 1;
            }
            if ($userRights & SEND_EMAIL_MODULE) {
                $rightData['send_email'] = 1;
            }
            if ($userRights & COPY_PRODUCT_MODULE) {
                $rightData['copy_product'] = 1;
            }
            if ($userRights & DOWNLOAD_MODULE) {
                $rightData['download'] = 1;
            }
            $this->data['userRights'] = $rightData;
            return $rightData;
        } else {
            // echo 123; die;
            redirect('admin/unauthorize');
        }
    }

    function get_rights() {
        $rights = '';
        if (in_array($this->data['action'], array('index', 'list', 'details'))) {
            $rights = READ_MODULE;
        } else if ($this->data['action'] == 'add') {
            $rights = ADD_MODULE;
        } else if (in_array($this->data['action'], array('edit', 'activate', 'deactivate'))) {
            $rights = EDIT_MODULE;
        } else if ($this->data['action'] == 'delete') {
            $rights = DELETE_MODULE;
        } else if (in_array($this->data['action'], array('send_mail', 'mail', 'send_to_all'))) {
            $rights = SEND_EMAIL_MODULE;
        } else if ($this->data['action'] == 'copyproduct') {
            $rights = COPY_PRODUCT_MODULE;
        } else if (in_array($this->data['action'], array('export', 'userdownloadproducts', 'autobackup'))) {
            $rights = DOWNLOAD_MODULE;
        }
        return $rights;
    }

    function removephoto($imgpath = '', $id = '') {
        $deleteObj = Photo::find($id);
        $path = $imgpath . '/' . $deleteObj->file_name;
        $thumbpath = $imgpath . '/thumb/' . $deleteObj->file_name;
        unlink($path);
        unlink($thumbpath);
        if ($deleteObj->delete())
            return true;
        else
            return false;
    }

}
