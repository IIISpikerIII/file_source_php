<?php

class FilesController extends Controller {

    public function storage(){
        $model = new Files();
        $usr_id = User::isAuth('id');

        // load files
        if(isset($_FILES['Files'])) {

            $files = $_FILES['Files']['name']['files'];

            foreach($files as $key => $file) {

                $model_files = new Files();
                $model_files->files = $_FILES['Files']['tmp_name']['files'][$key];
                $err = $model_files->validate('files');

                if($err === true) {

                    $path = FileHelper::load_file($model_files->files);
                    $model_files->file = $path;
                    $model_files->id_user = $usr_id;
                    $model_files->name = $file;
                    $model_files->created = date('Y-m-d H:i:s',time());

                    $model_files->save();
                } else
                    $model->errors[] = $err[0];
            }
        }

        $files = Connect::db()->select(Files::$table, 'id_user = '.$usr_id);
        $limit = Connect::config('fileLimit') - sizeof($files);

        $this->render('storage', array(
            'model' => $model,
            'files' => $files,
            'limit' => $limit,
        ));

    }

    public function upload()
    {
        $usr_id = User::isAuth('id');
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $file = Connect::db()->select(Files::$table,'id = ' . $id . ' AND id_user = ' . $usr_id);

            if (empty($file))
                return;

            $file = end($file);
            FileHelper::upload_file($file['file']);
        }
    }

    public function remove()
    {
        $usr_id = User::isAuth('id');
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $file = Connect::db()->select(Files::$table,'id = ' . $id . ' AND id_user = ' . $usr_id);

            if (empty($file))
                return;

            $file = end($file);
            Connect::db()->delete(Files::$table,'id = ' . $id . ' AND id_user = ' . $usr_id);
            FileHelper::remove_file($file['file']);
        }
    }
}