<?php

namespace Helper;


/**
 * Class Controller
 * Permet de loader nos templates Twig pour tous nos controllers
 * (les classes contenues dans controller en héritant)
 * @package Helper
 */
class Controller
{
    protected static $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(dirname(__DIR__). '/view/');
        self::$twig = new \Twig_Environment(
            $loader, array(
            'cache' => false,
            'debug' => true,
        ));

        self::$twig->addExtension(new \Twig_Extension_Debug());
    }
}