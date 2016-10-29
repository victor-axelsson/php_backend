<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ColorController extends Controller
{

    public function getAllColors(RequestInterface $request, ResponseInterface $response){

        $colors = $this->repo->getAlColors();
        $this->response(200, $colors);
    }

    public function getColorById(RequestInterface $request, ResponseInterface $response, $id){


        $color = $this->repo->getColorById($id);

        $this->response(200, [
            'color' => $color
        ]);
    }
}