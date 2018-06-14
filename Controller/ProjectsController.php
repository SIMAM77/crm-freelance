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
        $projects = new ProjectModel();
        $data = $projects->getListProject();

        return self::$twig->render('admin/project/freelance/projectList.html.twig', array(
            'projects' => $data
        ));
    }

    public function viewProjectClient()
    {
        $id = (int) $_GET['id'];
        $project = new ProjectModel();
        $data = $project->getProject($id);
        return self::$twig->render('admin/project/client/clientproject.html.twig', array(
            'project' => $data
        ));
    }

    public function viewProjectFree()
    {
        $id = (int) $_GET['id'];
        $project = new ProjectModel();
        $data = $project->getProject($id);

        $data->milestone = unserialize($data->milestone);

        return self::$twig->render('admin/project/freelance/view.html.twig', array(
            'project' => $data
        ));
    }

    public function addProjectFreelance()
    {
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
    }

    public function updateProject()
    {
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
    }

    public function archiveProject()
    {
        $id = $_GET['id'];
        $id = (int) $id;
        $model = new ProjectModel();
        $model->archieveProject($id);
        
        Header("Location: /projects");
    }

    public function reopenProject()
    {
        $id = $_GET['id'];
        $id = (int) $id;
        $model = new ProjectModel();
        $model->reopenProject($id);
        
        Header("Location: freelance/project?id=$id");
    }

    public function finishProject()
    {
        $id = $_GET['id'];
        $id = (int) $id;
        $model = new ProjectModel();
        $model->finishProject($id);
        
        Header("Location: freelance/project?id=$id");
    }
}
