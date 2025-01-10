<form
id="fm-add-task"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-tasks"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="container-fluid pt-4 pb-4 skew-10"
>

    <input type="hidden" name="projectid" value="<?php echo $project->id;?>"/>

    <input type="hidden" name="action" value="add task"/>

    <input type="hidden" name="desc" value="task description here."/>

    <input type="hidden" name="priority" id="txtpriority" placeholder="Priority: 1=Highest"
             class="form-control" value="<?php echo $defaultpriority+1;?>" min="1" required/>

    <div class="row align-items-start">

        <div class="col-sm-12 col-md-8">

            <input type="text" name="task" id="txttask" placeholder="Task"
             class="form-control" required/>

        </div>

        <div class="col-sm-12 col-md-4">

            <div class="d-grid">

                <button type="submit" class="btn btn-primary">Add Task</button>

            </div>

        </div>

    </div>


</form>


