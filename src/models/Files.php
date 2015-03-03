<?php

class Files extends Model {

    public static $table = 'pf_files';

    public $file;
    public $files;
    public $created;
    public $id_user;
    public $name;

    public $attributes = array(
        'files'         => array('valid' => array('filesize' => 1024)),
        'file'          => array(),
        'created'       => array(),
        'id_user'       => array(),
        'name'          => array(),
    );

}