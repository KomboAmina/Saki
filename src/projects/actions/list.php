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

<div class="row justify-content-center">
    <div class="col-sm-12 col-md-4 text-center p-4">
        
        <div class="p-4 border">
            <p class="display-1"><?php echo number_format($controller->model->getUniversalCompletionRate());?>%</p>
            <p class="text-uppercase">complete</p>
        </div>

    </div>
    <div class="col-sm-12 col-md-8">
        <h1>Projects</h1>
        <div class="list-group mb-2">
        <?php foreach($projects as $project){
            $rate=$controller->model->getProjectCompletionRate($project->id);
            ?>

            <a href="<?php echo URL."projects/".$project->projectcode."/";?>"
            class="list-group-item">
            <?php echo $project->title." <small class='float-end'>| &nbsp; tasks: ".$controller->model->countProjectTasks($project->id)." &nbsp; | &nbsp; (".$project->status.")</small>";?></a>
            
            <?php
            include "progress_bar.php";
            ?>
            <div class="mb-2"></div>


        <?php }?>
        </div>

        <?php

        include "fm_add_project_title_only.php";
        
        ?>
       
    </div>
</div>
</section>