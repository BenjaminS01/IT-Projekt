<?php
namespace Trainingskalender\models;
class TrainingEntry extends BaseModel {

    const TABLENAME = 'trainingEntry';
    protected $schema=[
    'id'=>['type'=>BaseModel::TYPE_INT],
    'trainingDate'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'typeOfTraining' =>['type'=> BaseModel::TYPE_ENUM_G],
    'changingRoom'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'changingRoomBeforeStartTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'changingRoomBeforeEndTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'changingRoomAfterStartTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'changingRoomAfterEndTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'cardioStartTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'cardioEndTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'memberId'=>['type'=>BaseModel::TYPE_INT],
    'areaTimeslotId'=>['type'=>BaseModel::TYPE_INT]
    ];
}