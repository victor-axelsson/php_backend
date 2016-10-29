<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;

class ColorController extends Controller
{

    public function getAllColors(RequestInterface $request){


        $colors = $this->repo->getAlColors();
        $this->response(200, $colors);
    }

    public function getColorById(RequestInterface $request, $id){

        var_dump($id);

        $color = $this->repo->getColorById($id);

        $this->response(200, [
            'color' => $color
        ]);
    }
}