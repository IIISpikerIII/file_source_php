<?php
/**
 * Created by PhpStorm.
 * User: spiker
 * Date: 17.02.15
 * Time: 22:09
 */

function autoload_class($class_name)
{
    $base_path = __DIR__.'/../';

    $path = array(
        $base_path.'controllers/'.$class_name.'.php',
        $base_path.'models/'.$class_name.'.php',
        $base_path.'components/'.$class_name.'.php',
    );

    foreach($path as $val) {

        if (file_exists($val)) {
            require_once($val);
            break;
        }
    }

}

spl_autoload_register('autoload_class');