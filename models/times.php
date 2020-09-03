<?php
namespace Trainingskalender\models;
class Times{

    private $monday = [];
    private $tuesday = [];
    private $wednesday = [];
    private $thursday = [];
    private $friday = [];
    private $timesTrainingStart = array('09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00');
    private $timesTrainingEnd = array('09:45','10:45','11:45','12:45','13:45','14:45','15:45','16:45','17:45','18:45','19:45','20:45');
    private $timesTraining;
    private $timeCardio = 20; //minutes 
    private $timeChangingRoom = 5; //minutes

    function __construct(){
        $this->$timesTraining = ['09:00-09:45','10:00-10:45','11:00-11:45','12:00-12:45','13:00-13:45','14:00-14:45','15:00-15:45','16:00-16:45','17:00-17:45','18:00-18:45','19:00-19:45','20:00-20:45'];
    }

    public function getMonday(){return $monday;}
    public function getTuesday(){return $tuesday;}
    public function getWednesday(){return $wednesday;}
    public function getThursday(){return $thursday;}
    public function getFriday(){return $friday;}
    public function getTimesTrainingStart(){return $timesTrainingStart;}
    public function getTimesTrainingEnd(){return $timesTrainingEnd;}
    public function getTimesTraining(){return $this->$timesTraining;}

}