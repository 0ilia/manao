<?php
$salt = 'r5LL';
$errors = array();
$login = trim(htmlentities($_POST['loginAN'], ENT_QUOTES));
$password = trim(htmlentities($_POST['passwordAN'].$salt, ENT_QUOTES));

if ((strlen($login)>3)&&(strlen($login)<16)&&
    (strlen($password)>5)&&(strlen($password)<61)
) {

$state = 0 ;

    $xml = simplexml_load_file('users.xml');
    foreach ($xml as $user){
        if($user->login==$login) {
            $state++;
            $passwordHash = $user->password;
        $name = $user->name;
            break;
        }
    }
    if($state == 1 ){
        if(password_verify($password,$passwordHash)){
            echo "Hello ".$name;
        //куки
        }else{
            $errors[] = "Неверный пароль";
        }

    }else{
        $errors[] = "Логин не найден";
    }
    if(empty($errors)) {
        file_put_contents('users.xml', $xml->asXML());
    }else{
        echo array_shift($errors);
    }

}else{
    echo "Заполните все поля";
}