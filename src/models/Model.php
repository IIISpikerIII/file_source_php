<?php

/**
 * Class Model
 * main model abstract class
 */
abstract class Model {

    public static $table;
    public $attributes = array();
    public $errors = array();
    public $service;

    /**
     * Set attribute to model
     * @param array $params
     */
    public function setAttributes($params = array()) {

        foreach($this->attributes as $key => $val) {

            if(isset($params[$key]) && isset($val['self']))
                $this->$key = $params[$key];
        }
    }

    /**
     * save and validate model
     * @return bool
     */
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

        return (Connect::db()->insert(static::$table, $attr) === 1)? true: false;
    }

    /**
     * Validate model
     * @param bool $attr
     * @return array|bool
     */
    public function validate($attr = false) {

        $attr = $attr !== false? array($attr => $this->attributes[$attr]): $this->attributes;
        $err = array();

        //attributes model
        foreach($attr as $key => $val) {

            if(isset($val['valid']) && is_array($val['valid'])) {

                // validators model
                foreach($val['valid'] as $id => $validator) {

                    if(is_numeric($id))
                        $error = $this->validateAttribute($key, $this->$key, $validator);
                    else
                        $error = $this->validateAttribute($key, $this->$key, $id, $validator);

                    if($error !== true) $err[$key][] = array_shift($error);
                }
            }
        }

        if( sizeof($err) > 0)
            $this->errors = $err;
        else
            $err = true;

        return $err;
    }

    /**
     * Validate attribute model
     * @param $key
     * @param $val
     * @param $validator
     * @param null $param
     * @return bool|mixed
     */
    public function validateAttribute($key, $val, $validator, $param = null) {

        $valid = new Validator();
        $answer = true;

        if(method_exists($valid, $validator))
            $answer = call_user_func_array(array($valid, $validator), array($key, $val, $param));

        return $answer;
    }

    /**
     * get label attribute model
     * @param $attr
     * @return null
     */
    public function label($attr) {

        $answer = null;
        if(!isset($this->attributes[$attr]))
            return $answer;

        $answer = $attr;
        if(!isset($this->attributes[$attr]['label']))
            return $answer;

        $answer = $this->attributes[$attr]['label'];
        return $answer;
    }

    /**
     * formating error array
     * @return string
     */
    public function formatError(){

        $out = '';
        foreach($this->errors as $key=>$val) {
            $out.=$this->label($key).'<br/>';
            $out.= implode('<br/>', $val).'<br/>';
        }

        return $out;
    }
}