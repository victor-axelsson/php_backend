<?php

namespace App\Data;

interface IRepository
{
    public function getAlColors();
    public function getColorById($id);
    public function createColor($color);
}