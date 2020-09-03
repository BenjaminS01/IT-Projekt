<?php
namespace Trainingskalender\models;
class AreaTimeslot extends BaseModel {

    const TABLENAME = 'areaTimeslot';
    protected $schema=[
    'id'=>['type'=>BaseModel::TYPE_INT],
    'areaId'=>['type'=>BaseModel::TYPE_INT],
    'timeslotId'=>['type'=>BaseModel::TYPE_INT],
    'weekday' =>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50]
    ];
}