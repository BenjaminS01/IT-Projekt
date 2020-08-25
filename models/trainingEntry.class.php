<?php
namespace Trainingskalender\models;
class TrainingEntry extends BaseModel {

    const TABLENAME = 'trainingEntry';
    protected $schema=[
    'id'=>['type'=>BaseModel::TYPE_INT],
    'trainingDateTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'typeOfTraining' =>['type'=> BaseModel::TYPE_ENUM_G],
    'memberId'=>['type'=>BaseModel::TYPE_INT]
    ];
}