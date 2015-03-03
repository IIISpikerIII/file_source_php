<?php
class Connect {

    protected static $instance = null;

    public static function db()
    {
        if (!isset(static::$instance)) self::$instance = new db("mysql:host=localhost;dbname=pftest", "root", "123");
        return static::$instance;
    }
}	
?>
