<?php

$init=(isset($init)) ? $init:true;

if($init){
    
    include "init.php";

}

if(isset($_POST['action'])){

    $methodName=$controller->model->formatMethodName($_REQUEST['action']);

    $formData=$controller->model->getSubmittedData($_REQUEST);

    $ret=null;

    if(method_exists($controller,$methodName)){

        $ret=$controller->$methodName($formData);

    }

    include_once "list.php";

}
