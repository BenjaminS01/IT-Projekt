<?php

namespace Trainingskalender\controller;

class PagesController extends \Trainingskalender\core\Controller
{
 

    public function actionStart(){


        $errors = [];
       if(isset($_GET['param'])) {

            if ($_GET['param']=='logout') {
                logout();
            }
            
        }

        if (isset($_POST['submitTrainingEntry'])){
            
           $test = trainingEntry($errors);
           if(!$test){
            header('Location: index.php?c=pages&a=kalender&f='.implode(", ", $errors));
           }
           else if(!empty($errors)){
            
                header('Location: index.php?c=pages&a=chooseTimeAndRoom&typeOfTraining='.$_GET['typeOfTraining'].'&trainingDate='.$_GET['trainingDate'].'&f='.implode(", ", $errors));
            }else if(isset($_SESSION['entryId'])){
                $_SESSION['entryId'] = null;
                $this->_params['message'] = 'Ihr eintrag wurde erfolgreich geändert. Wir wünschen Ihnen ein erfolgreiches Training';
            }else{
                $_SESSION['entryId'] = null;
                $this->_params['message'] = 'Ihr eintrag wurde vom System erfasst. Wir wünschen Ihnen ein erfolgreiches Training';
            }
        }

    }

    public function actionLogin(){

        $errors = [];

        if(isset($_POST['submitLogin'])){
            
            login($errors);

            if(count($errors) === 0){
                header('Location: index.php?c=pages&a=start');
            }

            $this->_params['error'] = $errors;
        }
        
    }

    public function actionRegister(){
       
        $errors = [];

        if(isset($_POST['submitRegister'])){

            if(isValidRegister($errors)){
                register($errors);
                login($errors);
            }
    
            if(count($errors) === 0){

                header('Location: index.php?c=pages&a=start');
            }
          
            $this->_params['error'] = $errors;
           
        }

    }

    public function actionAccount(){

        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }

        $memberId = getMemberId();

