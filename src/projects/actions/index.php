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
        case "editProject": case "deleteProject": case "editTask": case "deleteTask":
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
                include "tasks.php";
            }
            break;
        case "addNestedTask":
            $project=$controller->model->getProject($_REQUEST['projectid']);
            
            $task=$controller->model->getTask($_REQUEST['maintask']);
            include "nested_tasks.php";
            break;
        case "markNestedTask":
            $project=$controller->model->getProject($_REQUEST['projectid']);
            
            $task=$controller->model->getTask($_REQUEST['maintask']);
            include "nested_tasks.php";
            break;
        case "deleteNestedTask":

            $project=$controller->model->getProject(intval($_REQUEST['projectid']));
            
            $task=$controller->model->getTask(intval($_REQUEST['maintask']));

            include "main_task.php";

            break;
    }
    

}
