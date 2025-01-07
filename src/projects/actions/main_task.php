<?php
$taskrate=$controller->model->getTaskCompletionRate($task->id);

?>
<div class="row justify-content-end">
    <?php if($project->status=="open" && !$task->iscomplete){?>
    <div class="col-sm-12 col-md-1">
        <?php include "focus_main_task_for_edit.php";?>
    </div>
    <?php }?>
    <?php if(!$task->iscomplete){?>
    <div class="col-sm-12 col-md-1">
        <?php include "focus_main_task_for_delete.php";?>
    </div>
    <?php }?>
</div>

<div id="dv-main-task-<?php echo $task->id;?>">

    <div class="container"
     id="dv-task-body-<?php echo $task->id;?>"><?php echo $task->taskbody;?>
     <hr />
    </div>

    <?php

    include "main_task_edit.php";

    include "main_task_delete.php";
    
    include "nested_tasks.php";

    if(!$task->iscomplete){
    
        include "add_nested_task.php";

    }

    ?>

</div>
