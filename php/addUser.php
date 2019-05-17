<?php

$salt = 'r5LL';
$errors = array();
$login = trim(htmlentities($_POST['loginRN'], ENT_QUOTES));
$password = trim(htmlentities($_POST['passwordRN'].$salt, ENT_QUOTES));
$password2 =trim(htmlentities($_POST['confirm_passwordRN'].$salt, ENT_QUOTES));
$email = trim(htmlentities($_POST['emailRN'], ENT_QUOTES));
$name = trim(htmlentities($_POST['nameRN'], ENT_QUOTES));

if ((strlen($login)>3)&&(strlen($login)<16)&&
    (strlen($password)>5)&&(strlen($password)<61)&&
    (strlen($email)>6)&&
    (strlen($name)>1)&&(strlen($name)<13)
) {
    $passwordHash = (password_hash($password,PASSWORD_DEFAULT));
    $xml = simplexml_load_file('users.xml');
    $xml->addChild('user');
    $count = count($xml);

    foreach ($xml as $user){

        if($user->login==$login){
            $errors[] ="Логин занят";
            break;
        }

    }
    if($password!=$password2){
        $errors[] ="Пароли не совпадают";
    }
    if(empty($errors)) {
        $xml->user[$count - 1]->addAttribute("id", $count - 1);
        $xml->user[$count - 1]->addChild('login', $login);
        $xml->user[$count - 1]->addChild('password', $passwordHash);
        $xml->user[$count - 1]->addChild('email', $email);
        $xml->user[$count - 1]->addChild('name', $name);
        $xml->user[$count - 1]->addChild('name', date("F j, Y, g:i a"));

        file_put_contents('users.xml', $xml->asXML());
    }else{
        echo array_shift($errors);
    }
}
