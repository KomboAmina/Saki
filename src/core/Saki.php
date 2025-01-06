<?php
namespace Saki\Core;

class Saki{

    public object $model;

    public object $controller;

    public object $view;

    public function __construct(){

        $this->model=new \Saki\Core\SakiModel();

        $this->controller=new \Saki\Core\SakiController($this->model);

        $this->view=new \Saki\Core\BaseView($this->controller);

    }

}
