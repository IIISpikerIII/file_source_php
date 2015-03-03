<form id="login-form" method="post">

    <h1>Регистрация</h1>
    <table>
        <tbody><tr>
            <td><label for="User_login"><?=$model->label('login')?><span class="required">*</span></label></td>
            <td><input name="User[login]" id="User_login" type="text" maxlength="50">            </td>
        </tr>

        <tr>
            <td><label for="User_pass"><?=$model->label('pass')?><span class="required">*</span></label></td>
            <td><input name="User[pass]" id="User_pass" type="password" maxlength="50">            </td>
        </tr>

        <tr>
            <td><label for="User_f_name"><?=$model->label('f_name')?><span class="required">*</span></label></td>
            <td><input name="User[f_name]" id="User_f_name" type="text" maxlength="100">                </td>
        </tr>

        <tr>
            <td><label for="User_s_name"><?=$model->label('s_name')?><span class="required">*</span></label></td>
            <td><input name="User[s_name]" id="User_s_name" type="text" maxlength="100">                </td>
        </tr>

        <tr>
            <td><label for="User_email"><?=$model->label('email')?></label></td>
            <td><input name="User[email]" id="User_email" type="email">                </td>
        </tr>

        <tr>
            <td><label for="User_phone"><?=$model->label('phone')?></label></td>
            <td><input name="User[phone]" id="User_phone" type="text" maxlength="50" value="">                </td>
        </tr>

        <tr>
            <td><label for="User_b_date"><?=$model->label('b_date')?></label></td>
            <td><input name="User[b_date]" id="User_b_date" type="date" value="0000-00-00 00:00:00">                </td>
        </tr>

        <?if(!empty($model->errors)) print_r($model->errors);?>
        <tr>
            <td><input type="submit" name="yt0" value=" Сохранить "></td>
        </tr>
        </tbody></table>

</form>
