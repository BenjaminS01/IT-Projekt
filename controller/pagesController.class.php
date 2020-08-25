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
       

       $this->$_params['trainingEntry'] = \Trainingskalender\models\TrainingEntry::find('memberId= ' . '\'' . $memberId . '\'');

        /*if(...)
        $nxtm = strtotime("next month");
        $this->$_params['month'] = date("F", $nxtm);
        */
        $this->$_params['month'] = date("F");
        
        

    }


}