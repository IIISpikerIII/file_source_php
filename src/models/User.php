<?php

class User extends Model {

    public $table = 'pf_user';

    public $login;
    public $pass;
    public $f_name;
    public $s_name;
    public $email;
    public $phone;
    public $b_date;
    public $created;
    public $role;

    public $attributes = array(
        'login'     => array('self'=>true),
        'pass'      => array('self'=>true),
        'f_name'    => array('self'=>true),
        's_name'    => array('self'=>true),
        'email'     => array('self'=>true),
        'phone'     => array('self'=>true),
        'b_date'    => array('self'=>true),
        'created',
        'role'
    );
}