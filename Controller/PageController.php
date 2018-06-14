<?php

namespace Controller;

use Helper\Controller;
use Model\ClientModel;
use Model\ProjectModel;

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
                    return self::goDashbordFree();
                }
            }
            
            if($_SESSION['valid'] == false){
                $msg = 'Wrong username or password';
                // return self::$twig->render('front/login.html.twig');
                return self::$twig->render('admin/login.html.twig', array('message' => 'identifiant ou mot de passe incorrect'));
            }
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }

    public function goHome()
    {   
        
        return self::$twig->render('front/home.html.twig');
    }

    /**
     * Homepage for the freelance
     */
    public function goDashbordFree()
    {

        if($_SESSION['valid'] == true){
            $projects = new ProjectModel();
            $data = $projects->getListProject();

            return self::$twig->render('admin/dashboard.html.twig', array(
                'projects' => $data
            ));
        } else {
            return self::$twig->render('admin/login.html.twig');
        }
    }
}
