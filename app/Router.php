<?php

/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-28
 * Time: 23:32
 */

namespace App;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Router
{
    private static $getRoutes = [
        'color' =>[
            'middleware' => [],
            'callable' => 'ColorController@getAllColors'
        ],
        'color/{id}' => [
            'middleware' => [],
            'callable' => 'ColorController@getColorById'
        ]
    ];

    private static $postRoutes = [
        'color' =>[
            'middleware' => [
                'App\\Middleware\\NameValidation'
            ],
            'callable' => 'ColorController@createColor'
        ]
    ];

    /**
     * @author Victor Axelsson
     * @param $route array The flat array to be mapped
     * @param $tree array The subtree that will get recursively built
     * This will recursively create a nested array from a flat array
     * @return array The flat array as a tree
     */
    private static function asTree($route, &$tree = []){

        if(count($route) > 0){

            $tree[$route[0]] = self::asTree(array_slice($route, 1));
        }

        return $tree;
    }

    /**
     * @author Victor Axelsson
     * @param $routes array Array of all the reoutes we are going to build from
     * This will get all the defined routes and build a tree from it
     * @return array All the specified routes a tree
     */
    private static function getRouteTree($routes){
        $tree = [];
        foreach ($routes as $url => $route){

            $subtree = self::asTree(explode('/', $url));
            $tree = array_merge_recursive($tree, $subtree);

        }

        return $tree;
    }

    /**
     * @author Victor Axelsson
     * @param $tree array A subtree of the route tree
     * @param $parts array The part of the given url that we are mapping
     * @param $variables array The variables accumulator that will keep all the values given in the url
     * @param $acc string The accumulated mapped route string we are going to use as a key from the routes array
     * This will map between a given url and a route. It will accumulated the variables and url parts
     * @return string The key to the mapped route
     */
    private static function getRoute(&$tree, $parts, &$variables = [], $acc = ""){


        if(count($parts) > 0 && array_key_exists($parts[0], $tree)){

            $acc .= "/" .$parts[0];
            $acc = self::getRoute($tree[$parts[0]], array_slice($parts, 1), $variables, $acc);

        }else if(count($parts) > 0){

            foreach ($tree as $key => $val){

                // We hit a variable
                if(preg_match('/\{(.*?)(:.*?)?(\{[0-9,]+\})?\}/', $key)){
                    $acc .= "/" .$key;
                    array_push($variables, $parts[0]);
                    $acc = self::getRoute($tree[$key], array_slice($parts, 1), $variables, $acc);
                }
            }

        }else{
            //Base case, remove the first slash
            $acc = ltrim($acc, '/');
        }

        return $acc;
    }

    /**
     * @author Victor Axelsson
     * @param $url array The route
     * This will route from url to an endpoint
     */
    public static function route(RequestInterface $request, ResponseInterface $response){

        $url = explode('/', $request->getUri());

        $routes = [];
        if($request->getMethod() === "GET"){
            $routes = self::$getRoutes;
        }else if($request->getMethod() === "POST"){
            $routes = self::$postRoutes;
        }


        $variables = [];
        $tree = self::getRouteTree($routes);

        $routeKey = self::getRoute($tree, $url, $variables);

        if(array_key_exists($routeKey, $routes)){
            $route = $routes[$routeKey];
            $parts = explode('@', $route['callable']);

            $contoller = "App\\Controllers\\" .$parts[0];

            if(class_exists($contoller)){

                self::runMiddleware($route['middleware'], 0, $request, $response, function() use($contoller, $parts, $request, $response, $variables){
                    $ds = new $contoller;
                    call_user_func_array(array($ds, $parts[1]), [$request, $response, $variables]);
                });

            }else{
                echo "\n \n Not found";
            }

        }else{
            var_dump("No such route");
        }

    }

    private static function runMiddleware($callables, $counter, $request, $response, $callback){
        if($counter < count($callables)){
            $middleware = new $callables[$counter];
            $middleware($request, $response, function() use($callables, $counter, $request, $response, $callback){
                self::runMiddleware($callables, $counter + 1, $request, $response, $callback);
            });
        }else{
            $callback();
        }
    }
}