<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manao</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<div id="registrationAuthorization">
    <button id="registrationButton">Регистрация</button>
    <button id="authorizationButton">Авторизации</button>
</div>
<div id="registration">
    <form id="fromReg" action="" method="post">
        <label for="loginRI">Логин:</label><br>
        <input  minlength="4" maxlength="15" name="loginRN" required id="loginRI" type="text"><br>
        <label for="passwordRI">Пароль:</label><br>
        <input minlength="6" maxlength="56" name="passwordRN" required id="passwordRI" type="password"><br>
        <label for="confirm_passwordRI">Повторите пароль:</label><br>
        <input required name="confirm_passwordRN" id="confirm_passwordRI" type="password"><br>
        <label for="emailRI">E-mail:</label><br>
        <input minlength="5" required type="email" name="emailRN" id="emailRI"><br>
        <label for="nameRI">Имя:</label><br>
        <input  minlength="2" maxlength="12" type="text" required name="nameRN" id="nameRI"><br>
        <input type="submit" id="AddUserI" name="AddUserN" value="Зарегистрироваться">
    </form>
</div>
<div id="authorization">
    <form action="" method="post">
        <label for="loginA">Логин:</label><br>
        <input required id="loginA" type="text"><br>
        <label for="passworldA">Пароль:</label><br>
        <input required id="passworldA" type="password"><br>
        <input type="submit" value="Вход" id="CorrectUser">
    </form>
</div>
<div id="resmess"></div>


<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>
