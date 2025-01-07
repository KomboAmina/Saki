<?php
    
include "init.php";

$project=$controller->model->getProject(intval($_GET['id']));

//var_dump($project);

?>

<form
id="fm-edit-project"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="this"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="container-fluid p-5"
>
<h2>Edit Project</h2>

    <input type="hidden" name="id" value="<?php echo $project->id;?>"/>

    <input type="hidden" name="action" value="edit project"/>


        <div class="m-3">

            <input type="text" name="title" id="txttitle" placeholder="Project Title"
             class="form-control" value="<?php echo $project->title;?>" required/>

        </div>

        <div class="m-3">

            <textarea class="form-control" rows="3" name="desc" id="desc"><?php echo $project->body;?></textarea>

        </div>

        <div class="m-3">

            <?php

            $statuses=array("open","completed","closed");

            ?>

            <select name="status" class="form-select">

            <?php

            foreach($statuses as $status){

                echo "<option value='".$status."' ";

                if($status==$project->status){echo "selected";}

                echo ">".ucwords($status)."</option>";

            }

            ?>

            </select>

        </div>

        <div class="m-3">

            <button type="submit" class="btn btn-primary">Save</button>

        </div>

    


</form>


