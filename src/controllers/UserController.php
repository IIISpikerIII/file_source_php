<?php

class UserController extends Controller {

    public function registration(){

        $model = new User();

        if(isset($_POST['User'])){

            $model->setAttributes($_POST['User']);
            $model->b_date = date('Y-m-d H:i:s', strtotime($model->b_date));
            $model->role = 'user';
            $model->pass = User::generatePass($model->pass);

            if($model->save())
                echo 'YES';
            else
                print_r($model);
        }

        $this->render('registration', array (
            'model' => $model,
        ));
    }

    public function login(){

        $model = new User();
        if(isset($_POST['User'])){

            $model->setAttributes($_POST['User']);
            $model->authenticate();
        }

        $this->render('login', array (
            'model' => $model,
        ));
    }

    public function logout(){

        User::logout();
    }
}