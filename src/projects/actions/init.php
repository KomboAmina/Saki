<?php

$prefix="../../../";

$includeFiles=array("vendor/autoload.php","src/config/include.php");

foreach($includeFiles as $includeFile){

    include_once $prefix.$includeFile;

}

$controller=new \Saki\Projects\ProjectsController(new \Saki\Projects\ProjectsModel());

