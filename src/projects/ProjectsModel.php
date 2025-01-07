<?php
namespace Saki\Projects;

class ProjectsModel extends \Saki\Core\SakiModel{

    public function hasSelectedProject():bool{

        $has=false;

        if(isset($_GET['levelb']) && $this->projectExists($_GET['levelb'])){

            $has=true;

        }

        return $has;

    }

    public function getProject(mixed $id):mixed{

        $project=null;

        switch(gettype($id)){

            case "string":

                $query="SELECT * FROM `projects` WHERE projectcode=? OR title=? OR body LIKE ?
                 ORDER BY id ASC LIMIT 1";

                $vals=array($id,$id,"%".$id."%");

                break;
            default:

                $query="SELECT * FROM `projects` WHERE id=?";

                $vals=array($id);
                
                break;

        }

        $st=$this->dbcon->executeQuery($query,$vals);

        while($ro=$st->fetchObject()){

            $project=$ro;

        }

        return $project;

    }

    public function generateProjectCode():string{

        $code=\Saki\Core\StringGenerator::generateCode(12);

        if($this->projectCodeExists($code)){

            $code=$this->generateProjectCode();

        }

        return $code;

    }

    public function addProject(array $vals):bool{

        $code=$this->generateProjectCode();

        $st=$this->dbcon->executeQuery("INSERT INTO `projects`(title,projectcode,body,status) VALUES(?,?,?,?)",
        array($vals['title'],$code,$vals['body'],"open"));

        return $this->projectCodeExists($code);

    }

    public function editProject(array $vals):bool{

        $st=$this->dbcon->executeQuery("UPDATE `projects` SET title=?,body=?,status=? WHERE id=?",
        array($vals['title'],$vals['body'],$vals['status'],$vals['id']));

        $code=$this->getInfo("projects","id",$vals['id'],"projectcode");

        return $this->projectCodeExists($code);

    }

    public function deleteProject(array $vals):bool{

        $this->dbcon->executeQuery("DELETE FROM `tasks` WHERE projectid=?",array($vals['id']));

        $this->dbcon->executeQuery("DELETE FROM `projects` WHERE id=?",array($vals['id']));

        $code=$this->getInfo("projects","id",$vals['id'],"projectcode");

        return !$this->projectCodeExists($code);

    }

    public function getListProjects():array{

        $projects=array();

        $st=$this->dbcon->executeQuery("SELECT id,title,projectcode,status FROM `projects` ORDER BY id ASC",
        array());

        while($ro=$st->fetchObject()){

            $projects[]=$ro;

        }

        return $projects;

    }

    public function getMenuProjects():array{

        $projects=array();

        $st=$this->dbcon->executeQuery("SELECT id,title,projectcode,status FROM `projects`
         WHERE status=? ORDER BY id ASC LIMIT 3",
        array("open"));

        while($ro=$st->fetchObject()){

            $projects[]=$ro;

        }

        return $projects;

    }

    public function countProjectTasks(int $projectid):int{

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `tasks` WHERE projectid=?",
        array($projectid));

        $cn=$st->fetchColumn();

        return intval($cn);

    }

    public function getProjectTasks(int $projectid):array{

        $tasks=array();

        $st=$this->dbcon->executeQuery("SELECT * FROM `tasks` WHERE projectid=? ORDER BY priority ASC",
        array($projectid));

        while($ro=$st->fetchObject()){

            $tasks[]=$ro;

        }

        return $tasks;

    }

    public function moveTask(array $vals):void{

        $this->dbcon->executeQuery("UPDATE `tasks` SET priority=? WHERE id=?",
        array($vals['priority'],$vals['taskid']));

    }

    public function addTask(array $vals):void{

        /**CREATE TABLE `tasks`(
    id INT(30) NOT NULL AUTO_INCREMENT,
    projectid INT(11) NOT NULL,
    task VARCHAR(100) NOT NULL,
    taskbody TEXT,
    priority INT(1) NOT NULL DEFAULT 0,
    iscomplete BOOLEAN NOT NULL DEFAULT false,

    PRIMARY KEY(id),
    FOREIGN KEY(projectid) REFERENCES `projects`(id)
); */

        $this->dbcon->executeQuery("INSERT INTO `tasks`(projectid,task,taskbody,priority) VALUES(?,?,?,?)",
        array($vals['projectid'],$vals['task'],$vals['body'],$vals['priority']));

    }

}
