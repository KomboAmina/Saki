<form
id="fm-delete-nested-task"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-main-task-<?php echo $maintask->id;?>"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
>

    <input type="hidden" name="projectid" value="<?php echo $project->id;?>"/>

    <input type="hidden" name="taskid" value="<?php echo $task->id;?>"/>

    <input type="hidden" name="maintask" value="<?php echo $maintask->id;?>"/>

    <input type="hidden" name="action" value="delete nested task"/>

        <div class="d-grid">

            <button class="btn btn-outline-danger btn-sm">delete</button>

        </div>


</form>
