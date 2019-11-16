<?php

namespace App\Http\Controllers;

use App\Model\ClimbingRoutes;
use Illuminate\Http\Request;

class ClimbingRouteController extends Controller
{
    public function index() {
        $climbingRoute =  ClimbingRoutes::all();
        return response()->json([
           'test'=> $climbingRoute
        ]);
    }
}
