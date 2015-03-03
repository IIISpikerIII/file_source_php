
<h1>Авторизация</h1>

<form id="login-form" method="post">
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
            <td><input type="submit" name="yt0" value=" Вход на сайт "></td>
        </tr>
        </tbody></table>

</form>