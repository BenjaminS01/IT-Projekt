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

function isValidRegister(&$errors){

   requiredCheck($errors);
   $arePwTheSame  = arePwdAndPwdCheckTheSame($errors);
   $isEmailUnique = isEmailUnique($errors);
   $isPasswordValid = isPasswordValid($errors);

   if($arePwTheSame && $isEmailUnique && $isPasswordValid && count($errors)==0){
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

 
    if($isEmailUnique){
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
    $password = password_hash($password, PASSWORD_DEFAULT);

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
    if (!isset($_POST['phoneNumber']) || $_POST['phoneNumber'] === 'Telefonnummer'|| $_POST['phoneNumber'] === '') {
        array_push($errors, "Bitte tragen Sie Ihre E-Mail Adresse ein");
    }
    if (!isset($_POST['password'])|| $_POST['password'] === 'Passwort'|| $_POST['password'] === '') {
        array_push($errors, "Bitte wälen Sie ein Passwort");
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

    if(isset($_POST['stayLoggedIn'])){
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

function getMemberId(){
    
    if(isset($_SESSION['id'])){
        return $_SESSION['id'];
    }
    else if(isset($_COOKIE['id'])){
        return $_COOKIE['id'];
    }

}


function draw_calendar($month,$year,$events){

    /* draw table */
    
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
    endfor;
    
    $_month = 'a';
    if($month < 10){
        $_month = '0'. $month;
    }
    else{
        $_month = $month;
    }

	/* keep going with days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
        
		$calendar.= '<td class="calendar-day"><div style="position:relative;height:100px;width:200px;">';
			/* add in the day number */
            
            $calendar.= '<div class="day-number">'.$list_day.'</div>';
            
            $day = '';
    
			if($list_day < 10){
                $day = '0'. $list_day;
            }
            else{
                $day = $list_day;
            }

            $event_day = $year.'-'.$_month.'-'.$day;
            
            $calendar.= '<a href="?a=chooseTypeOfTraining&trainingDate='.$event_day.'" >test</a>';
            

			if(isset($events[$event_day])) {
				//foreach($events[$event_day] as $event) {
                    $calendar.= '<a href="?a=chooseTypeOfTraining&trainingDate='.$events[$event_day]['trainingDate'].'" >Dein Trainingseintrag</a>';
					//$calendar.= '<div class="event">'.$events[$event_day]['trainingDate'].'</div>';/////////////
               // }
			}
			else {
				$calendar.= str_repeat('<p>&nbsp;</p>',2);
            }
           // $calendar.= $_month;
           // $calendar.= $day;
           // $calendar.= $event_day; 
           // $calendar.= $events['2020-08-28']['trainingDate'];
      
		$calendar.= '</div></td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';
	

	/* end the table */
	$calendar.= '</table>';

	/** DEBUG **/
	$calendar = str_replace('</td>','</td>'."\n",$calendar);
	$calendar = str_replace('</tr>','</tr>'."\n",$calendar);
	
	/* all done, return result */
	return $calendar;
}

function random_number() {
	srand(time());
	return (rand() % 7);
}



/////////////***********KALENDER EINTRAGEN */////////////
// ' te join Member m on m.id = te.memberId'

function getTrainingEntrysByCardioTime($viewAreaTimeslot, $cardioStartTime, $cardioEndTime){
   // $join, $where, $orderBy, $groupByAndHaving, $limitAndOffset=null
   $trainings = \Trainingskalender\models\TrainingEntry
        ::find('trainingDate = \''.$_POST['trainingDate'].'\' and cardioStartTime = \''.$cardioStartTime.'\' and cardioEndTime = \''.$cardioEndTime.'\'');
   return $trainings;
}

function setCardioTimes($viewAreaTimeslot, &$cardioStartTime, &$cardioEndTime, &$errors){
    
    $area = \Trainingskalender\models\Area
    ::find('labelling = \'Cardio\'');

    $diffTrainingStartCardio = unserialize (diffTrainingStartCardio);

    foreach ($diffTrainingStartCardio as $value){

        getTimeDiffBeforeTraining($value,durationCardio,$viewAreaTimeslot['startTime'] , $cardioStartTime,  $cardioEndTime );
        $trainingEntrysByCardioTime = getTrainingEntrysByCardioTime($viewAreaTimeslot, $cardioStartTime, $cardioEndTime);
    
        if(arePlacesAvailable($area[0]['maxNumberOfPeople'],$viewAreaTimeslot, $cardioStartTime, $cardioEndTime, $trainingEntrysByCardioTime)){
            return true;
        }

    }

    array_push($errors, "Keine Kardiozeit verfügbar");
    
    return false;

/*
    getTimeDiffBeforeTraining(20,10,$viewAreaTimeslot['startTime'] , $cardioStartTime,  $cardioEndTime );
    $trainingEntrysByCardioTime = getTrainingEntrysByCardioTime($viewAreaTimeslot, $cardioStartTime, $cardioEndTime);

    if(arePlacesAvailable($area,$viewAreaTimeslot, $cardioStartTime, $cardioEndTime, $trainingEntrysByCardioTime)){
        return true;
    }
    else{
 
      getTimeDiffBeforeTraining(20,10,$viewAreaTimeslot['startTime'] , $cardioStartTime,  $cardioEndTime );
      $trainingEntrysByCardioTime = getTrainingEntrysByCardioTime($viewAreaTimeslot, $cardioStartTime, $cardioEndTime);
    }

    if(arePlacesAvailable($area,$viewAreaTimeslot, $cardioStartTime, $cardioEndTime, $trainingEntrysByCardioTime)){
        return true;
    }
    else{
        array_push($errors, "Kein Zeitslot für Kardiogeräte verfügbar");
        return false;
    }
    */
   // return $cardioStartTime->format('%H:%I:%S');
}

function getTrainingEntrysByChangingRoomTimeBefore($viewAreaTimeslot, $cardioStartTime, $cardioEndTime){

}

function getTrainingEntrysByChangingRoomTimeAfter($viewAreaTimeslot, $cardioStartTime, $cardioEndTime){

}

function getTimeDiffBeforeTraining($timediffStartTimeAndTrainingStart,$duration,$trainingStartTime, &$startTime, &$endTime ){
    $startTime = new DateTime($trainingStartTime);
    $startTime->sub(new DateInterval('PT' . $timediffStartTimeAndTrainingStart . 'M'));
    

    $endTime = new DateTime($startTime->format('H:i:s'));
    $endTime->add(new DateInterval('PT' . $duration . 'M'));
   

    $startTime = $startTime->format('H:i:s');
    $endTime = $endTime->format('H:i:s');
}

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
    // $join, $where, $orderBy, $groupByAndHaving, $limitAndOffset=null
    $entries = \Trainingskalender\models\TrainingEntry
         ::find('trainingDate = \''.$_POST['trainingDate'].'\' and 	changingRoomBeforeStartTime = \''.$changingRoomBeforeStartTime.'\' and changingRoomBeforeEndTime = \''.$changingRoomBeforeEndTime.'\' and changingRoom = \''.$changingRoomArea.'\'');
         return $entries;
 }


function setTimesChangingRoomBeforeByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $area, &$changingRoomStartTime, &$changingRoomEndTime){
    foreach ($diffTrainingStartChangingBeforeTraining as $value){

        getTimeDiffBeforeTraining($value,durationChangingBefore,$viewAreaTimeslot['startTime'] , $changingRoomStartTime,  $changingRoomEndTime );
        
        $trainingEntrysByChangingRoom = getTrainingEntrysBychangingRoom($viewAreaTimeslot, $area['labelling'], $changingRoomStartTime, $changingRoomEndTime);
        
      if( arePlacesAvailable($area['maxNumberOfPeople'],$viewAreaTimeslot, $changingRoomStartTime, $changingRoomEndTime, $trainingEntrysByChangingRoom)){
          return true;
      }
    
    }
    return false;
 }

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


function setTimesChangingRoomAfterByArea($diffTrainingStartChangingBeforeTraining, $viewAreaTimeslot, $area, &$changingRoomStartTime, &$changingRoomEndTime){
    foreach ($diffTrainingStartChangingBeforeTraining as $value){

        getTimeDiffAfterTraining($value,durationChangingBefore,$viewAreaTimeslot['endTime'] , $changingRoomStartTime,  $changingRoomEndTime );
        
        $trainingEntrysByChangingRoom = getTrainingEntrysByChangingRoomAfter($viewAreaTimeslot, $area['labelling'], $changingRoomStartTime, $changingRoomEndTime);

        if(arePlacesAvailable($area['maxNumberOfPeople'],$viewAreaTimeslot, $changingRoomStartTime, $changingRoomEndTime, $trainingEntrysByChangingRoom)){
            return true;
        }
    }
    return false;
    array_push($errors, "Kein Umkleideplatz verfügbar");
}

 function getTimeDiffAfterTraining($timediffStartTimeAndTrainingStart,$duration,$trainingEndTime, &$startTime, &$endTime ){
    $startTime = new DateTime($trainingEndTime);
    $startTime->add(new DateInterval('PT' . $timediffStartTimeAndTrainingStart . 'M'));
    

    $endTime = new DateTime($startTime->format('H:i:s'));
    $endTime->add(new DateInterval('PT' . $duration . 'M'));
   

    $startTime = $startTime->format('H:i:s');
    $endTime = $endTime->format('H:i:s');
}

function trainingEntry( &$errors){
   
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

    
        $trainingEntry = new \Trainingskalender\models\TrainingEntry($trainingEntry);
    

        $trainingEntry->save($errors);

        
}

function subOneMonth(){

    $date = new DateTime('now');
    $date->modify('-1 month');

    return $date->format('Y-m-d');
}

function getTrainingDateClass(){
    return new DateTime($_GET['trainingDate']);
}

function getTrainingEntrysByChangingRoomAfter($viewAreaTimeslot, $changingRoomArea, $changingRoomBeforeStartTime, $changingRoomBeforeEndTime){
    // $join, $where, $orderBy, $groupByAndHaving, $limitAndOffset=null
    $entries = \Trainingskalender\models\TrainingEntry
         ::find('trainingDate = \''.$_POST['trainingDate'].'\' and 	changingRoomAfterStartTime = \''.$changingRoomBeforeStartTime.'\' and changingRoomAfterEndTime = \''.$changingRoomBeforeEndTime.'\' and changingRoom = \''.$changingRoomArea.'\'');
         return $entries;
 }

 function deleteEntry(&$errors, $entry, $view){
    $trainingEntry = [
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