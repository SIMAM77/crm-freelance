<?php

namespace Controller;

use Helper\Controller;
use Model\ClientModel;
use Model\ProjectModel;

class PageController extends Controller
{

    public function goHome()
    {   
        
        return self::$twig->render('front/home.html.twig');
    }

    /**
     * Homepage for the freelance
     */
    public function goDashbordFree()
    {
        $projects = new ProjectModel();
        $data = $projects->getListProject();

        return self::$twig->render('admin/dashboard.html.twig', array(
            'projects' => $data
        ));
    }
}
