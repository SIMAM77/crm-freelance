<?php
namespace Controller;
use \Helper\Controller;

use \Model\ClientModel;
/**
 * Class ClientsController
 * @package Controller
 */
class ClientsController extends Controller
{
    public function listClients()
    {
        $clients = new ClientModel();
        $data = $clients->getListClient();

        return self::$twig->render('admin/client/list.html.twig', array(
            'clients' => $data
        ));
    }

    public function viewClient(){
        $id = (int) $_GET['id'];

        $client = new ClientModel();
        $data = $client->getClient($id);

        return self::$twig->render('admin/client/detail.html.twig', array(
            'client' => $data
        ));
    }
}
