<?php

namespace Trainingskalender\controller;

class PagesController extends \Trainingskalender\core\Controller
{
    public function actionStart(){

    }

    public function actionLogin(){
        
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
        
    }


}