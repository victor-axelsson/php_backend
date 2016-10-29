<?php

/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-28
 * Time: 23:32
 */

namespace App;

class Router
{

    private static $routes = [
        'color/{id}/by/{name}' =>[
            'middleware' => [],
            'method' => 'get',
            'callable' => 'ColorController@getAllColors'
        ],
        'color/{id}/by/gravy' => [
            'middleware' => [],
            'method' => 'get',
            'callable' => 'ColorController@getAllColors'
        ]
    ];

    /**
     * @author Victor Axelsson
     * @param $route array The flat array to be mapped
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
     * This will get all the definied routes and build a tree from it
     * @return array All the specified routes a tree
     */
    private static function getRouteTree(){
        $tree = [];
        foreach (self::$routes as $url => $route){

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
    public static function route($url){

        $variables = [];
        $tree = self::getRouteTree();

        $routeKey = self::getRoute($tree, $url, $variables);

        if(array_key_exists($routeKey, self::$routes)){
            $route = self::$routes[$routeKey];
        }else{
            var_dump("No such route");
        }

        var_dump($variables);
    }
}