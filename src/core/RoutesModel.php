<?php
namespace Saki\Core;

class RoutesModel{

    public array $validRoutes;

    public string $defaultRoute;

    public function __construct(){

        $this->validRoutes=$this->getValidRoutes();

        $this->defaultRoute=$this->getDefaultRoute();

    }

    private function getValidRoutes():array{

        return array("projects");

    }

    private function getDefaultRoute():string{

        return (!empty($this->validRoutes)) ? $this->validRoutes[0]:"projects";

    }

    public function isValidRoute(string $check):bool{

        return in_array($check,$this->validRoutes);

    }

}
