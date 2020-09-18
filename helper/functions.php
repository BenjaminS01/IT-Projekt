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

/**
 * returns true if both password fields in edit password form are the same
 *
 * @return boolean
 */

function areNewPwdAndNewPwdCheckTheSame(&$errors){
    if($_POST['newPassword']===$_POST['passwordCheck']){
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

//should have minimum 1 char and 1 number an a password length of 8 characters 
function isPasswordValid(&$errors)
{

    if (!preg_match('/[a-zA-Z]/', $_POST['password'])) {
        array_push($errors, "Verwenden Sie mindestens ein Buchstabensymbol für Ihr Passwort");
        return false;
    }
    if (!preg_match('/[0-9]/', $_POST['password'])) {

        array_push($errors, "Verwenden Sie mindestens eine Ziffer für Ihr Passwort");
        return false;
    }
    if (strlen($_POST['password']) < 8) {
        array_push($errors, "Bitte verwenden Sie mindestens 8 Symbole für Ihr Passwort");
        return false;
    }
    return true;
}

//should have minimum 1 char and 1 number an a password length of 8 characters 
function isNewPasswordValid(&$errors)
{

    if (!preg_match('/[a-zA-Z]/', $_POST['newPassword'])) {
        array_push($errors, "Verwenden Sie mindestens ein Buchstabensymbol für Ihr Passwort");
        return false;
    }
    if (!preg_match('/[0-9]/', $_POST['newPassword'])) {

        array_push($errors, "Verwenden Sie mindestens ein Nummernsymbol für Ihr Passwort");
        return false;
    }
    if (strlen($_POST['newPassword']) < 8) {
        array_push($errors, "Bitte verwenden Sie mindestens 8 Symbole für Ihr Passwort");
        return false;
    }
    return true;
}

function validateEmail(&$errors){
   
    $pattern = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

    if(preg_match($pattern, $_POST['email'])!==1){
        array_push($errors, 'Bitte geben Sie eine gültige E-Mail-Adresse ein');
        return false;
    }
    return true;
}

function isValidRegister(&$errors){

   requiredCheck($errors);
   $arePwTheSame  = arePwdAndPwdCheckTheSame($errors);
   $isEmailUnique = isEmailUnique($errors);
   $isPasswordValid = isPasswordValid($errors);
   $isValidateEmail = validateEmail($errors);

   if($arePwTheSame && $isEmailUnique && $isValidateEmail && $isPasswordValid && count($errors)==0){
       return true;
   }
   else{
       return false;
   }
}

function isValidPersonalData(&$errors, $member){
    

    $isEmailUnique = true;
    if($_POST['email']!==$member[0]['email']){

        $isEmailUnique = isEmailUnique($errors);
    }

    validateEmail($errors);

    requiredCheckEditPersonalData($errors);
 
    if((count($errors) === 0)){
        return true;
    }
    else{
        return false;
    }
 }

 function isValidPassword(&$errors, $member){
    $arePwTheSame  = areNewPwdAndNewPwdCheckTheSame($errors);
    $isPasswordValid = isNewPasswordValid($errors);
    $isPasswordFromUser = isPasswordfromUser($errors, $member);
 
    if($arePwTheSame && $isPasswordValid && $isPasswordFromUser){
        return true;
    }
    else{
        return false;
    }
 }

 function editPassword(&$errors, $id, $firstName, $lastName,$gender, $phoneNumber, $email){
    $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

    $member = [
    'id' => $id,
    'firstName' => $firstName,
    'lastName' => $lastName,
    'gender' => $gender,
    'phoneNumber' => $phoneNumber,
    'email' => $email,
    'password' => $password
    ];

    $member = new \Trainingskalender\models\Member($member);

    $member->save($errors);
 }

 function editPersonalData(&$errors, $id,$gender,$password){
   // $password = password_hash($password, PASSWORD_DEFAULT);

    $member = [
    'id' => $id,
    'firstName' => $_POST['firstName'],
    'lastName' => $_POST['lastName'],
    'gender' => $gender,
    'phoneNumber' => $_POST['phoneNumber'],
    'email' => $_POST['email'],
    'password' => $password
    ];

    $member = new \Trainingskalender\models\Member($member);

    $member->save($errors);
 }

 function requiredCheck(&$errors)
{
    //country, year, month and day can not be unset
    if (isset($_POST['firstName']) === false || $_POST['firstName'] === 'Vorname'|| $_POST['firstName'] === '') {
        array_push($errors, "Bitte tragen Sie Ihren Vornamen ein");
    }
    if (!isset($_POST['lastName'])|| $_POST['lastName'] === 'Nachname'|| $_POST['lastName'] === '') {
        array_push($errors, "Bitte tragen Sie Ihren Nachnamen ein");
    }
    if (!isset($_POST['genderRadio'])) {
        array_push($errors, "Bitte geben Sie Ihr Geschlecht an");
    }
    if (!isset($_POST['email']) || $_POST['email'] === 'E-Mail'|| $_POST['email'] === '') {
        array_push($errors, "Bitte tragen Sie Ihre E-Mail Adresse ein");
    }

    if (!isset($_POST['password'])|| $_POST['password'] === 'Passwort'|| $_POST['password'] === '') {
        array_push($errors, "Bitte wälen Sie ein Passwort");
    }

}

function requiredCheckEditPersonalData(&$errors)
{
    //country, year, month and day can not be unset
    if (isset($_POST['firstName']) === false || $_POST['firstName'] === 'Vorname'|| $_POST['firstName'] === '') {
        array_push($errors, "Bitte tragen Sie Ihren Vornamen ein");
    }
    if (!isset($_POST['lastName'])|| $_POST['lastName'] === 'Nachname'|| $_POST['lastName'] === '') {
        array_push($errors, "Bitte tragen Sie Ihren Nachnamen ein");
    }

    if (!isset($_POST['email']) || $_POST['email'] === 'E-Mail'|| $_POST['email'] === '') {
        array_push($errors, "Bitte tragen Sie Ihre E-Mail Adresse ein");
    }

}


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


/* 


if the checkbox stay logged in is set, 
then the user id should be saved in a cookie
so that the user remains logged in after the browser is closed. 
If the checkbox is not set, the user id should be saved in the session
*/
function setIdForCookieOrSession($member){

    if(isset($_POST['stayLoggedIn'])){
        stayLoggedIn($member);
    }
    else{
        $_SESSION['id'] = $member[0]['id'];
    }

}
/*
if the checkbox stay logged in is set, 
then the user id should be saved in a cookie
so that the user remains logged in after the browser is closed.
*/
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

function getMemberId(){
    
    if(isset($_SESSION['id'])){
        return $_SESSION['id'];
    }
    else if(isset($_COOKIE['id'])){
        return $_COOKIE['id'];
    }else{
        return false;
    }

}


function isEntryUnique(){
    $memberId = getMemberId();

    $entries = null;

    $test = true;
    // for training type: "Training" 
    // @ chooseTimeAndRoomTraining
    if(isset($_POST['trainingTime'])){  
    $view =  \Trainingskalender\models\ViewAreaTimeslot
    ::find('startTime =\''.$_POST['trainingTime'].'\'');
    
        foreach ($view as $value){
        $entries = \Trainingskalender\models\TrainingEntry
                    ::find('trainingDate = \''.$_POST['trainingDate'].'\' and memberId = \''.$memberId.'\' and areaTimeslotId  = \''.$value['id'].'\'');

            if(count($entries) !== 0){
                $test = false;
            }
            return $test;
        }
      
    // for training type: "Kurs"
    // @ chooseTimeAndRoomTraining
    } else if(isset($_POST['viewAreaTimeslotId'])){

    $entries = \Trainingskalender\models\TrainingEntry
        ::find('trainingDate = \''.$_POST['trainingDate'].'\' and memberId = \''.$memberId.'\' and areaTimeslotId  = \''.$_POST['viewAreaTimeslotId'].'\'');
    }


    if(count($entries) !== 0){
        $test = false;
    }

    return $test;
}

function requiredCheckTrainingType(&$errors){
    if (!isset($_GET['typeOfTraining'])) {
        array_push($errors, "Bitte wählen Sie einen Trainingstyp");
    }
}



function getTrainingEntrysByCardioTime($viewAreaTimeslot, $cardioStartTime, $cardioEndTime){
   // $join, $where, $orderBy, $groupByAndHaving, $limitAndOffset=null
   $trainings = \Trainingskalender\models\TrainingEntry
        ::find('trainingDate = \''.$_POST['trainingDate'].'\' and cardioStartTime = \''.$cardioStartTime.'\' and cardioEndTime = \''.$cardioEndTime.'\'');
   return $trainings;
}

// set cardioStartTime and cardioEndTime for a trainingEntry 
// you can see timeDiffs @init.php
// returns true if places are available
// returns false if no places are available
function setCardioTimes($viewAreaTimeslot, &$cardioStartTime, &$cardioEndTime, &$errors){
    
    $area = \Trainingskalender\models\Area
    ::find('labelling = \'Cardio\'');

    $diffTrainingStartCardio = unserialize (diffTrainingStartCardio);

    foreach ($diffTrainingStartCardio as $value){

        setTimeDiffBeforeTraining($value,durationCardio,$viewAreaTimeslot['startTime'] , $cardioStartTime,  $cardioEndTime );
        $trainingEntrysByCardioTime = getTrainingEntrysByCardioTime($viewAreaTimeslot, $cardioStartTime, $cardioEndTime);
    
        if(arePlacesAvailable($area[0]['maxNumberOfPeople'],$viewAreaTimeslot, $cardioStartTime, $cardioEndTime, $trainingEntrysByCardioTime)){
            return true;
        }

    }

    array_push($errors, "Keine Kardiozeit verfügbar");
    
    return false;

}

/**
 * sets start end end time for a timeslot before training
 */
function setTimeDiffBeforeTraining($timediffStartTimeAndTrainingStart,$duration,$trainingStartTime, &$startTime, &$endTime ){
    $startTime = new DateTime($trainingStartTime);
    $startTime->sub(new DateInterval('PT' . $timediffStartTimeAndTrainingStart . 'M'));
    

    $endTime = new DateTime($startTime->format('H:i:s'));
    $endTime->add(new DateInterval('PT' . $duration . 'M'));
   

    $startTime = $startTime->format('H:i:s');
    $endTime = $endTime->format('H:i:s');
}

// set changingRoomBeforeStartTime and changingRoomBeforeEndTime for a trainingEntry 
// you can see timeDiffs @init.php
// returns true if places are available
// returns false if no places are available
function setChangingRoomBeforeTimes($viewAreaTimeslot,$member, &$changingRoomStartTime, &$changingRoomEndTime, &$changingRoom, &$errors){
    $freePlaces= false;
    $diffTrainingStartChangingBeforeTraining = unserialize (diffTrainingStartChangingBeforeTraining);
    
    if(strpos($viewAreaTimeslot['labelling'], '1') !== false ){
        $changingRoom = \Trainingskalender\models\Area
        ::find('labelling = \'Umkleide 1, '.$member['gender'].'\'');
        
        $freePlaces = setTimesChangingRoomBeforeByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $changingRoom[0], $changingRoomStartTime, $changingRoomEndTime);
        if($freePlaces){
            return true;
        }
        
        $changingRoom = \Trainingskalender\models\Area
        ::find('labelling = \'Umkleide 2, '.$member['gender'].'\'');

        $freePlaces = setTimesChangingRoomBeforeByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $changingRoom[0], $changingRoomStartTime, $changingRoomEndTime);
        if($freePlaces){
            return true;
        }
        array_push($errors, "Kein Umkleideplatz verfügbar");
        
        return false;
    }
    elseif(strpos($viewAreaTimeslot['labelling'], '2') !== false ){
        
        $changingRoom = \Trainingskalender\models\Area
        ::find('labelling = \'Umkleide 2, '.$member['gender'].'\'');
        
        $freePlaces = setTimesChangingRoomBeforeByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $changingRoom[0], $changingRoomStartTime, $changingRoomEndTime);

        if($freePlaces){
            return true;
        }

        $changingRoom = \Trainingskalender\models\Area
        ::find('labelling = \'Umkleide 1, '.$member['gender'].'\'');
        
        $freePlaces = setTimesChangingRoomBeforeByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $changingRoom[0], $changingRoomStartTime, $changingRoomEndTime);

        if($freePlaces){
            return true;
        }
        array_push($errors, "Kein Umkleideplatz verfügbar");
        return false;

    }
    else{
        array_push($errors, "Kein Trainingsplatz verfügbar");
        return false;
    }
    
}

