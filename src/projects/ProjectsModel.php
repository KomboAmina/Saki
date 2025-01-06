<?php
namespace Saki\Projects;

class ProjectsModel extends \Saki\Core\SakiModel{

    public function generateProjectCode():string{

        $code=\Saki\Core\StringGenerator::generateCode(12);

        if($this->projectCodeExists($code)){

            $code=$this->generateProjectCode();

        }

        return $code;

    }

}
