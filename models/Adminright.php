<?php

/*
 * @auther Shafiq
 */

class Adminright extends ActiveRecord\Model {

    static $belongs_to = array(
        array('adminuser'),
        array('admingroup'),
        array('module'),
    );

}
