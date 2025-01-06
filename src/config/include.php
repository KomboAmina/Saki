<?php

$prefix=(isset($prefix)) ? $prefix:"";

$configErrors=(isset($configErrors) && is_array($configErrors)) ? $configErrors:array();

$includeFiles=array("src/config/basic.php","src/config/database.php");

foreach($includeFiles as $includeFile){

    $includeFile=$prefix.$includeFile;

    if(file_exists($includeFile)){

        include_once $includeFile;

    }
    
    else{

        $configErrors[]="config file not found: ".$includeFile;

    }

}
