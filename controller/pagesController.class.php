<?php

namespace Trainingskalender\controller;

class PagesController extends \Trainingskalender\core\Controller
{
 

    public function actionStart(){

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

        $errors = [];
       if(isset($_GET['param'])) {

            if ($_GET['param']=='logout') {
                logout();
            }
            
        }

        if (isset($_POST['submitTrainingEntry'])){
            
            trainingEntry($errors);
            if(!empty($errors)){
                var_dump($errors);
           header('Location: index.php?c=pages&a=chooseTimeAndRoom&typeOfTraining='.$_GET['typeOfTraining'].'&trainingDate='.$_GET['trainingDate'].'&f='.$errors[0]);
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
            }
    
            if(count($errors) === 0){
                header('Location: index.php?c=pages&a=start');
            }
          
            $this->_params['error'] = $errors;
           
        }

    }

    public function actionKalender(){
        $db = $GLOBALS['db'];
        $errors = [];
        $memberId = getMemberId();
        $_SESSION['trainingDate'] = null;
       
        $query1 = $db->prepare('SELECT DISTINCT trainingDate FROM trainingEntry WHERE memberId =\'' . $memberId . '\' and year(curdate()) = year(trainingDate)
        and month(curdate()) = month(TrainingDate)');
        $query1->execute();
        $this->_params['trainingEntry'] = $query1->fetchall();
/*
       $this->_params['trainingEntry'] = \Trainingskalender\models\TrainingEntry::find('memberId= ' . '\'' . $memberId . '\' and year(curdate()) = year(trainingDate)
       and month(curdate()) = month(TrainingDate)');
*/
        /*if(...)
        $nxtm = strtotime("next month");
        $this->$_params['month'] = date("F", $nxtm);
        */
        $this->_params['month'] = date("F");
       
        



        /////test
        	foreach ($this->_params['trainingEntry'] as $key => $value){
                $this->_params['events'][$this->_params['trainingEntry'][$key]['trainingDate']] = $this->_params['trainingEntry'][$key];
            }
        

    }

    public function actionChooseTypeOfTraining(){

        $this->_params['date'] = getTrainingDateClass();
       
    
 
  
    }

    public function actionChooseTimeAndRoom(){
       
        $this->_params['error'] = [];
        if(isset($_GET['f'])){
            array_push($this->_params['error'], $_GET['f']);
            //$this->_params['error'] = $_GET['f'];
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
        $this->_params['test'] = null;
    
    
        $test = setCardioTimes($this->_params['viewAreaTimeslot'][0], $this->_params['cardioStartTime'], $this->_params['cardioEndTime'], $errors );

        if($test===false){
            header('Location: index.php?c=pages&a=chooseTimeAndRoom&typeOfTraining='.$_POST['typeOfTraining'].'&trainingDate='.$_POST['trainingDate'].'&a='.$errors.'test1');
        }

        $this->_params['memberId'] = getMemberId();

        $member = \Trainingskalender\models\Member
        ::find('id = \''.$this->_params['memberId'].'\'');

        $this->_params['changingRoomBeforeStartTime'] = '';
        $this->_params['changingRoomBeforeEndTime'] = '';
        $this->_params['changingRoomAfterStartTime'] = '';
        $this->_params['changingRoomAfterEndTime'] = '';
        $this->_params['changingRoom'] = null;

        $test = setChangingRoomBeforeTimes($this->_params['viewAreaTimeslot'][0], $member[0], $this->_params['changingRoomBeforeStartTime'], $this->_params['changingRoomBeforeEndTime'],  $this->_params['changingRoom'], $errors , $this->_params['test']);

        if($test===false){
            header('Location: index.php?c=pages&a=chooseTimeAndRoom&typeOfTraining='.$_POST['typeOfTraining'].'&trainingDate='.$_POST['trainingDate'].'&f='.$errors[0].'test2');
        }

        $test = setChangingRoomAfterTimes($this->_params['viewAreaTimeslot'][0], $member[0], $this->_params['changingRoomAfterStartTime'], $this->_params['changingRoomAfterEndTime'],  $this->_params['changingRoom'], $errors );

        if($test===false){
            header('Location: index.php?c=pages&a=chooseTimeAndRoom&typeOfTraining='.$_POST['typeOfTraining'].'&trainingDate='.$_POST['trainingDate'].'&f='.$errors[0].'test3');
        }

        $this->_params['trainingDate'] = $_POST['trainingDate'];
        $this->_params['typeOfTraining'] = $_POST['typeOfTraining'];

       echo $this->_params['test'];  

    }


    public function actionYourTrainingEntries(){

        $newDate =  subOneMonth();
       
        $this->_params['test'] = $newDate;

        $this->_params['trainingEntry'] =  \Trainingskalender\models\TrainingEntry
        ::find('trainingDate >= \''. $newDate.'\'',' order by trainingDate');
        

    }

}