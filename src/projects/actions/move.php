<?php


if($task->priority>1){

    ?>
    <form
id="fm-move-task-up"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-tasks"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="d-grid"
>
<input type="hidden" name="taskid" value="<?php echo $task->id;?>"/>
<input type="hidden" name="projectid" value="<?php echo $project->id;?>"/>
<input type="hidden" name="priority" value="<?php echo $task->priority-1;?>"/>
<input type="hidden" name="action" value="move task"/>
<button class="btn btn-sm btn-default">&uarr;</button>
</form>
    <?php

}

?>
    <form
id="fm-move-task-down"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-tasks"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="d-grid"
>
<input type="hidden" name="taskid" value="<?php echo $task->id;?>"/>
<input type="hidden" name="projectid" value="<?php echo $project->id;?>"/>
<input type="hidden" name="priority" value="<?php echo $task->priority+1;?>"/>
<input type="hidden" name="action" value="move task"/>
<button class="btn btn-sm btn-default">&darr;</button>
</form>
    <?php
