<?php

/*
 * @auther Shafiq
 */

class Adminuser extends ActiveRecord\Model {

    static $has_many = array(
        array('adminright'),
    );
    static $belongs_to = array(
        array('admingroup')
    );
    static $has_one = array('landingpage', 'class' => 'Landingpage');
    static $after_update = array('update_sessions');

    function getRights($module_id) {
        if ($module_id) {
            $rights = Adminright::find(array('conditions' => array('module_id = ? and adminuser_id = ?', $module_id, $this->id)));
            if ($rights)
                return $rights->right;
            else
                return 0;
        } else {
            return 0;
        }
    }

    function update_sessions() {
        $ci = & get_instance();
        $adminUser = self::find($ci->session->userdata[SITE_NAME.'_admin_user_data']['user_id']);
        $new_array = array(
            'user_id' => $adminUser->id,
            'username' => $adminUser->username,
            'image' => $adminUser->image_path,
            'image_name' => $adminUser->image_name,
            'admingroup' => $adminUser->admingroup_id,
            'status' => $adminUser->activated
        );
        $ci->session->set_userdata(SITE_NAME.'_admin_user_data', $new_array);
    }

}