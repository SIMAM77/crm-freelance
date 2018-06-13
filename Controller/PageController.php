<?php

namespace Controller;

use Helper\Controller;
use Model\ClientModel;

class PageController extends Controller
{

    public function goHome()
    {   

        $clients = new ClientModel();
        $data = $clients->getAllClients();

        return self::$twig->render('front/home.html.twig', array('clients' => $data));
    }

    public function goBack()
    {
        return self::$twig->render('admin/dashboard.html.twig');
    }
}
