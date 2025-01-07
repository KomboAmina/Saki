<?php

$menuprojects=$this->model->getMenuProjects();

?>
<nav class="container p-2">

    <ul class="row justify-content-end">

        <li class="col-sm-12 col-md-2">
            <a href="<?php echo URL;?>projects/">Projects</a>
        </li>

    <?php foreach($menuprojects as $menuproject){?>

        <li class="col-sm-12 col-md-2">
            <?php if($menuproject->projectcode!==$_GET['levelb']){?>
            <a href="<?php echo URL."projects/".$menuproject->projectcode."/";?>">
            <?php }?>
            <?php echo $menuproject->title;?>
            <?php if($menuproject->projectcode!==$_GET['levelb']){?>
            </a>
            <?php }?>
        </li>

    <?php }?>

    </ul>

</nav>