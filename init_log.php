<?php
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
$dateFormat = "Y-m-d H:i:s";
$output     = "[%datetime%] %channel% %level_name%: %message% %context% %extra%\n";
$formatter  = new LineFormatter($output, $dateFormat);
// $stream     = new StreamHandler(__DIR__.'crm.log', Logger::DEBUG);
$stream     = new RotatingFileHandler(__DIR__.'/Logs/crm.log', Logger::DEBUG);
$stream->setFormatter($formatter);
$logger     = new Logger('login');
$logger->pushHandler($stream);
$user = "admin";
$nom = "black";
$prenom = "jet";