<?php

namespace src\controllers;
abstract class AbstractController
{
    protected function redirectTo($route){
        header("location: $route");
    }
}
