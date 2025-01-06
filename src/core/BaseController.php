<?php
namespace Saki\Core;

class BaseController{

    /**
     * @var \Saki\Core\BaseModel $model
     */
    public $model;

    /**
     * @param \Saki\Core\BaseModel   Model for this controller
     */
    public function __construct($model){

        $this->model=$model;

    }

    public function reloadPage():void{

        $this->relocate($this->getCurrentURL());

    }

    /**
     * @param string $url   URL string to replace into address bar.
     */
    public function relocate($url):void{

        if(filter_var($url,FILTER_VALIDATE_URL)){

            header("Location: ".$url);

        }

    }

    /**
     * @return string
     */
    public function getCurrentURL():string{

        return (empty($_SERVER['HTTPS']) ? 'http' : 'https')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    }

    public function checkBlanks($vals=array()):array{

        $errors=array();

        foreach($vals as $val){

            if(isset($_REQUEST[$val]) && $this->model->isBlank($_REQUEST[$val])){

                $errors[$val]="required.";

            }

        }

        return $errors;

    }

    public function recover($vals=array()):array{

        $saved=array();

        foreach($vals as $val){

            if(isset($_REQUEST[$val])){

                $saved[$val]=$_POST[$val];

            }

        }

        return $saved;

    }

}
