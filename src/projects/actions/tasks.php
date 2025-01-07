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
<section class="list-group">
    <?php foreach($tasks as $task){
        
        $defaultpriority=$task->priority;

        ?>
        <a href="#" class="list-group-item">
            <div class="row justify-content-start">
                <div class="col-sm-12 col-md-1"><?php include "move.php";?></div>
                <div class="col-sm-12 col-md-7">
                <?php echo "<h3>".$task->task."</h3><small>";
                echo ($task->iscomplete) ?"complete":"pending";
                echo "&nbsp; | &nbsp; priority: ".$task->priority."</small>";?>
                </div>
                <div class="col-sm-12 col-md-1">&check;</div>
                <div class="col-sm-12 col-md-3">edit/delete</div>
            </div>
        </a>
    <?php }?>
</section>
<?php

}
