<?php

namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-11-21
 * Time: 08:44
 */
class NameValidation extends Middleware
{

    public function __invoke(RequestInterface $request, ResponseInterface $response, $next)
    {
        $body = json_decode($request->getBody(), true);

        if(isset($body['name'])){
            $next();
        }else{
            $this->respond($response->withStatus(400));
        }
    }

}