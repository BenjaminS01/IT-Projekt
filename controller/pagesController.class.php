<?php

namespace Trainingskalender\controller;

class PagesController extends \Trainingskalender\core\Controller
{
 

    public function actionStart(){

       if(isset($_GET['param'])) {

            if ($_GET['param']=='logout') {
                logout();
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
        
        $errors = [];
        $memberId = getMemberId();
        $_SESSION['trainingDate'] = null;
       

       $this->$_params['trainingEntry'] = \Trainingskalender\models\TrainingEntry::find('memberId= ' . '\'' . $memberId . '\'');

        /*if(...)
        $nxtm = strtotime("next month");
        $this->$_params['month'] = date("F", $nxtm);
        */
        $this->$_params['month'] = date("F");
        
        

    }

    public function actionChooseTypeOfTraining(){


    }

    public function actionChooseTimeAndRoom(){


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

        $this->_params['viewAreaTimeslot'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('weekday =\''.$dayOfWeek.'\'');
        }
/*
        if(isset($_POST['submitChooseTimeAndRoom'])){

                header('Location: index.php?c=pages&a=confirmTrainingTimes'); 

        }
        */
    }

    public function actionConfirmTrainingTimes(){

        $errors = [];

        $this->_params['viewAreaTimeslot'] =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('startTime =\''.$_POST['trainingTime'].'\' and labelling = \''.$_POST['trainingArea'].'\'');

        
        $timeChangingRoomBeforeTraining;
        $timeChangingRoomAfterTraining;
        $this->_params['cardioStartTime'] = '';
        $this->_params['cardioEndTime'] = '';
    
    
        $test = setCardioTimes($this->_params['viewAreaTimeslot'][0], $this->_params['cardioStartTime'], $this->_params['cardioEndTime'], $errors );

        if($test===false){
           //redirect errors.....
        }

        $this->_params['memberId'] = getMemberId();

        $member = \Trainingskalender\models\Member
        ::find('id = \''.$this->_params['memberId'].'\'');

        $this->_params['changingRoomBeforeStartTime'] = '';
        $this->_params['changingRoomBeforeEndTime'] = '';
        $this->_params['changingRoom'] = null;

        $this->_params['test'] = setChangingRoomBeforeTimes($this->_params['viewAreaTimeslot'][0], $member[0], $this->_params['changingRoomBeforeStartTime'], $this->_params['changingRoomBeforeEndTime'],  $this->_params['changingRoom'] );

        if($test===false){
        //redirect errors.....
        }

    }

    


}