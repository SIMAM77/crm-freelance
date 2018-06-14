<?php
namespace Controller;

use \Helper\Controller;
use \Model\ClientModel;
use \Model\ProjectModel;
/**
 * Class ClientsController
 * @package Controller
 */

class ClientsController extends Controller
{
    public function listClients()
    {
        if($_SESSION['valid'] == true){
            $clients = new ClientModel();
            $data = $clients->getListClient();

            return self::$twig->render('admin/client/list.html.twig', array(
                'clients' => $data
            ));
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function viewClient()
    {
        if($_SESSION['valid'] == true){
            $id = (int) $_GET['id'];

            $client = new ClientModel();
            $data = $client->getClient($id);

            $projects = new ProjectModel();
            $projects = $projects->getProjectByUser($id);

            // to do : add calcul to see if birthdaysoon
            $soonBirthday = false;

            return self::$twig->render('admin/client/detail.html.twig', array(
                'client' => $data,
                'soonBirthday' => $soonBirthday,
                'projects' => $projects
            ));
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function addClient()
    {
        if($_SESSION['valid'] == true){
            if(count($_POST) > 0){

                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($_FILES['file']['name'], '.');
                if(!in_array($extension, $extensions)){
                    throw new \Exception('wrong file type');
                }

                $repo = './assets/upload/';
                $file = basename($_FILES['file']['name']);

                $file = strtr($file, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); 
                $file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);

                if(move_uploaded_file($_FILES['file']['tmp_name'], $repo . $file)){
                    // set name in DB
                    $_POST['picture'] = $_FILES["file"]['name'];
                    
                    $model = new ClientModel();
                    $data = $model->addClient($_POST);
                    $data = $model->getClient($data);

                    return self::$twig->render('admin/client/detail.html.twig', array(
                        'client' => $data
                    ));
                }
                else{
                    throw new \Exception('error during upload');
                }
            
            } else {
                
                return self::$twig->render('admin/client/add.html.twig');
            }
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function updateClient()
    {
        if($_SESSION['valid'] == true){
            $id = $_GET['id'];
            $id = (int) $id;
            $model = new ClientModel();

            if(count($_POST) > 0){

                $data = $model->updateClient($_POST, $id);
                $data = $model->getClient($id);

                return self::$twig->render('admin/client/detail.html.twig', array(
                    'client' => $data
                ));
            }  else {

                $data = $model->getClient($id);            
                return self::$twig->render('admin/client/edit.html.twig', array(
                    'client' => $data
                ));
            }
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }
}
