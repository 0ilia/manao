<?php
function generateSalt()
{
    $salt = '';
    $saltLength = 17;
    for ($i = 0; $i < $saltLength; $i++) {
        $salt .= chr(mt_rand(33, 126));
    }
    return $salt;
}

$errors = array();
$login = trim(htmlentities($_POST['loginAN'], ENT_QUOTES));
$password = trim(htmlentities($_POST['passwordAN'], ENT_QUOTES));

if ((strlen($login) > 3) && (strlen($login) < 16) &&
    (strlen($password) > 5) && (strlen($password) < 61)
) {

    $state = 0;
    $currentUser = 0;
    $xml = simplexml_load_file('users.xml');
    foreach ($xml as $user) {
        if ($user->login == $login) {
            $state++;
            $passwordHash = $user->password;
            $name = $user->name;
            $loginForCook = $user->login;
            $saltBD = $user->salt;
            break;
        }
        $currentUser++;
    }
    if ($state == 1) {
        if (md5($saltBD . $password) == $passwordHash) {
            session_start();
            $_SESSION['name'] = (string)$name;
            $_SESSION['login'] = (string)$login;
            $key = generateSalt();
            $xml = simplexml_load_file('users.xml');
            $xml->user[$currentUser]->cookie = $key;
            setcookie('login', $loginForCook, time() + 60 * 60 * 24 * 30, '/');
            setcookie('key', $key, time() + 60 * 60 * 24 * 30, '/');
            echo json_encode(array("0" => "Вы вошли , обновите страницу"));
        } else {
            $errors[] = "Неверный пароль";
        }
    } else {
        $errors[] = "Логин не найден";
    }
    if (empty($errors)) {
        file_put_contents('users.xml', $xml->asXML());
    } else {
        $shiftError = array_shift($errors);
        echo json_encode(array("0" => $shiftError));
    }
} else {
    echo json_encode(array("0" => "Заполните все поля"));
}
