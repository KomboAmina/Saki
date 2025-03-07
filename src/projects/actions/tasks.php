<?php

$init=(isset($init)) ? $init:true;

if($init){
    
    include "init.php";

}

$controller=(isset($controller)) ? $controller:$this->controller;

$project=(isset($project->id)) ? $project:$controller->model->getProject(intval($_POST['projectid']));

if(isset($project->id)){

$tasks=$controller->model->getMainProjectTasks($project->id);

$defaultpriority=(isset($defaultpriority)) ? $defaultpriority:1;

?>
<h2>Tasks: <?php echo number_format($rate=$controller->model->getProjectCompletionRate($project->id),2);?>% Complete</h2>

<?php include "progress_bar.php";?>

<div class="accordion mt-4 h-50" id="taskordion">
<?php foreach($tasks as $task){
    
        $defaultpriority=$task->priority;
        if($task->iscomplete){
            echo "<div style='text-decoration:line-through;'>";
        }
    
    ?>
  <div class="accordion-item mb-2">
    <div class="accordion-header container-fluid">
      <div class="list-group-item pt-4 pb-2 collapsed" type="button"
       data-bs-toggle="collapse" data-bs-target="#taskordion-<?php echo $task->id;?>"
        aria-expanded="false" aria-controls="taskordion-<?php echo $task->id;?>">
       
        <div class="row justify-content-start">
                <div class="col-sm-12 col-md-1">
                    <?php if(!$task->iscomplete && $project->status=="open"){include "move.php";}?></div>
                <div class="col-sm-12 col-md-10">
                <?php echo "<h3>".$task->task."</h3><small>";
                echo ($task->iscomplete) ?"complete":"pending";
                echo "&nbsp;</small>";?>
                </div>
                <div class="col-sm-12 col-md-1">
                    <?php if($project->status=="open"){include "mark.php";}?>
                </div>
                
            </div>

    </div>
    </div>
    <div id="taskordion-<?php echo $task->id;?>" class="accordion-collapse collapse"
     data-bs-parent="#taskordion">
      <div class="accordion-body">
        <?php include "main_task.php";?>
      </div>
    </div>
  </div>
<?php if($task->iscomplete){
        echo "</div>";
    }

}

?><!--
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Accordion Item #2
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#taskordion">
      <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Accordion Item #3
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#taskordion">
      <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
    </div>
  </div>-->
</div>

<?php

}
?>


<script type="text/javascript">



function toggleTaskBody(targetdiv){

    var div=document.getElementById(targetdiv);

    if(div.style.display==="none"){

        div.style.display="block";

    }

    else{

        div.style.display="none";

    }
    

    /**
     * if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
     */

}

</script>