<?php

/*
 * @auther Shafiq
 */

class Photo extends ActiveRecord\Model {

     static $has_many = array(
        array('productphoto'),
        array('productphoto'), array('photo', 'through' => 'userprofile'),
        array('userprofile', 'class' => 'Userprofile'),
        array('cushionphoto', 'class' => 'Cushionphoto'),
         );
    static $has_one = array(
        array('printcushionphoto', 'class' => 'Printcushionphoto'),
    );

}