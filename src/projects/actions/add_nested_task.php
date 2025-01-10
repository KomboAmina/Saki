<form
id="fm-add-task"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-nested-tasks-<?php echo $task->id;?>"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="container-fluid pt-2 pb-2 skew-10"
>

    <input type="hidden" name="projectid" value="<?php echo $project->id;?>"/>

    <input type="hidden" name="maintask" value="<?php echo $task->id;?>"/>

    <input type="hidden" name="action" value="add nested task"/>

    <input type="hidden" name="desc" value="task description here."/>

    <input type="hidden" name="priority" id="txtpriority" value="<?php echo $pos;?>"/>

    <div class="row justify-content-end">

        <div class="col-sm-12 col-md-8">

            <input type="text" name="task" id="txttask" placeholder="Task"
             class="form-control" required/>

        </div>

        <div class="col-md-4">
            <div class="d-grid">

            <button type="submit" class="btn btn-primary">Add Task</button>
            
            </div>
        </div>

    </div>


</form>


