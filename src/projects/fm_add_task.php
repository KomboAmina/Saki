<form
id="fm-add-task"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-tasks"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="container-fluid p-5"
>

    <input type="hidden" name="projectid" value="<?php echo $project->id;?>"/>

    <input type="hidden" name="action" value="add task"/>

    <input type="hidden" name="desc" value="task description here."/>

    <div class="row g-3 align-items-start">

        <div class="col-auto">

            <label>Task:</label>

            <input type="text" name="task" id="txttask" placeholder="Task"
             class="form-control" required/>

        </div>

        <div class="col-auto">

            <label>Priority (1- Highest)</label>

            <input type="number" name="priority" id="txtpriority" placeholder="Priority: 1=Highest"
             class="form-control" value="<?php echo $defaultpriority+1;?>" min="1" required/>

        </div>

        <div class="col-auto">

            <label>&nbsp;</label>

            <button type="submit" class="btn btn-primary">Add Task</button>

        </div>

    </div>


</form>


