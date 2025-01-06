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

            $exists=$this->model->addProject(
                                array(
                                    "title"=>$params['title'],
                                    "body"=>$params['desc']
                                    )
                                );

            if($exists){

                $ret['status']="project created";

            }
        }

        return $ret;

    }

}
