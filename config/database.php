<?php
$dbName='heroku_baf632cb15a3418';
$dns='mysql:dbname='.$dbName.';host=eu-cdbr-west-03.cleardb.net;';

$userName='b6eb0684d0bb0a';
$password='f80e7fb6';
$options=[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$db=null;
try{
    $db=new PDO($dns, $userName, $password, $options);

}catch (\PDOException $e){
    die('Database connection failed: '. $e->getMessage());
}