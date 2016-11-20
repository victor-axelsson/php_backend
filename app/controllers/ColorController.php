<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ColorController extends Controller
{

    public function getAllColors(RequestInterface $request, ResponseInterface $response){

        $colors = $this->repo->getAlColors();


        $this->respond(
            $response->withStatus(200)->withBody($this->getAsStream($colors))
        );
    }

    public function getColorById(RequestInterface $request, ResponseInterface $response, $id){

        $color = $this->repo->getColorById($id);


        $this->respond(
            $response->withStatus(200)->withBody($this->getAsStream($color))
        );
    }
}