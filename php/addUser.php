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
$login = trim(htmlentities($_POST['loginRN'], ENT_QUOTES));
$password = trim(htmlentities($_POST['passwordRN'], ENT_QUOTES));
$password2 = trim(htmlentities($_POST['confirm_passwordRN'], ENT_QUOTES));
$email = trim(htmlentities($_POST['emailRN'], ENT_QUOTES));
$name = trim(htmlentities($_POST['nameRN'], ENT_QUOTES));
if ((strlen($login) > 3) && (strlen($login) < 16) &&
    (strlen($password) > 5) && (strlen($password) < 61) &&
    (strlen($email) > 4) &&
    (strlen($name) > 1) && (strlen($name) < 13)
) {
    $salt = generateSalt();
    $passwordHash = md5($salt . $password);
    $xml = simplexml_load_file('users.xml');
    $xml->addChild('user');
    $count = count($xml);
    foreach ($xml as $user) {
        if ($user->login == $login) {
            $errors[] = "Логин занят";
        }
        if ($user->email == $email) {
            $errors[] = "E-mail уже зарегистрирован";
        }
    }
    if ($password != $password2) {
        $errors[] = "Пароли не совпадают";
    }
    if (empty($errors)) {
        $xml->user[$count - 1]->addAttribute("id", $count - 1);
        $xml->user[$count - 1]->addChild('login', $login);
        $xml->user[$count - 1]->addChild('password', $passwordHash);
        $xml->user[$count - 1]->addChild('email', $email);
        $xml->user[$count - 1]->addChild('name', $name);
        $xml->user[$count - 1]->addChild('cookie');
        $xml->user[$count - 1]->addChild('salt', $salt);
        $xml->user[$count - 1]->addChild('date', date("F j, Y, g:i a"));
        $xml->user[$count - 1]->addChild('ip', $_SERVER['REMOTE_ADDR']);
        file_put_contents('users.xml', $xml->asXML());
        echo json_encode(array("0" => "Вы зарегистрированы"));
    } else {
        $shiftError = array_shift($errors);
        echo json_encode(array("0" => $shiftError));
    }
} else {
    echo json_encode(array("0" => "Заполните все поля"));
}
