<?php

if(!$task->iscomplete){
    ?>
     <form
id="fm-mark-nested-task-complete"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-nested-tasks-<?php echo $maintask->id;?>"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="d-grid"
>
<input type="hidden" name="taskid" value="<?php echo $task->id;?>"/>
<input type="hidden" name="maintask" value="<?php echo $maintask->id;?>"/>
<input type="hidden" name="projectid" value="<?php echo $project->id;?>"/>
<input type="hidden" name="iscomplete" value="<?php echo !$task->iscomplete;?>"/>
<input type="hidden" name="action" value="mark nested task"/>
<button class="btn btn-sm btn-outline-primary">&check;</button>
</form>
    <?php

}

if($task->iscomplete){

    ?>
     <form
     id="fm-mark-nested-task-complete"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-nested-tasks-<?php echo $maintask->id;?>"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="d-grid"
>
<input type="hidden" name="taskid" value="<?php echo $task->id;?>"/>
<input type="hidden" name="maintask" value="<?php echo $maintask->id;?>"/>
<input type="hidden" name="projectid" value="<?php echo $project->id;?>"/>
<input type="hidden" name="iscomplete" value="<?php echo !$task->iscomplete;?>"/>
<input type="hidden" name="action" value="mark nested task"/>
<button class="btn btn-sm btn-outline-primary">&dash;</button>
</form>
    <?php

}
