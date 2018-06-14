<?php
  namespace Controller;

  use \Helper\Controller;
  use \Model\ProjectModel;
  /**
   * Class ProjectsController
   * @package Controller
   */
  class ProjectsController extends Controller
  {
    // private $id = 1;


      public function listProjects()
      {
          $projects = new ProjectModel();
          $data = $projects->getListProject();
          var_dump(__DIR__);
          return self::$twig->render('admin/project/freelance/projectList.html.twig', array(
              'project' => $data
          ));
      }
      public function viewProjectClient(){
          $id = (int) $_GET['id'];

          $project = new ProjectModel();
          $data = $project->getProject($id);
          return self::$twig->render('admin/project/client/clientproject.html.twig', array(
              'project' => $data
          ));
      }

      public function viewProjectFree(){
        $id = (int) $_GET['id'];

        $project = new ProjectModel();
        $data = $project->getProject($id);
        return self::$twig->render('admin/project/freelance/freeproject.html.twig', array(
            'project' => $data
        ));
    }

      public function addProjectClient()
      {
          if(count($_POST) > 0){
            $model = new ProjectModel();
            $data = $model->addProject($_POST);
            $data = $model->getProject($data);
            return self::$twig->render('admin/project/client/addproject.html.twig', array(
                'project' => $data
            ));
          } else {
              return self::$twig->render('admin/project/client/addproject.html.twig');
          }
      }

      public function addProjectFreelance()
      {
          if(count($_POST) > 0){
            $model = new ProjectModel();
            $data = $model->addProject($_POST);
            $data = $model->getProject($data);
            return self::$twig->render('admin/project/freelance/creationprojectfree.html.twig', array(
                'project' => $data
            ));
          } else {
              return self::$twig->render('admin/project/freelance/creationprojectfree.html.twig');
          }
      }
      

  }
