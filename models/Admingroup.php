<?php

class Admingroup extends ActiveRecord\Model {

    static $has_many = array(
        array('adminuser')
    );

    static function find_assoc($params = '', $select = TRUE) {
        if ($params)
            $admingrp = self::find('all', $params);
        else
            $admingrp = self::find('all', array('conditions' => array('status = ? and id != ?', 1, 1)));
        $out = array();
        if ($select) {
            $out['0'] = "Select";
        }
        foreach ($admingrp as $grp)
            $out[$grp->id] = $grp->name;
        return $out;
    }

}
