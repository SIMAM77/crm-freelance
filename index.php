<?php
session_start();

ini_set('display_errors', 1);

require_once "vendor/autoload.php";
use \Controller\FrontController;

$ctrl = new FrontController();
