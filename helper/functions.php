<?php

function register(&$errors){

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $member = [
    'firstName' => $_POST['firstName'],
    'lastName' => $_POST['lastName'],
    'gender' => $_POST['genderRadio'],
    'phoneNumber' => $_POST['phoneNumber'],
    'email' => $_POST['email'],
    'password' => $password
    ];

    $member = new \Trainingskalender\models\Member($member);

    $member->save($errors);

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

function isEmailUnique(&$errors)
{
    $result = \Trainingskalender\models\Member::find('email= ' . '\'' . $_POST['email'] . '\'');
    if (count($result) === 0) {
        return true;
    }
    array_push($errors, "E-Mail-Adresse existiert bereits");
    return false;
}

//should have minimum 1 char and 1 number
function isPasswordValid(&$errors)
{

    if (!preg_match('/[a-zA-Z]/', $_POST['password'])) {
        array_push($errors, "Verwenden Sie mindestens ein Buchstabensymbol für Ihr Passwort");
        return false;
    }
    if (!preg_match('/[0-9]/', $_POST['password'])) {

        array_push($errors, "Verwenden Sie mindestens ein Nummernsymbol für Ihr Passwort");
        return false;
    }
    if (strlen($_POST['password']) < 8) {
        array_push($errors, "Bitte verwenden Sie mindestens 8 Symbole für Ihr Passwort");
        return false;
    }
    return true;
}

function isValidRegister(&$errors){
   $arePwTheSame  = arePwdAndPwdCheckTheSame($errors);
   $isEmailUnique = isEmailUnique($errors);
   $isPasswordValid = isPasswordValid($errors);

   if($arePwTheSame && $isEmailUnique && $isPasswordValid){
       return true;
   }
   else{
       return false;
   }
}

/*
function isPasswordfromUser($password, $email, &$errors, $isEmail=true)
{

    $dbQuery = skwd\models\Account::find('email= ' . '\'' . $email . '\'');

    if (!empty($dbQuery)) {

        // "Wrong password or email" is for the login form
        // "Wrong old password" is for personal data password change because there is no field for email
        if (password_verify($password, $dbQuery[0]['password'])) {
            return true;
        } else {
            if ($isEmail == true) {
                array_push($errors, "Wrong password or email");
                return false;
            } else {
                array_push($errors, "Wrong old password");
                return false;
            }
        }
    } else {
        if ($isEmail == true) {
            array_push($errors, "Wrong password or email");
            return false;
        } else {
            array_push($errors, "Wrong old password");
            return false;
        }
    }

}


//rememberMe shows if the checkbox in login form is set
function login($password, $email, $rememberMe, &$errors)
{
    $isLoginSuccessful = false;
    $isLoginSuccessful = isPasswordfromUser($password, $email, $errors);
    //if remember me is set, the user should remain logged in after closing the browser window
    if ($isLoginSuccessful == true && $rememberMe == true) {
        $dbQuery = \skwd\models\Account::find('email= ' . '\'' . $email . '\'');
        $id = $dbQuery[0]['id'];
        rememberMe($email, $id);
    }

    return $isLoginSuccessful;
}

function logout()
{
    unset($_SESSION['id']);
    session_destroy();
    
    setcookie('id', '', -1, '/');
    header('Location: index.php?c=pages&a=start');
}

function rememberMe($email, $id)
{
    // coockie is set for 1 month
    $duration = time() + 3600 * 24 * 30;

    setcookie('id', $id, $duration, '/');
}

function getAccountId()
{
    if (isset($_SESSION['id'])) {
        return $_SESSION['id'];
    } else if (isset($_COOKIE['id'])) {
        return $_COOKIE['id'];
    } else return null;
}
*/

function login(&$errors){

    $member = Trainingskalender\models\Member::find('email= ' . '\'' . $_POST['email'] . '\'');

    if(memberExists($errors, $member)){

        if(isPasswordfromUser($errors, $member)){
            setIdForCookieOrSession($member);
            return true;
        }
        else{
            return false;
        }

    }
    else{
        return false;
    }
  
}


function isPasswordfromUser(&$errors, $member){
    
    if (password_verify($_POST['password'], $member[0]['password'])) {
        return true;
    } else {
       
        array_push($errors, "Wrong password or email");
        return false;
    } 

}

function memberExists(&$errors, $member){

    if(empty($member)){
        array_push($errors, "Wrong password or email");
        return false;
    }
    else {
        return true;
    }

}

function setIdForCookieOrSession($member){

    if(isset($_POST['rememberMe'])){
        stayLoggedIn($member);
    }
    else{
        $_SESSION['id'] = $member[0]['id'];
    }

}

function stayLoggedIn($member)
{
    // coockie is set for 1 month
    $duration = time() + 3600 * 24 * 30;

    setcookie('id', $member[0]['id'], $duration, '/');
}

function logout()
{
    unset($_SESSION['id']);
    session_destroy();
    
    setcookie('id', '', -1, '/');
    header('Location: index.php?c=pages&a=start');
}

