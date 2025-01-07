<?php

$project=$this->model->getProject($_GET['levelb']);

include "src/partial/projects_menu.php";

?>
<section class="container">
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <?php include "edit.php";?>
        </div>
        <div class="col-sm-12 col-md-9">
            <h1><?php echo $project->title;?></h1>
            <p><?php echo $project->body;?></p>
            <p><?php echo $project->status;?></p><hr />

            <?php include "tasks.php";?>

        </div>
    </div>

<?php

?>
</section>
<?php

