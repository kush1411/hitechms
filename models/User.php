<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends ActiveRecord\Model {

    static $has_one = array(
        array('user_profile', 'class' => 'Userprofile'),
    );
    static $has_many = array(
        array('userprofile', 'class' => 'Userprofile'),
    );

    static function find_assoc($params = '', $select = TRUE) {
        if ($params)
            $admingrp = self::find('all', $params);
        else
            $admingrp = self::find('all');
        $out = array();
        if ($select) {
            $out['0'] = "Select";
        }
        foreach ($admingrp as $grp)
            $out[$grp->id] = $grp->firstname;

        return $out;
    }

    function get_fullname() {
        if ($this->firstname != '' && $this->lastname != '') {
            $name = $this->firstname . ' ' . $this->lastname;
        } else {
            $name = $this->email;
        }
        return $name;
    }

}
