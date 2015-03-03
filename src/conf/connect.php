<?php
class Connect {

    protected static $instance = null;
    protected static $config = null;

    public static function db()
    {
        if (!isset(static::$instance)) self::$instance = new db("mysql:host=localhost;dbname=pftest", "root", "123");
        return static::$instance;
    }

    public static function config($attr)
    {
        if (!isset(static::$config))
            self::$config = include(CONF_PATH.'/config.php');

        return static::$config[$attr];
    }
}	
?>