function arePlacesAvailable($area,$viewAreaTimeslot, $startTime, $endTime, $trainingEntrys){
    
        if(count($trainingEntrys) < $area){
            return true;
        }
        else{
            return false;
        }
}



function getTrainingEntrysBychangingRoom($viewAreaTimeslot, $changingRoomArea, $changingRoomBeforeStartTime, $changingRoomBeforeEndTime){
    $entries = \Trainingskalender\models\TrainingEntry
         ::find('trainingDate = \''.$_POST['trainingDate'].'\' and 	changingRoomBeforeStartTime = \''.$changingRoomBeforeStartTime.'\' and changingRoomBeforeEndTime = \''.$changingRoomBeforeEndTime.'\' and changingRoom = \''.$changingRoomArea.'\'');
         return $entries;
 }

/**
 * 
 *set ChangingRoomBeforeStartTime and ChangingRoomBeforeEndTime to
 *and checks if a place for the area is available
 */
function setTimesChangingRoomBeforeByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $area, &$changingRoomStartTime, &$changingRoomEndTime){
    foreach ($diffTrainingStartChangingBeforeTraining as $value){

        setTimeDiffBeforeTraining($value,durationChangingBefore,$viewAreaTimeslot['startTime'] , $changingRoomStartTime,  $changingRoomEndTime );
        
        $trainingEntrysByChangingRoom = getTrainingEntrysBychangingRoom($viewAreaTimeslot, $area['labelling'], $changingRoomStartTime, $changingRoomEndTime);
        
      if( arePlacesAvailable($area['maxNumberOfPeople'],$viewAreaTimeslot, $changingRoomStartTime, $changingRoomEndTime, $trainingEntrysByChangingRoom)){
          return true;
      }
    
    }
    return false;
 }

