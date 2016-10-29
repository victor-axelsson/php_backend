<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);

    include_once '../vendor/autoload.php';

    setupEnv();


    if(isset($_GET['url'])){
        App\Router::route($_GET['url'], $_SERVER['REQUEST_METHOD']);
    }


    function setupEnv(){
        $handle = fopen("../.env", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {

                putenv(trim($line));
            }

            fclose($handle);
        }
    }

