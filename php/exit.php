<?php
session_start();
if(!(empty($_SESSION['login']))&& !(empty($_SESSION['name']))) {
unset($_SESSION['name']);
unset($_SESSION['login']);
setcookie('login', '', time());
setcookie('key', '', time());
}