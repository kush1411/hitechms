<?php

/*
 * @auther Shafiq
 */

class Module extends ActiveRecord\Model {

    static function find_assoc($params = FALSE, $select = TRUE) {
        if ($params)
            $module = self::find('all', $params);
        else
            $module = self::find('all');
        $out = array();
        if ($select) {
            $out['0'] = "Select";
        }
        foreach ($module as $grp)
            $out[$grp->id] = $grp->name;
        return $out;
    }

    static $has_many = array(
        array('adminuser', 'through' => 'adminright'),
    );

}
