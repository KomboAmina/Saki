<?php
namespace Saki\Core;

class SakiModel extends ConnectedModel{

    public function projectCodeExists(string $check):bool{

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `projects` WHERE projectcode=?",
        array($check));

        $cn=$st->fetchColumn();

        return intval($cn)>0;

    }

    public function generateProjectCode():string{

        $code=\Saki\Core\StringGenerator::generateCode(12);

        if($this->projectCodeExists($code)){

            $code=$this->generateProjectCode();

        }

        return $code;

    }

    public function hasProjects():bool{

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `projects`",array());

        $cn=$st->fetchColumn();

        return intval($cn)>0;

    }
    

}
