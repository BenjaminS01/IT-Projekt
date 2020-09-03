<?php
namespace Trainingskalender\models;
class Area extends BaseModel {

    const TABLENAME = 'Area';
    protected $schema=[
    'id'=>['type'=>BaseModel::TYPE_INT],
    'labelling'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'maxNumberOfPeople' =>['type'=>BaseModel::TYPE_INT]
    ];
}