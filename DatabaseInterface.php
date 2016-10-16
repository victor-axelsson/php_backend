<?php


class DatabaseInterface
{
    private $con;

    public function __construct(){
        $this->con =  mysqli_connect('127.0.0.1', 'root', 'root', 'color_db', 8889);
    }

    public function getAllColors(){
        $stmt = $this->con->prepare("Select * from color");
        $stmt->execute();
        $stmt->bind_result($id, $colorName);

        while ($stmt->fetch()){
            echo $id ."<br>";
            echo $colorName ."<br><br>";
        }

        $stmt->close();
        $this->con->close();
    }

    public function getColorById($id, $name){
        var_dump($name);
        $stmt = $this->con->prepare("Select * from color where id = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $stmt->bind_result($id, $colorName);

        while ($stmt->fetch()){
            echo $id ."<br>";
            echo $colorName ."<br><br>";
        }

        $stmt->close();
        $this->con->close();
    }
}