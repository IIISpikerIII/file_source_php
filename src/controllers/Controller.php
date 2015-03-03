<?php

/**
 * Class Controller
 * main abstract controller class
 */
abstract class Controller {

    //list protected method
    protected $protected_method = array();
    protected $usr_id;

    /**
     * controll access
     * @param $method
     * @param array $params
     */
    public function __call($method, array $params) {

        if(method_exists($this, $method)) {

            if($this->checkAccess($method))
                call_user_func(array($this, $method), $params);
            else
                header('Location: /?cont=user&act=login');
        } else
            header('Location: /?cont=user&act=error');

    }

    /**
     * check user access
     * @param $method
     * @return bool
     */
    public function checkAccess($method) {

        if(in_array($method, $this->protected_method)){

            $this->usr_id = User::isAuth('id');
            if($this->usr_id === false) return false;
        }

        return true;
    }

    /**
     * render template
     * @param $file
     * @param array $params
     * @throws FSException
     */
    public function render($file, $params = array()) {

        $tmpl= BASE_PATH.'/views/layout.php';
        $file = BASE_PATH.'/views/'.$file.'.php';

        $result = null;

        ob_start();

        extract($params);

        if (!is_file($file) || !is_file($tmpl)) {
            throw new FSException('404', 'Шаблон не найден');

        } else {

            require $file;

            $content =  ob_get_contents();
            ob_end_clean();
            ob_start();

            require $tmpl;

            $result = ob_get_contents();
            ob_end_clean();
        }

        echo $result;
    }

}