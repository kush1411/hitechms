<?php

/*
 * @auther Shafiq
 */

class Landingpage extends ActiveRecord\Model {

    static $belongs_to = array(
        array('adminuser'),
        array('module', 'conditions' => array('status = ?', 1)),
    );

}