        $this->_params['member'] = \Trainingskalender\models\Member::find('id= ' . '\'' . $memberId . '\'');
    }

    public function actionEditPersonalData(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }

        $errors = [];
        $memberId = getMemberId();

        $this->_params['member'] = \Trainingskalender\models\Member::find('id= ' . '\'' . $memberId . '\'');

        if(isset($_POST['submitEdit'])){
            $id = $this->_params['member'][0]['id'];
            $gender =  $this->_params['member'][0]['gender'];
            $password = $this->_params['member'][0]['password'];
            if(isValidPersonalData($errors, $this->_params['member'])){
                editPersonalData($errors, $id, $gender, $password);
            }
    
            if(count($errors) === 0){
                header('Location: index.php?c=pages&a=account');
            }
          
            $this->_params['error'] = $errors;
        }
    }
    public function actionEditPassword(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }

        $errors = [];
        $memberId = getMemberId();

        $this->_params['member'] = \Trainingskalender\models\Member::find('id= ' . '\'' . $memberId . '\'');
        if(isset($_POST['submitEdit'])){
            $id = $this->_params['member'][0]['id'];
            $firstName = $this->_params['member'][0]['firstName'];
            $lastName = $this->_params['member'][0]['lastName'];
            $gender = $this->_params['member'][0]['gender'];
            $phoneNumber = $this->_params['member'][0]['phoneNumber']; 
            $email = $this->_params['member'][0]['email'];

            if(isValidPassword($errors,$this->_params['member'] )){
                editPassword($errors,$id,$firstName,$lastName,$gender,$phoneNumber,$email);
            }
    
            if(count($errors) === 0){
                header('Location: index.php?c=pages&a=account');
            }
          
            $this->_params['error'] = $errors;
        }
    }

    public function actionKalender(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }
        $errors = [];

        if(isset($_GET['f'])){
          
            array_push( $errors, $_GET['f']);
            $this->_params['error'] = $errors; 
        }

        $db = $GLOBALS['db'];
        $memberId = getMemberId();
        $_SESSION['trainingDate'] = null;

        $nxtm = strtotime("next month");
        $this->_params['month'] = date("n", $nxtm);

        if(!isset($_GET['nextMonth'])){
       
        $query1 = $db->prepare('SELECT DISTINCT trainingDate FROM trainingEntry WHERE memberId =\'' . $memberId . '\' and year(curdate()) = year(trainingDate)
        and month(curdate()) = month(TrainingDate)');
        $query1->execute();
        $this->_params['trainingEntry'] = $query1->fetchall();
        }else if(isset($_GET['nextMonth']) && $this->_params['month'] < 12 ){
            $query1 = $db->prepare('SELECT DISTINCT trainingDate FROM trainingEntry WHERE memberId =\'' . $memberId . '\' and year(curdate()) = year(trainingDate)
        and month(DATE_ADD(curdate(), INTERVAL 1 MONTH)) = month(TrainingDate)');
        $query1->execute();
        $this->_params['trainingEntry'] = $query1->fetchall();
        }else {
            $query1 = $db->prepare('SELECT DISTINCT trainingDate FROM trainingEntry WHERE memberId =\'' . $memberId . '\' and year(DATE_ADD(curdate(), INTERVAL 1 YEAR)) = year(trainingDate)
        and month(DATE_ADD(curdate(), INTERVAL 1 MONTH)) = month(TrainingDate)');
        $query1->execute();
        $this->_params['trainingEntry'] = $query1->fetchall();
        }
/*
       $this->_params['trainingEntry'] = \Trainingskalender\models\TrainingEntry::find('memberId= ' . '\'' . $memberId . '\' and year(curdate()) = year(trainingDate)
       and month(curdate()) = month(TrainingDate)');
*/
      
     
   
        


        
        
        /////test
        	foreach ($this->_params['trainingEntry'] as $key => $value){
                $this->_params['events'][$this->_params['trainingEntry'][$key]['trainingDate']] = $this->_params['trainingEntry'][$key];
            }
        

    }

    public function actionChooseTypeOfTraining(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }
        if(isset($_GET['type'])){
            $_SESSION['entryId'] = null;

        }
        

        if(isset($_GET['trainingDate'])){

            $this->_params['date'] = getTrainingDateClass($_GET['trainingDate']);
            $this->_params['trainingDate'] = $_GET['trainingDate'];
        }
        else if(isset($_POST['id'])){
            $this->_params['date'] = getTrainingDateClass($_POST['trainingDate']);
            $this->_params['trainingDate'] = $_POST['trainingDate'];
            $_SESSION['entryId'] = $_POST['id'];
 
        }

  
    }

    public function actionChooseTimeAndRoom(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }
       
        $this->_params['error'] = [];
        if(isset($_GET['f'])){
            array_push($this->_params['error'], $_GET['f']);
            //$this->_params['error'] = $_GET['f'];
        }

        if(!isset($_GET['typeOfTraining'])){
            header('Location: index.php?c=pages&a=chooseTypeOfTraining&trainingDate='.$_GET['trainingDate'].'&noType=true');
        }


        if(isset($_GET['typeOfTraining']) && $_GET['typeOfTraining']==='Training'){

        $this->_params['area'] =  \Trainingskalender\models\Area
        ::find('labelling like \'%'.$_GET['typeOfTraining'] . '%\'');

        $this->_params['viewAreaTimeslot'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('labelling =\''.$this->_params['area'][0]['labelling'].'\'');
        }

        else if(isset($_GET['typeOfTraining']) && $_GET['typeOfTraining']==='Kurs'){

        $date = $_GET['trainingDate'];
 
        //Get the day of the week using PHP's date function.
        $dayOfWeek = date("N", strtotime($date));

       // $this->_params['viewAreaTimeslot'] =  \Trainingskalender\models\ViewAreaTimeslot
        // ::find('weekday =\''.$dayOfWeek.'\'');

        

        $this->_params['viewAreaTimeslot'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('weekday =\''.$dayOfWeek.'\'',' order by startTime');
        }

    }

    public function actionConfirmTrainingTimes(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }
        $errors = [];

        if(isset($_POST['trainingTime'])){

        $this->_params['viewAreaTimeslot'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('startTime =\''.$_POST['trainingTime'].'\' and labelling = \''.$_POST['trainingArea'].'\'');
        $this->_params['trainingArea'] = $_POST['trainingArea'];
        }else{
        $this->_params['viewAreaTimeslot'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('id =\''.$_POST['viewAreaTimeslotId'].'\'');

        $this->_params['trainingArea'] = $this->_params['viewAreaTimeslot'][0]['labelling'];
        }
        
        $this->_params['cardioStartTime'] = '';
        $this->_params['cardioEndTime'] = '';
        

        $test = isEntryUnique();

        if($test===false){
            header('Location: index.php?c=pages&a=chooseTimeAndRoom&typeOfTraining='.$_POST['typeOfTraining'].'&trainingDate='.$_POST['trainingDate'].'&f=Ihr eintrag existiert bereits');
        }
    
    
        $test = setCardioTimes($this->_params['viewAreaTimeslot'][0], $this->_params['cardioStartTime'], $this->_params['cardioEndTime'], $errors );

        if($test===false){
            header('Location: index.php?c=pages&a=chooseTimeAndRoom&typeOfTraining='.$_POST['typeOfTraining'].'&trainingDate='.$_POST['trainingDate'].'&f=Kein Cardioplatz verfügbar');
        }

        $this->_params['memberId'] = getMemberId();

        $member = \Trainingskalender\models\Member
        ::find('id = \''.$this->_params['memberId'].'\'');

        $this->_params['changingRoomBeforeStartTime'] = '';
        $this->_params['changingRoomBeforeEndTime'] = '';
        $this->_params['changingRoomAfterStartTime'] = '';
        $this->_params['changingRoomAfterEndTime'] = '';
        $this->_params['changingRoom'] = null;

        $test = setChangingRoomBeforeTimes($this->_params['viewAreaTimeslot'][0], $member[0], $this->_params['changingRoomBeforeStartTime'], $this->_params['changingRoomBeforeEndTime'],  $this->_params['changingRoom'], $errors );

        if($test===false){
            header('Location: index.php?c=pages&a=chooseTimeAndRoom&typeOfTraining='.$_POST['typeOfTraining'].'&trainingDate='.$_POST['trainingDate'].'&f=kein Umkleideplatz verfügbar');
        }

        $test = setChangingRoomAfterTimes($this->_params['viewAreaTimeslot'][0], $member[0], $this->_params['changingRoomAfterStartTime'], $this->_params['changingRoomAfterEndTime'],  $this->_params['changingRoom'], $errors );


        if($test===false){
            header('Location: index.php?c=pages&a=chooseTimeAndRoom&typeOfTraining='.$_POST['typeOfTraining'].'&trainingDate='.$_POST['trainingDate'].'&f=kein Umkleideplatz verfügbar');
        }



        $this->_params['trainingDate'] = $_POST['trainingDate'];
        $this->_params['typeOfTraining'] = $_POST['typeOfTraining'];


    }


    public function actionYourTrainingEntries(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }

        $newDate =  subOneMonth();
       
        $this->_params['test'] = 'start';

        $this->_params['trainingEntry'] =  \Trainingskalender\models\TrainingEntry
        ::find('trainingDate >= \''. $newDate.'\'',' order by trainingDate');
        


    }

    
    public function actionYourTrainingDetails(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }

        $this->_params['trainingEntry'] =  \Trainingskalender\models\TrainingEntry
        ::find('trainingDate >= \''. $_GET['id'].'\'',' order by trainingDate');

    }

    
    public function actionYourTrainingDay(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }

        $member = getMemberId();

         $_SESSION['entryId'] = null;
 
        if(isset($_GET['trainingDate'])){

        $this->_params['trainingEntry'] =  \Trainingskalender\models\TrainingEntry
        ::find('memberId= \''.$member.'\' and trainingDate =\''.$_GET['trainingDate'].'\'');

        }
        else if(isset($_POST['trainingDate'])){

            $this->_params['trainingEntry'] =  \Trainingskalender\models\TrainingEntry
            ::find('memberId= \''.$member.'\' and trainingDate =\''.$_POST['trainingDate'].'\'');
        }


    }

    public function actionCourse(){
        $this->_params['Montag'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('labelling like \'%Kurs%\' and weekday = \'1\' order by startTime ASC');
        $this->_params['Dienstag'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('labelling like \'%Kurs%\' and weekday = \'2\' order by startTime ASC');
        $this->_params['Mittwoch'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('labelling like \'%Kurs%\' and weekday = \'3\' order by startTime ASC');
        $this->_params['Donnerstag'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('labelling like \'%Kurs%\' and weekday = \'4\' order by startTime ASC');
        $this->_params['Freitag'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('labelling like \'%Kurs%\' and weekday = \'5\' order by startTime ASC');

        $times = [];
        $this->_params['weekdays'] = array('Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag','Sonntag');
    }

    public function actionDeleteEntry(){
        if(getMemberId() === false){
            header('Location: index.php?c=pages&a=start');
        }

        $errors = [];

        $member = getMemberId();

        $this->_params['trainingEntry'] =  \Trainingskalender\models\TrainingEntry
        ::find('memberId= \''.$member.'\' and id =\''.$_POST['id'].'\'');

        $view =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('id = \''.$this->_params['trainingEntry'][0]['areaTimeslotId'].'\'');

        if(isset($_POST['submitDelete'])){

            deleteEntry($errors, $this->_params['trainingEntry'][0]);

            if(count($errors) === 0){
                header('Location: index.php?c=pages&a=yourTrainingDay&trainingDate='.$_POST['trainingDate'].'&message='.'Ihr Trainingseintrag wurde erfolgreich gelöscht');
            }
        }

    }
}