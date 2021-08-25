<?php


class Route
{

    public $routes = [];

    public function set ($route, $function) {

       $this->routes[] = $route;

        if($_GET['url'] == $route)
            $function->__invoke();


    }
}