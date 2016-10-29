<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);

    include_once '../vendor/autoload.php';

    setupEnv();


    if(isset($_GET['url'])){
        $route = explode('/', $_GET['url']);

        App\Router::route($route);

        $contoller = "App\\Controllers\\" .$route[0];

        if(class_exists($contoller)){
            $ds = new $contoller;

            $params = array_slice($route, 2);

            call_user_func_array(array($ds, $route[1]), $params);
        }else{
            echo "\n \n Not found";
        }
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

