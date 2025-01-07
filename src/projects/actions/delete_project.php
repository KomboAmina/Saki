<?php
    
include "init.php";

$project=$controller->model->getProject(intval($_GET['id']));

//var_dump($project);

?>

<form
id="fm-delete-project"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="this"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="container-fluid p-5"
>
<h2>Are you Sure?</h2>

<p>This action cannot be reversed.</p>

    <input type="hidden" name="id" value="<?php echo $project->id;?>"/>

    <input type="hidden" name="action" value="delete project"/>


        <div class="m-3">

            <input type="text" name="title" id="txttitle" placeholder="Project Title"
             class="form-control" value="<?php echo $project->title;?>" readonly/>

        </div>

        <div class="m-3">

            <textarea class="form-control" rows="3" name="desc" id="desc" readonly><?php echo $project->body;?></textarea>

        </div>

        <div class="m-3">

            <?php

            $statuses=array("open","completed","closed");

            ?>

            <select name="status" class="form-select" readonly>

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

            <button type="submit" class="btn btn-danger">Yes, Delete</button>

        </div>

    


</form>


