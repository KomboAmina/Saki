<?php

$configFiles=array("vendor/autoload.php","src/config/include.php");

$configErrors=array();

foreach($configFiles as $configFile){

    if(file_exists($configFile)){

        require_once $configFile;

    }

    else{

        $configErrors[]="config file not found: ".$configFile;

    }

}

if(!empty($configErrors)){

    echo "<h1>Error(s)</h1><ol>";

    foreach($configErrors as $configError){

        echo "<li>".$configError."</li>";

    }

    echo "</ol>";

}

else{

    $saki=new \Saki\Core\Saki();

}