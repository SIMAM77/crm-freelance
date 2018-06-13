<?php

namespace Controller;

use Helper\Controller;


class InstallController extends Controller
{

    public function installDb()
    {   
        
        

        return self::$twig->render('install/form.html.twig');
    }
}
