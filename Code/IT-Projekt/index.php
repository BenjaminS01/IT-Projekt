<?php
ini_set('session.cookie_lifetime', 0);
session_start();
require_once 'config/imports.php';

$controllerName=$_GET['c'] ?? 'pages';
$actionName=$_GET['a'] ?? 'start';




$controllerPath=__DIR__ . '/controller/' . $controllerName. "Controller" . '.class.php';
if (file_exists($controllerPath)){
    include_once $controllerPath;
    $className='\\Trainingskalender\\controller\\'.ucfirst( $controllerName).'Controller';

    if (class_exists($className)){
        $controllerInstance= new $className($controllerName, $actionName);
        $controllerMethod='action'.ucfirst($actionName);
        if (method_exists($controllerInstance, $controllerMethod)){
            $controllerInstance->{$controllerMethod}();
            $controllerInstance->renderHTML();
        }
    else{
            header('Location: index.php?c=pages&a=error');
        }
    }
    else{
        header('Location: index.php?c=pages&a=error');
    }
}
else{
    header('Location: index.php?c=pages&a=error');
}