// set changingRoomAfterStartTime and changingRoomAfterEndTime for a trainingEntry 
// you can see timeDiffs @init.php
// returns true if places are available
// returns false if no places are available
 function setChangingRoomAfterTimes($viewAreaTimeslot,$member, &$changingRoomStartTime, &$changingRoomEndTime, $changingRoom, &$errors){

    $freePlaces= false;
    $diffTrainingStartChangingBeforeTraining = unserialize (diffTrainingStartChangingAfterTraining);
 
    if($changingRoom[0]['labelling']==='Umkleide 1, '.$member['gender'] ){
        
        $freePlaces = setTimesChangingRoomAfterByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $changingRoom[0], $changingRoomStartTime, $changingRoomEndTime);

        return $freePlaces;
    }
    elseif($changingRoom[0]['labelling']==='Umkleide 2, '.$member['gender'] ){
             
        $freePlaces = setTimesChangingRoomAfterByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $changingRoom[0], $changingRoomStartTime, $changingRoomEndTime);

        if($freePlaces){
            return true;
        }
        array_push($errors, "Kein Umkleideplatz verfügbar"); 
        return $freePlaces;

    }
    else{
        array_push($errors, "Kein Umkleideplatz verfügbar");
        return false;
    }
    
}

/**
 * 
 *set ChangingRoomAfterStartTime and ChangingRoomAfterEndTime to
 *and checks if a place for the area is available
 */
function setTimesChangingRoomAfterByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $area, &$changingRoomStartTime, &$changingRoomEndTime){
    foreach ($diffTrainingStartChangingBeforeTraining as $value){

        setTimeDiffAfterTraining($value,durationChangingBefore,$viewAreaTimeslot['endTime'] , $changingRoomStartTime,  $changingRoomEndTime );
        
        $trainingEntrysByChangingRoom = getTrainingEntrysByChangingRoomAfter($viewAreaTimeslot, $area['labelling'], $changingRoomStartTime, $changingRoomEndTime);

        if(arePlacesAvailable($area['maxNumberOfPeople'],$viewAreaTimeslot, $changingRoomStartTime, $changingRoomEndTime, $trainingEntrysByChangingRoom)){
            return true;
        }
    }
    return false;
    array_push($errors, "Kein Umkleideplatz verfügbar");
}


/**
 * sets start end end time for a timeslot after training
 */
 function setTimeDiffAfterTraining($timediffStartTimeAndTrainingStart,$duration,$trainingEndTime, &$startTime, &$endTime ){
    $startTime = new DateTime($trainingEndTime);
    $startTime->add(new DateInterval('PT' . $timediffStartTimeAndTrainingStart . 'M'));
    

    $endTime = new DateTime($startTime->format('H:i:s'));
    $endTime->add(new DateInterval('PT' . $duration . 'M'));
   

    $startTime = $startTime->format('H:i:s');
    $endTime = $endTime->format('H:i:s');
}

