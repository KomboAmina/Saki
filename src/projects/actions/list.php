<?php

$init=(isset($init)) ? $init:true;

if($init){
    
    include "init.php";

}

$controller=(isset($controller)) ? $controller:$this->controller;

$projects=$controller->model->getListProjects();

//print_r($projects);

$rate=$controller->model->getUniversalCompletionRate();

?>
<section class="container p-4">

<div class="row justify-content-center skew-10">
    <div class="col-sm-12 col-md-4 text-center">
        
        <div class="p-4 border border-2 bg-default text-bright">
            <img src="<?php echo URL;?>public/img/logo-vertical.webp" class="img-fluid pb-2"/>
            <p class="display-1">
                <span class="count-up"
                data-to="<?php echo number_format($rate);?>"
                 id="cn-base"><?php
                echo number_format($rate);?></span>%
                </p>
            <p class="text-uppercase">complete</p>
        </div>
        <?php
        
        include "progress_bar.php";?>

    </div>
    <div class="col-sm-12 col-md-7">
        <div class="list-group mb-2 project-list" title="projects">
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