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
        $err = array();

        //attributes model
        foreach($this->attributes as $key => $val) {

            if(isset($val['valid']) && is_array($val['valid'])) {

                // validators model
                foreach($val['valid'] as $validator) {

                    if($error = $this->validateAttribute($key, $validator) !== true)
                        $err[] = $error;
                }
            }
        }

        $err = sizeof($err > 0)? $err : true;

        return $err;
    }

    public function validateAttribute($attr, $validator) {

        $valid = new Validator();
        $answer = true;

        if(method_exists($valid, $validator))
            $answer = $valid->$attr;

        return $answer;
    }
}