<?php

/**
 * Class Connect (singleton)
 */
class Connect {

    protected static $instance = null;
    protected static $config = null;

    public static function db()
    {
        if (!isset(static::$instance)) {
            $db_conn = Connect::config('db');
            self::$instance = new db("mysql:host=".$db_conn['host'].";dbname=".$db_conn['dbname'], $db_conn['user'], $db_conn['pass']);
        }
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
