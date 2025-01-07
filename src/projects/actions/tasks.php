<?php

$init=(isset($init)) ? $init:true;

if($init){
    
    include "init.php";

}

$controller=(isset($controller)) ? $controller:$this->controller;

$project=(isset($project->id)) ? $project:$controller->model->getProject(intval($_POST['projectid']));

if(isset($project->id)){

$tasks=$controller->model->getProjectTasks($project->id);

$defaultpriority=(isset($defaultpriority)) ? $defaultpriority:1;

//print_r($tasks);

?>
<h2>Tasks: <?php echo number_format($rate=$controller->model->getProjectCompletionRate($project->id),2);?>% Complete</h2>
<div class="progress mt-2 mb-2" role="progressbar"
 aria-label="Progress Bar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar <?php echo $controller->model->getProgressBarColor($rate);?>" style="width: <?php echo $rate;?>%"></div>
</div>
<section class="list-group">
    <?php foreach($tasks as $task){
        
        $defaultpriority=$task->priority;
        if($task->iscomplete){
            echo "<div style='text-decoration:line-through;'>";
        }
        ?>
        <a href="#" class="list-group-item">
            <div class="row justify-content-start">
                <div class="col-sm-12 col-md-1">
                    <?php if(!$task->iscomplete){include "move.php";}?></div>
                <div class="col-sm-12 col-md-7">
                <?php echo "<h3>".$task->task."</h3><small>";
                echo ($task->iscomplete) ?"complete":"pending";
                echo "&nbsp; | &nbsp; priority: ".$task->priority."</small>";?>
                </div>
                <div class="col-sm-12 col-md-1"><?php include "mark.php";?></div>
                <div class="col-sm-12 col-md-3">edit/delete</div>
            </div>
        </a>
    <?php
    if($task->iscomplete){
        echo "</div>";
    }
    }?>
</section>
<?php

}
