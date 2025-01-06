<?php
namespace Saki\Core;

class Saki{

    public object $model;

    public object $controller;

    public object $view;

    public object $routesModel;

    public string $route;

    public function __construct(){

        $this->routesModel=new \Saki\Core\RoutesModel();

        $this->route=$this->getRoute();

        $this->model=$this->getModel();

        $this->controller=$this->getController();

        $this->view=new \Saki\Core\BaseView($this->controller);

    }

    private function getRoute():string{

        $route=$this->routesModel->defaultRoute;

        if(!isset($_GET['levela'])){

            header("Location: ".URL.$this->routesModel->defaultRoute."/");

        }

        if(isset($_GET['levela']) && $this->routesModel->isValidRoute($_GET['levela'])){

            $route=$_GET['levela'];

        }

        return $route;

    }

    private function getModel():object{

        $desiredClass="Saki\\".ucwords($this->route)."\\".ucwords($this->route)."Model";

        $defaultClass="Saki\\Core\\SakiModel";

        return (class_exists($desiredClass)) ? new $desiredClass: new $defaultClass;

    }

    private function getController():object{

        $desiredClass="Saki\\".ucwords($this->route)."\\".ucwords($this->route)."Controller";

        $defaultClass="Saki\\Core\\SakiController";

        return (class_exists($desiredClass)) ? new $desiredClass($this->model): new $defaultClass($this->model);

    }

}
