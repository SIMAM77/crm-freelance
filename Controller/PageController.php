<?php

namespace Controller;

use Helper\Controller;


class PageController extends Controller
{

    public function goHome()
    {   
        return self::$twig->render('front/home.html.twig');
    }

    public function goBack()
    {
        var_dump('ij');
        die();
        return self::$twig->render('admin/dashboard.html.twig');
    }
}
