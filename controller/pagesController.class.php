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
           
        }
    }

    public function actionKalender(){
        
    }


}