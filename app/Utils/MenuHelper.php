<?php

namespace App\Utils;

use Illuminate\Support\Facades\Route;

abstract class MenuHelper
{
    public static function isActiveRoute($route, $output = 'active')
    {
        // if (route( $route, $params ) == preg_replace( '/&page=(\d+)/', '', url()->full())) {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }

    public static function areActiveRoutes(array $routes, $output = 'active')
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }
    }
}
