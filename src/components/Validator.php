<?php

class Validator {

    public function email($attr){

        $reg = '/.+@.+\..+/i';

        if($this->validateReg($attr, $reg) === false) {
            return $this->addError($attr, "Не верно введен email");
        }

        return true;
    }

    private function validateReg($attr, $reg){

        if(preg_match($reg, $attr) === 1)
            return true;

        return false;
    }

    private function addError($attr, $msg){

        return array($attr => $msg);
    }
}