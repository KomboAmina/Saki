<?php

$init=(isset($init)) ? $init:true;

if($init){
    
    include "init.php";

}

$controller=(isset($controller)) ? $controller:$this->controller;

$projects=$controller->model->getListProjects();

//print_r($projects);

?>
<section class="container">
<h1>Projects</h1>
<?php if(!empty($projects)){?>
<p>Choose
<?php } else{?>Create<?php }?> a Project to continue.</p>
    <div class="list-group">
    <?php foreach($projects as $project){
        $rate=$controller->model->getProjectCompletionRate($project->id);
        ?>

        <a href="<?php echo URL."projects/".$project->projectcode."/";?>" class="list-group-item">
        <?php echo $project->title." &nbsp; | &nbsp; <small>tasks: ".$controller->model->countProjectTasks($project->id)." | (".$project->status.")</small>";?></a>
        
        <div class="progress mb-4" role="progressbar"
            aria-label="Progress Bar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar-striped <?php echo $controller->model->getProgressBarColor($rate);?>" style="width: <?php echo $rate;?>%"></div>
        </div>


    <?php }?>
    </div>
    </section>

<?php

