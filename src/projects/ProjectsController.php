<?php
namespace Saki\Projects;

class ProjectsController extends \Saki\Core\SakiController{

    public function addProject(array $params):mixed{

        $ret=array("errors"=>array(),"status"=>"blank","return"=>null);

        if(isset($params['title']) && isset($params['desc'])){

            $ret['errors']=$this->checkBlanks(array($params['title'],$params['desc']));

        }
        else{

            $ret['errors'][]="missing project data parameters.";

        }

        if(empty($ret['errors'])){

            $newcode=$this->model->addProject(
                                array(
                                    "title"=>$params['title'],
                                    "body"=>$params['desc']
                                    )
                                );

            if(!empty($newcode)){

                $ret['status']="project created";
                $ret['return']=$newcode;

            }
        }

        return $ret;

    }

    public function editProject(array $params):mixed{

        $ret=array("errors"=>array(),"status"=>"blank","return"=>null);

        if(isset($params['title']) && isset($params['desc']) && isset($params['status'])){

            $ret['errors']=$this->checkBlanks(array($params['title'],$params['desc']));

        }
        else{

            $ret['errors'][]="missing project data parameters.";

        }

        if(empty($ret['errors'])){

            $exists=$this->model->editProject(
                                array(
                                    "title"=>$params['title'],
                                    "body"=>$params['desc'],
                                    "status"=>$params['status'],
                                    "id"=>$params['id']
                                    )
                                );

            if($exists){

                $ret['status']="project created";

            }
        }

        return $ret;

    }

    public function deleteProject(array $params):mixed{

        $ret=array("errors"=>array(),"status"=>"blank","return"=>null);

        $exists=$this->model->deleteProject(
                            array(
                                "id"=>$params['id']
                                )
                            );

        if(!$exists){

            $ret['status']="project deleted";

        }

        return $ret;

    }

    public function addTask(array $params):mixed{

        $ret=array("errors"=>array(),"status"=>"blank","return"=>null);

        if(isset($params['task']) && isset($params['desc']) &&
         isset($params['priority']) && isset($params['projectid'])){

            $ret['errors']=$this->checkBlanks(array($params['task'],
                                                $params['desc'],
                                                $params['priority'],
                                                $params['projectid']));

        }
        else{

            $ret['errors'][]="missing task data parameters.";

        }

        if(empty($ret['errors'])){

            $this->model->addTask(
                                    array(
                                        "projectid"=>$params['projectid'],
                                        "task"=>$params['task'],
                                        "body"=>$params['desc'],
                                        "priority"=>$params['priority']
                                    )
                                );

            $ret['status']="task created";

        }

        return $ret;

    }

    public function addNestedTask(array $params):mixed{

        $ret=array("errors"=>array(),"status"=>"blank","return"=>null);

        if(isset($params['task']) && isset($params['desc']) &&
         isset($params['priority']) && isset($params['projectid'])){

            $ret['errors']=$this->checkBlanks(array($params['task'],
                                                $params['desc'],
                                                $params['priority'],
                                                $params['projectid'],
                                                $params['maintask']
                                            ));

        }
        else{

            $ret['errors'][]="missing task data parameters.";

        }

        if(empty($ret['errors'])){

            $this->model->addNestedTask(
                                    array(
                                        "projectid"=>$params['projectid'],
                                        "task"=>$params['task'],
                                        "body"=>$params['desc'],
                                        "priority"=>$params['priority'],
                                        "maintask"=>$params['maintask']
                                    )
                                );

            $ret['status']="task created";

        }

        return $ret;

    }

    public function moveTask(array $params):mixed{

        $ret=array("errors"=>array(),"status"=>"blank","return"=>null);

        $this->model->moveTask(array(
                                "taskid"=>$params['taskid'],
                                "priority"=>$params['priority']
                                ));

        $ret['status']="task moved";

        return $ret;

    }

    public function markTask(array $params):mixed{

        $ret=array("errors"=>array(),"status"=>"blank","return"=>null);

        $changed=$this->model->markTask(array(
                                "taskid"=>$params['taskid'],
                                "iscomplete"=>$params['iscomplete'],
                                "projectid"=>$params['projectid']
                                ));

        $ret['status']=($changed) ? "project changed":"task marked";

        return $ret;

    }

    public function markNestedTask(array $params):mixed{

        return $this->markTask($params);

    }

    public function editTask(array $params):mixed{

        $ret=array("errors"=>array(),"status"=>"blank","return"=>null);

        if(isset($params['task']) && isset($params['desc']) && isset($params['projectid'])){

            $ret['errors']=$this->checkBlanks(array($params['task'],
                                                $params['desc'],
                                                $params['projectid']));

        }
        else{

            $ret['errors'][]="missing task data parameters.";

        }

        if(empty($ret['errors'])){

            $this->model->editTask(
                                    array(
                                        "projectid"=>$params['projectid'],
                                        "task"=>$params['task'],
                                        "body"=>$params['desc'],
                                        "taskid"=>$params['taskid']
                                    )
                                );

            $ret['status']="task updated";

        }

        return $ret;

    }

    public function deleteNestedTask(array $params):mixed{

        return $this->deleteTask($params);

    }

    public function deleteTask(array $params):mixed{

        $ret=array("errors"=>array(),"status"=>"blank","return"=>null);

        $this->model->deleteTask(
                                array(
                                    "projectid"=>$params['projectid'],
                                    "taskid"=>$params['taskid']
                                )
                            );

        $ret['status']="task deleted";

        return $ret;

    }

}
