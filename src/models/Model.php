<?php

abstract class Model {

    public $table;
    public $attributes = array();

    public function setAttributes($params = array()) {

        foreach($this->attributes as $key => $val) {

            if(isset($params[$key]) && isset($val['self']))
                $this->$key = $params[$key];
        }
    }

    public function save() {

        $attr = array();
        foreach($this->attributes as $key => $val) {

            if(!empty($this->$key))
                $attr[$key] = $this->$key;
        }

        return Connect::db()->insert($this->table, $attr);
    }

    public function validate($attr = array()) {

        $attr = array();
        foreach($this->attributes as $key => $val) {

            if(!empty($this->$key))
                $attr[$key] = $this->$key;
        }

        return Connect::db()->insert($this->table, $attr);
    }

}