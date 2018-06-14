<?php
namespace Controller;
use \Helper\Controller;
use \Model\ProjectModel;
use \Model\ClientModel;
/**
 * Class ProjectsController
 * @package Controller
 */
class ProjectsController extends Controller
{
      
    public function listProjects()
    {
        if($_SESSION['valid'] == true){
            $projects = new ProjectModel();
            $data = $projects->getListProject();

            return self::$twig->render('admin/project/freelance/projectList.html.twig', array(
                'projects' => $data
            ));
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function viewProjectClient()
    {
        if($_SESSION['valid'] == true){
            $id = (int) $_GET['id'];
            $project = new ProjectModel();
            $data = $project->getProject($id);
            return self::$twig->render('admin/project/client/clientproject.html.twig', array(
                'project' => $data
            ));
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function viewProjectFree()
    {
        if($_SESSION['valid'] == true){
            $id = (int) $_GET['id'];
            $project = new ProjectModel();
            $data = $project->getProject($id);

            $data->milestone = unserialize($data->milestone);

            return self::$twig->render('admin/project/freelance/view.html.twig', array(
                'project' => $data
            ));
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function addProjectFreelance()
    {
        if($_SESSION['valid'] == true){
            $idClient = $_GET['idClient'];
            $idClient = (int) $idClient;

            $client = new ClientModel();
            $client = $client->getClient($idClient);


            if(count($_POST) > 0){
                $model = new ProjectModel();

                $data = $model->addProject($_POST);
                $data = $model->getProject($data);

                return self::$twig->render('admin/project/freelance/view.html.twig', array(
                    'project' => $data
                ));
            } else {
                return self::$twig->render('admin/project/freelance/add-project.html.twig', array('client' => $client));
            }
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function updateProject()
    {
        if($_SESSION['valid'] == true){
            $id = $_GET['id'];
            $id = (int) $id;
            $model = new ProjectModel();

            if(count($_POST) > 0){

                $data = $model->updateProject($_POST, $id);
                $data = $model->getProject($id);

                $data->milestone = unserialize($data->milestone);

                return self::$twig->render('admin/project/freelance/view.html.twig', array(
                    'project' => $data
                ));
            }  else {

                $data = $model->getProject($id);         
                $data->milestone = unserialize($data->milestone);

                return self::$twig->render('admin/project/freelance/update-project.html.twig', array(
                    'project' => $data
                ));
            }
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function archiveProject()
    {
        if($_SESSION['valid'] == true){
            $id = $_GET['id'];
            $id = (int) $id;
            $model = new ProjectModel();
            $model->archieveProject($id);
            
            Header("Location: /projects");
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function reopenProject()
    {
        if($_SESSION['valid'] == true){
            $id = $_GET['id'];
            $id = (int) $id;
            $model = new ProjectModel();
            $model->reopenProject($id);
            
            Header("Location: freelance/project?id=$id");
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function finishProject()
    {
        if($_SESSION['valid'] == true){
            $id = $_GET['id'];
            $id = (int) $id;
            $model = new ProjectModel();
            $model->finishProject($id);
            
            Header("Location: freelance/project?id=$id");
        }  else {
            return self::$twig->render('admin/login.html.twig');
        }
    }
}
