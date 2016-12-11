<?php

namespace App\Data;

class SQLRepo implements IRepository
{
    private $con;

    public function __construct(){
        $this->con =  mysqli_connect(getenv('DB_IP'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'), getenv('DB_PORT'));
    }

    public function getAlColors()
    {
        $stmt = $this->con->prepare("Select * from color");
        $stmt->execute();
        $stmt->bind_result($id, $colorName);

        $content = [];
        while ($stmt->fetch()){
           array_push($content, $colorName);
        }

        $stmt->close();
        $this->con->close();

        return $content;
    }

    public function getColorById($id)
    {
        $stmt = $this->con->prepare("Select * from color where id = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $stmt->bind_result($id, $colorName);

        $color = null;
        while ($stmt->fetch()){
            $color = $colorName;
        }

        $stmt->close();
        $this->con->close();

        return $color;
    }

    public function createColor($color){
        $stmt = $this->con->prepare("INSERT INTO color (color_name) VALUES(?)");
        $stmt->bind_param("s", $color['color_name']);
        $stmt->execute();

        return $color;
    }
}