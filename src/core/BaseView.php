<?php
namespace Saki\Core;

class BaseView{

    public object $model;

    public object $controller;

    public string $route;

    public function __construct($controller, string $route){

        $this->controller=$controller;

        $this->model=$this->controller->model;

        $this->route=$route;

    }

    public function load():void{

        include_once "src/partial/header.php";

        $baseFile="src/".$this->route."/base.php";

        if(file_exists($baseFile)){

            include_once $baseFile;

        }
        else{

            $this->show404();

        }

        include_once "src/partial/footer.php";

    }

    private function show404():void{

        include "src/errors/404.php";

    }

    private function showNoProjects():void{

        include "src/errors/no_projects.php";

    }

    private function showPagination(){

        include "src/partial/pagination.php";

    }

}
