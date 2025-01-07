<?php

$init=(isset($init)) ? $init:true;

if($init){
    
    include "init.php";

}

$controller=(isset($controller)) ? $controller:$this->controller;

$project=(isset($project->id)) ? $project:$controller->model->getProject(intval($_POST['projectid']));

if(isset($project->id)){

$tasks=$controller->model->getProjectTasks($project->id);

//print_r($tasks);

?>
<section class="list-group">
    <?php foreach($tasks as $task){?>
        <a href="#" class="list-group-item">
            <div class="row justify-content-start">
                <div class="col-sm-12 col-md-1"><?php include "move.php";?></div>
                <div class="col-sm-12 col-md-7">
                <?php echo $task->task."<br/><small>";
                echo ($task->iscomplete) ?"complete":"pending";
                echo "</small>";?>
                </div>
                <div class="col-sm-12 col-md-1">&check;</div>
                <div class="col-sm-12 col-md-3">edit/delete</div>
            </div>
        </a>
    <?php }?>
</section>
<?php

}
