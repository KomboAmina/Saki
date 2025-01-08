<?php

$nestedTasks=$controller->model->getNestedTasks($task->id);

$project=$controller->model->getProject($task->projectid);

$maintask=$task;

$taskrate=$controller->model->getTaskCompletionRate($task->id);

?>

<div id="dv-nested-tasks-<?php echo $task->id;?>">

    <h3><span id="count-task-<?php echo $task->id;?>" class="count-up" data-to="<?php echo number_format($taskrate);?>"><?php echo number_format($taskrate,2);?></span>%</h3>

    <?php
    $rate=$taskrate;
    include "progress_bar.php";?>

    <div class="list-group">

    <?php
        $pos=1;
        foreach($nestedTasks as $nestedTask){
        $task=$nestedTask;

        if($task->iscomplete){
            echo "<div style='text-decoration:line-through;'>";
        }
        ?>

        <div id="#nested-list-<?php echo $maintask->id;?>"
          class="list-group-item">
            <div class="row">
                
                <div class="col-sm-12 col-md-1">
                    <?php
                if(!$maintask->iscomplete){
                $targetdiv="#dv-main-task-".$task->id;
                include "mark_nested.php";
                }
                ?></div>
                <div class="col-sm-12 col-md-9">
                    <h4><?php echo $pos.": ".$task->task;?></h4>
                    <small><?php echo ($task->iscomplete) ? "completed":"pending";?></small>
                </div>
                <div class="col-sm-12 col-md-2">
                    <?php
                    if(!$task->iscomplete){
                    include "delete_nested_task.php";
                    }?>
                </div>
            </div>
        </div>

    <?php
        if($task->iscomplete){
            echo "</div>";
        }
        $task=$maintask;
        $pos++;
    }?>

    </div>
    
</div>

<?php

