<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;

abstract class Controller
{
    protected function getUser()
    {
        try {
            return JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return null;
        }
    }
}
