<?php
namespace Trainingskalender\models;
class Timeslot extends BaseModel {

    const TABLENAME = 'Timeslot';
    protected $schema=[
    'id'=>['type'=>BaseModel::TYPE_INT],
    'startTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'endTime' =>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50]
    ];
}