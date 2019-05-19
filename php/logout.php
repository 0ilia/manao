<?php
header('Location: http://manao/index.php');

session_start();
$_SESSION = array();
setcookie('key', null, -1, '/');
setcookie('login', null, -1, '/');
/*
    session_start();
    session_destroy(); //разрушаем сессию для пользователя

    //Удаляем куки авторизации путем установления времени их жизни на текущий момент:
    setcookie('login', '', time()); //удаляем логин
    setcookie('key', '', time()); //удаляем ключ
*/
var_dump($_COOKIE);
var_dump($_SESSION);
