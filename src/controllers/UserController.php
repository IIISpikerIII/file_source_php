<?php

class UserController extends Controller {

    public function registration(){

        $model = new User();

        if(isset($_POST['User'])){

            $model->setAttributes($_POST['User']);
            $model->b_date = date('Y-m-d H:i:s', strtotime($model->b_date));

            if($model->save())
                echo 'YES';
        }

        $this->render('registration', array (
            'model' => $model,
        ));
    }
}