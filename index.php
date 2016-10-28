<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);

    include_once 'vendor/autoload.php';

    setupEnv();


    if(isset($_GET['action']) && isset($_GET['controller'])){

        $contoller = "App\\Controllers\\" .$_GET['controller'];

        if(class_exists($contoller)){
            $ds = new $contoller;
            $params = $_GET;
            unset($params['controller']);
            unset($params['action']);

            call_user_func_array(array($ds, $_GET['action']), $params);
        }else{
            echo "\n \n Not found";
        }
    }

    function setupEnv(){
        $handle = fopen(".env", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {

                putenv(trim($line));
            }

            fclose($handle);
        }
    }

