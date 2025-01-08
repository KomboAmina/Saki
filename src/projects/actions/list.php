<?php

$init=(isset($init)) ? $init:true;

if($init){
    
    include "init.php";

}

$controller=(isset($controller)) ? $controller:$this->controller;

$projects=$controller->model->getListProjects();

//print_r($projects);

?>
<section class="container p-4">
<h1>Projects</h1>
<div class="row justify-content-center">
    <div class="col-sm-12 col-md-4 text-center p-4">

        <p class="display-1">&approx;<br /><?php echo number_format($controller->model->getUniversalCompletionRate());?>%</p>
        <p>complete</p>

    </div>
    <div class="col-sm-12 col-md-8">
    <?php if(!empty($projects)){?>
    <p>Choose
    <?php } else{?>Create<?php }?> a Project to continue.</p>
        <div class="list-group mb-2">
        <?php foreach($projects as $project){
            $rate=$controller->model->getProjectCompletionRate($project->id);
            ?>

            <a href="<?php echo URL."projects/".$project->projectcode."/";?>"
            class="list-group-item">
            <?php echo $project->title." &nbsp; | &nbsp; <small>tasks: ".$controller->model->countProjectTasks($project->id)." | (".$project->status.")</small>";?></a>
            
            <?php
            include "progress_bar.php";
            ?>
            <div class="mb-2"></div>


        <?php }?>
        </div>
        </section>
    </div>
</div>
