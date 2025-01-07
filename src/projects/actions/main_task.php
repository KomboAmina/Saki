<?php
$nestedTasks=$controller->model->getNestedTasks($task->id);
?>
<div class="row justify-content-end">
    <?php if($project->status=="open"){?>
    <div class="col-sm-12 col-md-1">
        <?php include "focus_main_task_for_edit.php";?>
    </div>
    <?php }?>
    <div class="col-sm-12 col-md-1">
        <?php include "focus_main_task_for_delete.php";?>
    </div>
</div>
<div class="dv-main-task-<?php echo $task->id;?>">

    <p id="dv-task-body-<?php echo $task->id;?>"><?php echo $task->taskbody;?></p>

    <?php
    include "main_task_edit.php";
    ?>

    <?php print_r($nestedTasks);?>

</div>
