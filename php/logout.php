<?php
session_start();
$_SESSION = array();
setcookie('key', null, -1, '/');
setcookie('login', null, -1, '/');
echo "Вы вышли , обновите страницу";
