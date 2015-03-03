<?php

defined('BASE_PATH') or define('BASE_PATH',__DIR__.'/src');
defined('FILES_PATH') or define('FILES_PATH',__DIR__.'/files');
defined('CONF_PATH') or define('CONF_PATH',BASE_PATH.'/conf');

include(BASE_PATH."/conf/connect.php");
include(BASE_PATH."/conf/autoloader.php");

$cont = isset($_GET['cont'])? $_GET['cont']: 'user';
$act = isset($_GET['act'])? $_GET['act']: 'index';

$model = $cont.'Controller';
$model = new $model;
call_user_func(array($model,$act));
