<?php

abstract class Model {

    public $table;
    public $attributes = array();
    public $errors = array();

    public function setAttributes($params = array()) {

        foreach($this->attributes as $key => $val) {

            if(isset($params[$key]) && isset($val['self']))
                $this->$key = $params[$key];
        }
    }

    public function save() {

        // validate model before save
        $valid = $this->validate();
        if($valid !== true) {

            $this->errors = $valid;
            return false;
        }

        $attr = array();
        foreach($this->attributes as $key => $val) {

            if(!empty($this->$key))
                $attr[$key] = $this->$key;
        }


        return (Connect::db()->insert($this->table, $attr) === 1)? true: false;
    }

    public function validate($attr = array()) {

        $attr = array();
        $err = array();

        //attributes model
        foreach($this->attributes as $key => $val) {

            if(isset($val['valid']) && is_array($val['valid'])) {

                // validators model
                foreach($val['valid'] as $id => $validator) {

                    if(is_numeric($id))
                        $error = $this->validateAttribute($key, $this->$key, $validator);
                    else
                        $error = $this->validateAttribute($key, $this->$key, $id, $validator);

                    if($error !== true) $err[] = $error;
                }
            }
        }

        $err = sizeof($err > 0)? $err : true;

        return $err;
    }

    public function validateAttribute($key, $val, $validator, $param = null) {

        $valid = new Validator();
        $answer = true;

        if(method_exists($valid, $validator))
            $answer = call_user_func_array(array($valid, $validator), array($key, $val, $param));

        return $answer;
    }
}