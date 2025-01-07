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

        $st=$this->dbcon->executeQuery("SELECT * FROM `tasks` WHERE projectid=? ORDER BY iscomplete DESC, priority ASC",
        array($projectid));

        while($ro=$st->fetchObject()){

            $tasks[]=$ro;

        }

        return $tasks;

    }

    public function projectHasNestedTasks(int $projectid):bool{

        $tasks=$this->getProjectTasks($projectid);

        $totalNested=0;

        foreach($tasks as $task){

            $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `nestedtasks` WHERE linkedtask=?",
            array($task->id));

            $totalNested+=$st->fetchColumn();

        }

        return intval($totalNested)>0;

    }

    public function getMainProjectTasks(int $projectid):array{

        $tasks=array();

        $hasNested=$this->projectHasNestedTasks($projectid);

        if($hasNested){

            $st=$this->dbcon->executeQuery("SELECT DISTINCT(nestedtasks.maintask) as taskid FROM `nestedtasks`
             INNER JOIN `tasks`
              ON tasks.projectid=nestedtasks.maintask WHERE tasks.projectid=?
              ORDER BY tasks.iscomplete DESC, tasks.priority ASC",array($projectid));

              while($ro=$st->fetchObject()){

                    $tasks[]=$this->getTask($ro->taskid);

              }

        }
        else{

            $tasks=$this->getProjectTasks($projectid);

        }
        
        return $tasks;

    }

    public function getNestedTasks(int $taskid):array{

        $tasks=array();

        $st=$this->dbcon->executeQuery("SELECT nestedtasks.linkedtask FROM `nestedtasks`
        INNER JOIN `tasks` ON tasks.id=nestedtasks.linkedtask
        WHERE nestedtasks.maintask=?
        ORDER BY tasks.iscomplete DESC, tasks.priority ASC",array($taskid));

        while($ro=$st->fetchObject()){

            $tasks[]=$this->getTask($ro->linkedtask);

        }

        return $tasks;

    }

    public function moveTask(array $vals):void{

        $this->dbcon->executeQuery("UPDATE `tasks` SET priority=? WHERE id=?",
        array($vals['priority'],$vals['taskid']));

    }

    public function markTask(array $vals):bool{

        $this->dbcon->executeQuery("UPDATE `tasks` SET iscomplete=? WHERE id=?",
        array($vals['iscomplete'],$vals['taskid']));

        $projectStatusChanged=false;

        if($vals['iscomplete']==true){

            $rate=$this->getProjectCompletionRate($vals['projectid']);

            $status=$this->getInfo("projects","id",$vals['projectid'],"status");

            if($rate==100 && $status=="open"){

                $this->dbcon->executeQuery("UPDATE `projects` SET status=? WHERE id=?",
                array("completed",$vals['projectid']));

                $projectStatusChanged=true;

            }

        }

        if($vals['iscomplete']==false){

            $rate=$this->getProjectCompletionRate($vals['projectid']);

            $status=$this->getInfo("projects","id",$vals['projectid'],"status");

            if($rate<100 && $status!="open"){

                $this->dbcon->executeQuery("UPDATE `projects` SET status=? WHERE id=?",
                array("open",$vals['projectid']));

                $projectStatusChanged=true;

            }

        }

        return $projectStatusChanged;

    }

    public function addTask(array $vals):void{

        $this->dbcon->executeQuery("INSERT INTO `tasks`(projectid,task,taskbody,priority) VALUES(?,?,?,?)",
        array($vals['projectid'],$vals['task'],$vals['body'],$vals['priority']));

    }

    public function editTask(array $vals):void{

        $this->dbcon->executeQuery("UPDATE `tasks` SET task=?,taskbody=? WHERE id=?",
        array($vals['task'],$vals['body'],$vals['taskid']));

    }

    public function getProjectCompletionRate(int $projectid):float{

        $rate=0;

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `tasks` WHERE projectid=? AND iscomplete=?",array($projectid,true));

        $completed=$st->fetchColumn();

        $total=$this->countProjectTasks($projectid);

        if($total!=0){

            $rate=($completed/$total)*100;

        }

        return $rate;

    }

}
