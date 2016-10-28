<?php

namespace App\Controllers;

class ColorController extends Controller
{

    public function getAllColors(){
        $colors = $this->repo->getAlColors();

        $this->response(200, $colors);
    }

    public function getColorById($id){
        $color = $this->repo->getColorById($id);
        var_dump($color);
    }
}