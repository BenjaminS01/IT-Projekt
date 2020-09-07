<?php
namespace Trainingskalender\models;
class Course extends BaseModel {

    const TABLENAME = 'Course';
    protected $schema=[
    'id'=>['type'=>BaseModel::TYPE_INT],
    'labelling'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'endTime' =>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50]
    ];
}