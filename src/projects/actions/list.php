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
    <?php foreach($projects as $project){?>

        <a href="<?php echo URL."projects/".$project->projectcode."/";?>" class="list-group-item">
        <?php echo $project->title." <small>tasks: ".$controller->model->countProjectTasks($project->id)." | (".$project->status.")</small>";?></a>
    

    <?php }?>
    </div>
    </section>

<?php

