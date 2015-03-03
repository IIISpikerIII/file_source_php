<?php

class Files extends Model {

    public static $table = 'pf_files';

    public $file;
    public $files;
    public $created;
    public $id_user;
    public $name;

    public $attributes = array(
        'files'         => array('valid' => array('filesize' => 1024), 'label' => 'Файл'),
        'file'          => array(),
        'created'       => array(),
        'id_user'       => array(),
        'name'          => array(),
    );

    public static function checkLimit($usr_id){

        $files = Connect::db()->select(Files::$table, 'id_user = '.$usr_id);
        $limit = Connect::config('fileLimit') - sizeof($files);

        if($limit > 0)
            return $limit;
        else
            return false;
    }
}