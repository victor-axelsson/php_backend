<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);

    include_once 'connector.php';

    if(isset($_GET['action'])){
        if(function_exists($_GET['action'])){
            call_user_func($_GET['action']);
        }
    }

    function getAllColors(){
        $con = getConnector();

        $stmt = $con->prepare("Select * from color");
        $stmt->execute();
        $stmt->bind_result($id, $colorName);

        while ($stmt->fetch()){
            echo $id ."<br>";
            echo $colorName ."<br><br>";
        }

        $stmt->close();
        $con->close();
    }
