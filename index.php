<?php
session_start();

ini_set('display_errors', 1);

require_once "config/config.php";
require_once "vendor/autoload.php";
require_once "init_log.php";
use \Controller\FrontController;

$ctrl = new FrontController();



$logger->addInfo('Connexion', array(
    'User' => $user,
    'Nom' => $nom,
    'Prénom' => $prenom,
));