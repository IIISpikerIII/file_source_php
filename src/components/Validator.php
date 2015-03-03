<?php

class Validator {

    public function email($attr, $val){

        $reg = '/.+@.+\..+/i';

        if($this->validateReg($val, $reg) === false && !empty($val))
            return $this->addError($attr, "Не верно введен email");

        return true;
    }

    public function maxlength($attr, $val,  $length){

        $leng = strlen($val);

        if($leng > $length)
            return $this->addError($attr, "Максимальное количество символов ".$length);

        return true;
    }

    public function unique($attr, $val, $class){

        $model = Connect::db()->select($class::$table, $attr.' = "'.$val.'"');

        if(sizeof($model) > 0)
            return $this->addError($attr, "Значение должно быть уникальным");

        return true;
    }

    public function required($attr, $val){

        $val = trim($val);

        if(empty($val))
            return $this->addError($attr, "Поле обязательно для заполнения");

        return true;
    }

    public function filesize($attr, $val, $size){

       $filesize = filesize($val);

        if($filesize > $size)
            return $this->addError($attr, "Максимальный размер файла ".$size);

        return true;
    }

    private function validateReg($val, $reg){

        if(preg_match($reg, $val) === 1)
            return true;

        return false;
    }

    private function addError($attr, $msg){

        return array($attr => $msg);
    }
}