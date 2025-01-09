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
class="container-fluid mb-2 skew-10"
>
<h2>Are you Sure?</h2>

<p>This action cannot be reversed.</p>

    <input type="hidden" name="id" value="<?php echo $project->id;?>"/>

    <input type="hidden" name="action" value="delete project"/>


        <div class="m-3">

            <h2><?php echo $project->title;?></h2>

        </div>

        <div class="m-3">

            <p><?php echo $project->body;?></p>

        </div>

        <div class="m-3">

            <?php

            echo "<p>".ucwords($project->status)."</p>";

            $statuses=array("open","completed","closed");

            ?>

        </div>

        <div class="m-3">

            <button type="submit" class="btn btn-danger">Yes, Delete</button>

        </div>

</form>


