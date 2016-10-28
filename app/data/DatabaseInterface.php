<?php

namespace Data;

abstract class DatabaseInterface
{
    protected $repo;

    public function __construct(){
        $this->repo = new SQLRepo();
    }

}