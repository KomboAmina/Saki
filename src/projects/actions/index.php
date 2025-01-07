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

    switch($methodName){
        case "addProject":
            include_once "list.php";
            break;
        case "editProject": case "deleteProject":
            ?>
            <script type="text/javascript">
                window.location.reload();
            </script>
            <?php
            break;
        case "addTask": case "moveTask": case "markTask":
            if($ret['status']=="project changed"){
                ?>
                <script type="text/javascript">
                    window.location.reload();
                </script>
            <?php
            }
            else{
                $project=$controller->model->getProject($_REQUEST['projectid']);
                include_once "tasks.php";
            }
            break;
    }
    

}
