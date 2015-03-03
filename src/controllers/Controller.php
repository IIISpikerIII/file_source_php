<?php

abstract class Controller {

    public function render($file, $params = array()) {

        $tmpl= BASE_PATH.'/view/layout.php';
        $file = BASE_PATH.'/view/'.$file.'.php';

        $result = null;

        ob_start();

        extract($params);

        if (!is_file($file) || !is_file($tmpl)) {
            echo 'No file';

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