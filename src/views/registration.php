<form id="login-form" method="post">

    <h1>Регистрация</h1>
    <table>
        <tbody><tr>
            <td><label for="User_login" class="required">Логин <span class="required">*</span></label></td>
            <td><input name="User[login]" id="User_login" type="text" maxlength="50">            </td>
        </tr>

        <tr>
            <td><label for="User_pass" class="required">Пароль <span class="required">*</span></label></td>
            <td><input name="User[pass]" id="User_pass" type="password" maxlength="50">            </td>
        </tr>

        <tr>
            <td><label for="User_f_name" class="required">Имя <span class="required">*</span></label></td>
            <td><input name="User[f_name]" id="User_f_name" type="text" maxlength="100">                </td>
        </tr>

        <tr>
            <td><label for="User_s_name" class="required">Фамилия <span class="required">*</span></label></td>
            <td><input name="User[s_name]" id="User_s_name" type="text" maxlength="100">                </td>
        </tr>

        <tr>
            <td><label for="User_email">Email</label></td>
            <td><input name="User[email]" id="User_email" type="email">                </td>
        </tr>

        <tr>
            <td><label for="User_phone">Телефон</label></td>
            <td><input name="User[phone]" id="User_phone" type="text" maxlength="50" value="">                </td>
        </tr>

        <tr>
            <td><label for="User_b_date">Дата Рождения</label></td>
            <td><input name="User[b_date]" id="User_b_date" type="date" value="0000-00-00 00:00:00">                </td>
        </tr>

        <tr>
            <td><input type="submit" name="yt0" value=" Сохранить "></td>
        </tr>
        </tbody></table>

</form>
