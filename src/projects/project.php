<?php

$project=$this->model->getProject($_GET['levelb']);

include "src/partial/projects_menu.php";

?>
<section class="container">
<h1><?php echo $project->title;?></h1>
<p><?php echo $project->body;?></p>
<p><?php echo $project->status;?></p>
<?php
include "edit.php";
?>
</section><hr />
<?php

include "tasks.php";