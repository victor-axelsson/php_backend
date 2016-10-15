<?php

    function getConnector(){
        return mysqli_connect('127.0.0.1', 'root', 'root', 'color_db', 8889);
    }

    function execute($cmd){
        $con = getConnector();

        $result = mysqli_query($con, $cmd);

        if ($result === false) {
            printf("error: %s\n", mysqli_error($con));
        }

        mysqli_close($con);
        return $result;
    }
