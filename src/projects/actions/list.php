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
<p>Choose a Project to continue.</p>
<?php } else{?><p>Create a Project to continue.</p><?php }?>

    <?php foreach($projects as $project){?>

        <a href="<?php echo URL."projects/".$project->projectcode."/";?>">
        <?php echo $project->title." <small>tasks: ".$controller->model->countProjectTasks($project->id)."| (".$project->status.")</small>";?></a><hr /><br/>
    

    <?php }?>
    </section>

<?php

