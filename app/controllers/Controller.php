<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-28
 * Time: 17:53
 */

namespace App\Controllers;

use App\Data\SQLRepo;

abstract class Controller
{
    protected $repo;

    public function __construct(){
        $this->repo = new SQLRepo();
    }

    protected function response($code, $msg){
        http_response_code($code);
        echo json_encode($msg);
    }
}