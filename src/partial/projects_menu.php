<?php

$menuprojects=$this->model->getMenuProjects();

?>
<nav class="container p-2 pt-4 pb-4 skew-20 text-bright">

    <div class="row justify-content-center">

        <div class="col-auto">

            <img src="<?php echo URL;?>public/img/logo-horizontal.webp" height="45px"/>

        </div>

        <div class="col-auto">

            <a href="<?php echo URL;?>projects/" class="btn btn-outline-primary">Projects</a>

        </div>

    <?php foreach($menuprojects as $menuproject){?>

        <div class="col-auto">
            <a href="<?php echo URL."projects/".$menuproject->projectcode."/";?>"
            class="btn btn-<?php if($menuproject->projectcode!==$_GET['levelb']){?>outline-<?php }?>primary">
            <?php echo $menuproject->title;?>
            
            </a>
        </div>

    <?php }?>

    </div>

</nav>