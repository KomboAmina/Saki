<?php if(!$task->iscomplete){?>
<div class="collapse" id="delete-main-task-<?php echo $task->id;?>">

  <div class="container">

  <form
id="fm-delete-main-task"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-tasks"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="container-fluid"
>

    <input type="hidden" name="projectid" value="<?php echo $project->id;?>"/>

    <input type="hidden" name="taskid" value="<?php echo $task->id;?>"/>

    <input type="hidden" name="action" value="delete task"/>

        <div class="mb-3">

            <label>Task:</label>

            <input type="text" name="task" id="txttask" placeholder="Task"
             class="form-control" value="<?php echo $task->task;?>" readonly/>

        </div>

        <div class="mb-3">

            <textarea name="desc" id="desc" class="form-control" rows="3" readonly><?php echo $task->taskbody;?></textarea>

        </div>

        <div class="mb-3">

            <button class="btn btn-danger">Yes, Delete</button>

        </div>


</form>




  </div>

</div>
<?php }
