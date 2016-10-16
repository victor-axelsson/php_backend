<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);

    include_once 'DatabaseInterface.php';

    if(isset($_GET['action']) && isset($_GET['controller'])){
        if(class_exists($_GET['controller'])){

            $ds = new $_GET['controller'];
            $params = $_GET;
            unset($params['controller']);
            unset($params['action']);

            call_user_func_array(array($ds, $_GET['action']), $params);

            //$ds = new $_GET['controller'];
            //$ds->$_GET['action']();
        }
    }