function trainingEntry( &$errors){
   
    // for edit trainingEntry
    if(isset($_SESSION['entryId'])){
        $trainingEntry = [
            'id' => $_SESSION['entryId'],
            'trainingDate' => $_POST['trainingDate'],
            'typeOfTraining' => $_POST['typeOfTraining'],
            'changingRoom' => $_POST['changingRoom'],
            'changingRoomBeforeStartTime' => $_POST['changingRoomBeforeStartTime'],
            'changingRoomBeforeEndTime' => $_POST['changingRoomBeforeEndTime'],
            'changingRoomAfterStartTime' => $_POST['changingRoomAfterStartTime'],
            'changingRoomAfterEndTime' => $_POST['changingRoomAfterEndTime'],
            'cardioStartTime' => $_POST['cardioStartTime'],
            'cardioEndTime' => $_POST['cardioEndTime'],
            'memberId' => $_POST['memberId'],
            'areaTimeslotId' => $_POST['areaTimeslotId']
            ];
    }else{

    //for new trainingEntry
    $trainingEntry = [
        'trainingDate' => $_POST['trainingDate'],
        'typeOfTraining' => $_POST['typeOfTraining'],
        'changingRoom' => $_POST['changingRoom'],
        'changingRoomBeforeStartTime' => $_POST['changingRoomBeforeStartTime'],
        'changingRoomBeforeEndTime' => $_POST['changingRoomBeforeEndTime'],
        'changingRoomAfterStartTime' => $_POST['changingRoomAfterStartTime'],
        'changingRoomAfterEndTime' => $_POST['changingRoomAfterEndTime'],
        'cardioStartTime' => $_POST['cardioStartTime'],
        'cardioEndTime' => $_POST['cardioEndTime'],
        'memberId' => $_POST['memberId'],
        'areaTimeslotId' => $_POST['areaTimeslotId']
        ];
    }
    
        $trainingEntry = new \Trainingskalender\models\TrainingEntry($trainingEntry);
    

        $trainingEntry->save($errors);

        // deletes the entry if an area is overcrowded
        if(areTooMuchEntries()){
            $trainingEntry->delete($errors);
            array_push($errors, "leider ist der Zeitslot belegt");
            return false;
        }
        else{
            return true;
        }
}

function subOneMonth(){

    $date = new DateTime('now');
    $date->modify('-1 month');

    return $date->format('Y-m-d');
}

function getTrainingDateClass($date){
    return new DateTime($date);
}

