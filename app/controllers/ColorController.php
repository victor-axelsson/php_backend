<?php

namespace App\Controllers;

use App\Data\DatabaseInterface;

class ColorController extends DatabaseInterface
{

    public function getAllColors(){
        $colors = $this->repo->getAlColors();
        var_dump($colors);
    }

    public function getColorById($id){
        $color = $this->repo->getColorById($id);
        var_dump($color);
    }
}