<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);

    include_once '../vendor/autoload.php';

    setupEnv();


    if(isset($_GET['url'])){

        $body = file_get_contents('php://input');

        $request = new \GuzzleHttp\Psr7\ServerRequest($_SERVER['REQUEST_METHOD'], $_GET['url'], getallheaders(), $body);
        $response = new \GuzzleHttp\Psr7\Response();

        App\Router::route($request, $response);
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