function getTrainingEntrysByChangingRoomAfter($viewAreaTimeslot, $changingRoomArea, $changingRoomBeforeStartTime, $changingRoomBeforeEndTime){
    // $join, $where, $orderBy, $groupByAndHaving, $limitAndOffset=null
    $entries = \Trainingskalender\models\TrainingEntry
         ::find('trainingDate = \''.$_POST['trainingDate'].'\' and 	changingRoomAfterStartTime = \''.$changingRoomBeforeStartTime.'\' and changingRoomAfterEndTime = \''.$changingRoomBeforeEndTime.'\' and changingRoom = \''.$changingRoomArea.'\'');
         return $entries;
 }

 function deleteEntry(&$errors, $entry){
    $trainingEntry = [
        'id' => $entry['id'],
        'trainingDate' => $entry['trainingDate'],
        'typeOfTraining' => $entry['typeOfTraining'],
        'changingRoom' => $entry['changingRoom'],
        'changingRoomBeforeStartTime' => $entry['changingRoomBeforeStartTime'],
        'changingRoomBeforeEndTime' => $entry['changingRoomBeforeEndTime'],
        'changingRoomAfterStartTime' => $entry['changingRoomAfterStartTime'],
        'changingRoomAfterEndTime' => $entry['changingRoomAfterEndTime'],
        'cardioStartTime' => $entry['cardioStartTime'],
        'cardioEndTime' => $entry['cardioEndTime'],
        'memberId' => $entry['memberId'],
        'areaTimeslotId' => $entry['areaTimeslotId']
        ];

    
        $trainingEntry = new \Trainingskalender\models\TrainingEntry($trainingEntry);
    

        $trainingEntry->delete($errors);

 }

 // sets the date format from "yyyy-mm-dd" to "dd.mm.yyyy"
// sets the format to "hh:mm Uhr" if $uhr ==true 
 function dateInRightOrder($_date){
    if (!empty($_date)) {

        $date = explode("-", $_date);
        $newDate = $date[2] . '.' . $date[1] . '.' . $date[0];
        return $newDate;
    } else {
        return '';
    }
}

// sets the time format from "hh:mm:ss" to "hh:mm"
// sets the format to "hh:mm Uhr" if $uhr ==true 
function timeInRightOrder($_time, $Uhr=false){
    if (!empty($_time)) {

        $time = explode(":", $_time);
        if($Uhr){

            $newTime = $time[0] . ':' . $time[1].' Uhr';
        }else{
            $newTime = $time[0] . ':' . $time[1];
        }
        return $newTime;
    } else {
        return '';
    }
}


function areTooMuchEntries(){
    $countChangingRoomBefore =  \Trainingskalender\models\TrainingEntry
        ::find('changingRoomBeforeStartTime =\''.$_POST['changingRoomBeforeStartTime'].'\' and changingRoom = \''.$_POST['changingRoom'].'\' and trainingDate = \''.$_POST['trainingDate'].'\'');

        $countChangingRoomAfter =  \Trainingskalender\models\TrainingEntry
        ::find('changingRoomAfterStartTime =\''.$_POST['changingRoomAfterStartTime'].'\' and changingRoom = \''.$_POST['changingRoom'].'\' and trainingDate = \''.$_POST['trainingDate'].'\'');

        $countCardio =  \Trainingskalender\models\TrainingEntry
        ::find('cardioStartTime =\''.$_POST['cardioStartTime'].'\'  and trainingDate = \''.$_POST['trainingDate'].'\'');

        $countTrainingTime =  \Trainingskalender\models\TrainingEntry
        ::find('areaTimeslotId =\''.$_POST['areaTimeslotId'].'\'  and trainingDate = \''.$_POST['trainingDate'].'\'');


        $maxChangingRoom =  \Trainingskalender\models\Area
        ::find('labelling =\''.$_POST['changingRoom'].'\'');
        $areaTimeslot =  \Trainingskalender\models\AreaTimeslot
        ::find('id =\''.$_POST['areaTimeslotId'].'\'');
        $maxTrainingRoom =  \Trainingskalender\models\Area
        ::find('id =\''.$areaTimeslot[0]['areaId'].'\'');
        $maxCardio =  \Trainingskalender\models\Area
        ::find('labelling =\'Cardio\'');

        if(count($countCardio)<=$maxCardio[0]['maxNumberOfPeople'] && count($countChangingRoomBefore)<=$maxChangingRoom[0]['maxNumberOfPeople']
        && count($countChangingRoomAfter)<=$maxChangingRoom[0]['maxNumberOfPeople'] 
        && count($countTrainingTime)<=$maxTrainingRoom[0]['maxNumberOfPeople']){
            return false;
        }
        else{

            return true;  
        } 
}

