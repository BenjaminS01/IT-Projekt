<?php
namespace Trainingskalender\models;
class Member extends BaseModel {

    const TABLENAME = 'member';
    protected $schema=[
    'id'=>['type'=>BaseModel::TYPE_INT],
    'firstName'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'lastName'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'gender' =>['type'=> BaseModel::TYPE_ENUM_G],
    'phoneNumber'=>['type'=>BaseModel::TYPE_STRING],
    'email'=>['type'=>BaseModel::TYPE_STRING, 'min'=>5, 'max'=> 50],
    'password'=>['type'=>BaseModel::TYPE_STRING, 'min'=>60, 'max'=> 255]
    ];
}