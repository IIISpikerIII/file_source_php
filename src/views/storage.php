<h1>Хранилище файлов</h1>

<p>Лимит файлов: <?=$limit?></p>

<form enctype="multipart/form-data" class="upform MultiFile-intercepted" id="login-form" method="post">
    <table>
            <?if(sizeof($files) > 0):?>
                <?foreach($files as $file):?>
                    <tr>
                        <td>
                            <?=$file['name']?>
                            <a href="/?cont=files&act=upload&id=<?=$file['id']?>">Скачать</a>
                            <a href="/?cont=files&act=remove&id=<?=$file['id']?>">Удалить</a>
                        </td>
                    </tr>
                <?endforeach;?>
            <?endif;?>

            <tr>
                <td>
                    <div class="MultiFile-wrap" id="Files_files_wrap">
                        <input id="Files_files" type="file" value="" name="Files[files][]" class="MultiFile-applied">
                        <?print_r($model->errors)?>
                    </div>
                </td>
            </tr>

            <tr>
                <td><input type="submit" name="yt0" value=" Загрузить "></td>
            </tr>
    </table>

</form>