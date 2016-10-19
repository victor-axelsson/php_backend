<?php


class DatabaseInterface
{
    private $con;

    public function __construct(){
        $this->con =  mysqli_connect(getenv('DB_IP'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'), getenv('DB_PORT'));
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