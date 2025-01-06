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

}
