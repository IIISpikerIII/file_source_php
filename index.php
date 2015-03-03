<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

defined('BASE_PATH') or define('BASE_PATH',__DIR__.'/src');
defined('CONF_PATH') or define('CONF_PATH',BASE_PATH.'/conf');

include(BASE_PATH."/conf/connect.php");
include(BASE_PATH."/conf/autoloader.php");


//protected static $instance = null;
//
//public static function getInstance()
//{
//    if (!isset(static::$instance)) self::$instance = new db($dsn, $user="", $passwd="");
//    return static::$instance;
//}

$db = Connect::db();
//$db = new db("mysql:host=localhost;dbname=pftest", "root", "123");


$cont = $_GET['cont'];
$act = $_GET['act'];

$model = $cont.'Controller';
$model = new $model;
call_user_func(array($model,$act));
