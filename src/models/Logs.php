<?php

class Logs extends Model {

    public static $table = 'pf_logs';

    public $attribute;
    public $value;
    public $date;
    public $id_user;

    public $attributes = array(
        'attribute' => array('self'=>true,  'label' => 'Аттрибут'),
        'value'     => array('self'=>true,  'label' => 'Значение'),
        'date'      => array('self'=>true,  'label' => 'Дата'),
        'id_user'   => array('self'=>true,  'label' => 'ид пользователя'),
    );

    /**
     * Logger in DB
     * @param $attr
     * @param $val
     * @param $usr
     */
    public static function setLog($attr, $val, $usr) {

        $attributes = array(
            'attribute' => $attr,
            'value'      => $val,
            'date'      =>  date('Y-m-d H:i:s',time()),
            'id_user'    =>  $usr,
        );

        Connect::db()->insert(static::$table, $attributes);
    }

    /**
     * logger change
     * @param $f_attr
     * @param $s_attr
     */
    public static function logChange($f_attr, $s_attr) {

        foreach($s_attr as $key => $val) {

            if($val !== $f_attr[$key])
                Logs::setLog($key,$f_attr[$key],$f_attr['id']);
        }
    }
}