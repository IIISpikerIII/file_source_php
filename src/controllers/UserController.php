<?php

class UserController extends Controller {

    protected $protected_method = array(
        'profile'
    );

    protected function registration(){

        $model = new User();

        if(isset($_POST['User'])){

            $model->setAttributes($_POST['User']);
            $model->b_date = date('Y-m-d H:i:s', strtotime($model->b_date));
            $model->role = 'user';
            $model->pass = User::generatePass($model->pass);

            if($model->save())
                header('Location: /?cont=user&act=login');
        }

        $this->render('registration', array (
            'model' => $model,
            'edit'  => 0
        ));
    }

    protected function profile(){

        $usr_id = $this->usr_id;
        $data = Connect::db()->select(User::$table, 'id = '.$usr_id);

        $model = new User;
        $model->setAttributes(end($data));

        if(isset($_POST['User']) && sizeof($model) > 0){

            $attr = $_POST['User'];
            $attr['b_date'] = date('Y-m-d H:i:s', strtotime($attr['b_date']));
            $attr['pass'] = User::generatePass($attr['pass']);

            $model->setAttributes($attr);

            if($model->validate() === true){
                if(Connect::db()->update(User::$table, $attr, 'id = '.$usr_id)) {
                    Logs::logChange(end($data), $attr);
                    header('Location: /?cont=user&act=profile');
                }
            }
        }

        $this->render('registration', array (
            'model' => $model,
            'edit'  => 1
        ));
    }

    protected function login() {

        $model = new User();
        if(isset($_POST['User'])){

            $model->setAttributes($_POST['User']);
            $model->authenticate();
        }

        $this->render('login', array (
            'model' => $model,
        ));
    }

    protected function logout(){

        User::logout();
        header('Location: /?cont=user&act=index');
    }

    protected function index() {
        $this->render('index');
    }
}