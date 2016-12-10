<?php

//@author name Shafiq
class Socialnetwork extends ActiveRecord\Model {

    static $validates_uniqueness_of = array(
        array(array('user_id', 'provider'), 'message' => 'User is already registered with this provider!'),
        array(array('uid', 'provider'), 'message' => 'Another user is registered with this account'),
    );
    static $belongs_to = array(
        array('user', 'class_name' => 'User'),
    );

}
