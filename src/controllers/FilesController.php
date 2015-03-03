<?php

class FilesController extends Controller {

    protected $protected_method = array(
        'storage',
        'upload',
        'remove'
    );

    /**
     * Storage and upload files
     * @throws FSException
     */
    protected function storage(){

        $model = new Files();
        $usr_id = $this->usr_id;

        // load files
        if(isset($_FILES['Files'])) {

            $files = $_FILES['Files']['name']['files'];

            foreach($files as $key => $file) {

                $model_files = new Files();
                $model_files->files = $_FILES['Files']['tmp_name']['files'][$key];

                //valid and limit
                $err = $model_files->validate('files');
                $limit = Files::checkLimit($usr_id);

                if($err === true && $limit) {

                    $path = FileHelper::load_file($model_files->files);
                    $model_files->file = $path;
                    $model_files->id_user = $usr_id;
                    $model_files->name = $file;
                    $model_files->created = date('Y-m-d H:i:s',time());

                    if($model_files->save()) {
                        Logs::setLog('files', $model_files->name, $usr_id);
                        header('Location : /?cont=files&act=storage');
                    } else
                        FileHelper::remove_file($path);

                } else
                    $model->errors = $err;
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

    /**
     * Upload file
     */
    public function upload()
    {
        $usr_id = User::isAuth('id');
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $file = Connect::db()->select(Files::$table,'id = ' . $id . ' AND id_user = ' . $usr_id);

            if (empty($file))
                header('Location : /?cont=user&act=login');

            $file = end($file);
            FileHelper::upload_file($file['file']);
        }
    }

    /**
     * remove file
     */
    public function remove()
    {
        $usr_id = User::isAuth('id');

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $file = Connect::db()->select(Files::$table,'id = ' . $id . ' AND id_user = ' . $usr_id);

            if (empty($file))
                header('Location : /?cont=user&act=login');

            $file = end($file);
            Connect::db()->delete(Files::$table,'id = ' . $id . ' AND id_user = ' . $usr_id);
            FileHelper::remove_file($file['file']);
        }

        header('Location: /?cont=files&act=storage');

    }
}