<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ru-RU" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>

<?User::isAuth()?>
<body>

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="/?cont=files&act=storage">ХРАНИЛИЩЕ</a></li>
                <li><a href="/?cont=user&act=registration">РЕГИСТРАЦИЯ</a></li>
                <li><a href="/?cont=user&act=login">ВХОД</a></li>
                <li><a href="/?cont=user&act=logout">ВЫХОД</a></li>
            </ul>
        </div>
    </nav>

    <div style="margin: auto; width: 500px;">
        <?=$content?>
    </div>
</body>
</html>