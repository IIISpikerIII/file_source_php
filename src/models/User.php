<?php

class User extends Model {

    public static $table = 'pf_user';

    public $login;
    public $pass;
    public $f_name;
    public $s_name;
    public $email;
    public $phone;
    public $b_date;
    public $created;
    public $role;
    public $hash;

    public $attributes = array(
        'login'     => array('self'=>true,  'valid' => array('maxlength' => '3', 'required', 'unique'=>__CLASS__), 'label' => 'Логин'),
        'pass'      => array('self'=>true,  'valid' => array( 'required'), 'label' => 'Пароль'),
        'f_name'    => array('self'=>true,  'valid' => array('required'), 'label' => 'Имя'),
        's_name'    => array('self'=>true,  'valid' => array('required'), 'label' => 'Фамилия'),
        'email'     => array('self'=>true,  'valid' => array('email'), 'label' => 'email'),
        'phone'     => array('self'=>true, 'label' => 'Телефон'),
        'b_date'    => array('self'=>true, 'label' => 'Дата рождения'),
        'created',
        'role',
        'hash',
    );

    public function authenticate() {

        $model = Connect::db()->select(User::$table, "LOWER(login)=".$this->login.'' );

        if($model === null) return false;

        $model = end($model);

        if(User::checkPass($this->pass, $model['pass'])){

            $hash = md5(User::generateRand());
            Connect::db()->update(User::$table, array('hash' => $hash), "id =".$model['id']);

            setcookie("hash_fs", $hash, time()+60*60*24);
            setcookie("id_fs", $model['id'], time()+60*60*24);
        }

        return true;
    }

    public static function logout() {

        Connect::db()->update(User::$table, array("hash" => ""), User::isAuth('id'));
        setcookie($_COOKIE['hash_fs'],"");
        setcookie($_COOKIE['id_fs'], "");

    }

    public static function isAuth($attr = true) {

        if (isset($_COOKIE['id_fs']) and isset($_COOKIE['hash_fs'])) {

            $model = Connect::db()->select(User::$table, "id=" . $_COOKIE['id_fs'] . " AND hash = '" . $_COOKIE['hash_fs'] . "'");

            if (!empty($model)) {
                return $attr === true? true : end($model)[$attr];
            }
        }

        return false;
    }

    public static function generateRand($count=16){

        $chars = 'qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP';
        $length = strlen($chars)-1;
        $pass = '';

        while (strlen($pass) < $count)
            $pass .= $chars[rand(0,$length)];

        return $pass;
    }

    public static function generatePass($pass){

        $pass = trim($pass);
        return empty($pass)? $pass: md5(md5($pass).Connect::config('salt'));
    }

    public static function checkPass($usr_pass, $org_pass){

        $usr_pass = User::generatePass($usr_pass);
        return $usr_pass === $org_pass;
    }

}