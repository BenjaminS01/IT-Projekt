<?php

function register(&$errors){

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $member = [
    'firstName' => $_POST['firstName'],
    'lastName' => $_POST['lastName'],
    'gender' => $_POST['gender'],
    'phoneNumber' => $_POST['phoneNumber'],
    'email' => $_POST['email'],
    'password' => $password
    ];

}

/**
 * returns true if both password fields in register form are the same
 *
 * @return boolean
 */
function arePwdAndPwdCheckTheSame(&$errors){
    if($_POST['password']===$_POST['passwordCheck']){
        return true;
    }
    else{
        array_push($errors, "beide Passwortfelder müssen übereinstimmen");
        return false;
    }
}

function isEmailUnique(&$errors, $email)
{
    $result = \Trainingskalender\models\Account::find('email= ' . '\'' . $email . '\'');
    if (count($result) === 0) {
        return true;
    }
    array_push($errors, "E-Mail-Adresse existiert bereits");
    return false;
}

//should have minimum 1 char and 1 number
function isPasswordValid(&$errors, $password)
{

    if (!preg_match('/[a-zA-Z]/', $password)) {
        array_push($errors, "Verwenden Sie mindestens ein Buchstabensymbol für Ihr Passwort");
        return false;
    }
    if (!preg_match('/[0-9]/', $password)) {

        array_push($errors, "Verwenden Sie mindestens ein Nummernsymbol für Ihr Passwort");
        return false;
    }
    if (strlen($password) < 8) {
        array_push($errors, "Bitte verwenden Sie mindestens 8 Symbole für Ihr Passwort");
        return false;
    }
    return true;
}

function isValidRegister(&$errors){
   $arePwTheSame  = arePwdAndPwdCheckTheSame($errors);
   $isEmailUnique = isEmailUnique($errors);
   $isPasswordValid = isPasswordValid($errors);
}
