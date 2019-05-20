<?php
session_start();
$_SESSION = array();
setcookie('key', null, -1, '/');
setcookie('login', null, -1, '/');
echo json_encode(array("0"=>"Вы вышли , обновите страницу"));
