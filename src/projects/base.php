<?php

if(!$this->model->hasSelectedProject()){

    $init=false;

    include "list.php";

}
else{

    include "project.php";

}


