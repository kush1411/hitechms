<?php

/*
 * @auther Shafiq
 */

class Userprofile extends ActiveRecord\Model {

    static $belongs_to = array(
        array('user')
        );

    public function get_profileimage() {
        $imgData = array();
        return $imgData;
    }

}
