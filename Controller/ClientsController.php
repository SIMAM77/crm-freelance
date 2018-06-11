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
        return self::$twig->render('admin/clients.html.twig');
    }
}
