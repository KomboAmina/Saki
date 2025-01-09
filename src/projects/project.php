<?php

$project=$this->model->getProject($_GET['levelb']);

include "src/partial/projects_menu.php";

$defaultpriority=0;

?>
<section class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-3">
            <?php include "edit.php";
            if($project->status!=="open"){include "delete.php";}
            ?>
        </div>
        <div class="col-sm-12 col-md-7">
            <div id="dv-project-profile">
                <h1><?php echo $project->title;?></h1>
                <p><?php echo $project->body;?></p>
                <p><?php echo $project->status;?></p><hr />
            </div>

            <div id="dv-tasks">
                <?php
                $init=false;
                include "tasks.php";?>
            </div>

            <?php if($project->status=="open"){

                include "fm_add_task.php";

            }
?>

        </div>
    </div>

<?php

?>
</section>
<?php

