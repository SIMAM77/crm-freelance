<?php

namespace Controller;

use Helper\Controller;
use Model\ClientModel;

class PageController extends Controller
{

    public function userLogin () {
        $msg = '';

        $users = [
            "1" => [
                "username" => "admin",
                "password" => "admin"
            ],
            "2" => [
                "username" => "toto",
                "password" =>"admin"
            ],
            "3" => [
                "username" => "tata",
                "password" => "admin"
            ]
        ];
        
        $_SESSION['valid'] = false;
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            foreach($users as $user){
                if($_POST['username'] == $user['username'] &&  $_POST['password'] == $user['password']){
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = $user['username'];
                    return self::goHome();
                }
            }
            
            if($_SESSION['valid'] == false){
                $msg = 'Wrong username or password';
                // return self::$twig->render('front/login.html.twig');
                return self::$twig->render('front/login.html.twig', array('message' => 'identifiant ou mot de passe incorrect'));
            }
        } else {
            return self::$twig->render('front/login.html.twig');
        }
    }

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
