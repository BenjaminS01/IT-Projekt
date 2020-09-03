<?php
namespace Trainingskalender\models;
class ViewAreaTimeslot extends BaseModel {

    const TABLENAME = 'viewAreaTimeslot';
    protected $schema=[
    'labelling'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'startTime'=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'endTime'=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'weekday'=>['type'=>BaseModel::TYPE_STRING, 'min'=>1, 'max'=>50],
    ];
}