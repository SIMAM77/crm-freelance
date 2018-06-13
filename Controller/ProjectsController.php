  <?php
  namespace Controller;
  use \Helper\Controller;
  use \Model\ProjectModel;
  /**
   * Class ProjectController
   * @package Controller
   */
  class ProjectController extends Controller
  {
      public function listProjects()
      {
          $projects = new ProjectModel();
          $data = $projects->getListProject();
          return self::$twig->render('admin/project/project.html.twig', array(
              'projects' => $data
          ));
      }
      public function viewProject(){
          $id = (int) $_GET['id'];
          $projects = new ProjectModel();
          $data = $client->getClient($id);
          return self::$twig->render('admin/project/clientproject.html.twig', array(
              'project' => $data
          ));
      }
      public function addClient()
      {
          if(count($_POST) > 0){
                  $model = new ProjectModel();
                  $data = $model->addProject($_POST);
                  $data = $model->getProject($data);
                  return self::$twig->render('admin/project/detailproject.html.twig', array(
                      'project' => $data
                  ));
          } else {
              return self::$twig->render('admin/project/addproject.html.twig');
          }
      }
  }
