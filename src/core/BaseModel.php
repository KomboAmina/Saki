<?php
namespace Saki\Core;

class BaseModel{

    public function formatMethodName(string $rawName):string{

        $methodName=ucwords($rawName);

        $methodName=str_replace(" ","",$methodName);

        $methodName=lcfirst($methodName);

        return $methodName;

    }

    public function isNull(string $check):bool{

        return $this->isBlank($check);

    }

    public function isBlank(string $check):bool{

        $check=strip_tags($check);

        $check=str_replace(' ','',$check);

        return strlen($check)<1;

    }

    public function getSubmittedData(mixed $submitArray):array{

        $data=array();

        foreach($submitArray as $key=>$value){

            $data[$key]=$value;

        }

        return $data;

    }

    public function getProgressBarColor(float $rate):string{

        $color="bg-default";

        switch($rate){
            case $rate>0 && $rate<=25:
                $color="bg-info";
                break;
            case $rate>25 && $rate<=50:
                $color="bg-warning";
                break;
            case $rate>50 && $rate<=99:
                $color="bg-danger";
                break;
            case $rate>99:
                $color="bg-success";
                break;
        }

        return $color;

    }

}
