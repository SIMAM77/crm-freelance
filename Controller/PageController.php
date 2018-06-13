<?php

namespace Controller;

use Helper\Controller;
use Model\ClientModel;

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
        return self::$twig->render('admin/dashboard.html.twig');
    }
}
