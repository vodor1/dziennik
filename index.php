<?php

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

require 'vendor/autoload.php';

    session_start();

    $logger = new Logger('app_logger');

    $file_handler = new StreamHandler( __DIR__ . '/logs/app.log', Level::Info);

    $logger->pushHandler($file_handler);

    $logger->log(Level::Info , "Czy to działa?");


    // LOGOWANIE / SECURITY





    // załadować routes

    include "src/templates/header.php";



    include "src/templates/footer.php";


    // otworzyć główną templates