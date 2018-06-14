<?php

namespace Controller;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;


/**
 * Class FrontController
 * @package Controller
 */
class FrontController
{

    /**
     * FrontController constructor.
     */
    public function __construct()
    {

        $dateFormat = "Y-m-d H:i:s";
        $output     = "[%datetime%] %channel% %level_name%: %message% %context% %extra%\n";
        $formatter  = new LineFormatter($output, $dateFormat);
        // $stream     = new StreamHandler(__DIR__.'crm.log', Logger::DEBUG);
        $stream     = new RotatingFileHandler(__DIR__.'/logs/crm.log', Logger::DEBUG);
        $stream->setFormatter($formatter);
        $logger     = new Logger('login');
        $logger->pushHandler($stream);
        // $log = new Logger('name');
        // $log->pushHandler(new StreamHandler('config/app.log', Logger::WARNING));
        
        // // add records to the log
        // $log->warning('Foo');
        // $log->error('Bar');

        // router
        $locator = new FileLocator(array(__DIR__));
        $loader = new YamlFileLoader($locator);
        $collection = $loader->load(dirname(__DIR__).'/config/routes.yaml');

        $context = new RequestContext(
            $_SERVER['REQUEST_URI'],
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['HTTP_HOST']
        );
        $matcher = new UrlMatcher($collection, $context);
        $parameters = $matcher->match($_SERVER['REQUEST_URI']);

        // recuperation de la classe et de la methode
        list($routeController, $routeMethod) = explode('::', $parameters['_controller']);

        // test sur la classe
        if (!class_exists($routeController)) {
            throw new \BadFunctionCallException('Router :: Controller inexistant');
        }

        $controller = new $routeController();
        // test sur la methode
        if (!method_exists($controller, $routeMethod)) {
            throw new \BadFunctionCallException('Router :: Methode inexistante');
        }

        // instanciation du controller
        $output = $controller->$routeMethod();
        echo $output;
    }
}
