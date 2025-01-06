<?php
namespace Saki\Core;

class SakiModel extends ConnectedModel{

    public function projectCodeExists(string $check):bool{

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `projects` WHERE projectcode=?",
        array($check));

        $cn=$st->fetchColumn();

        return intval($cn)>0;

    }

    public function hasProjects():bool{

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `projects`",array());

        $cn=$st->fetchColumn();

        return intval($cn)>0;

    }
    

}
