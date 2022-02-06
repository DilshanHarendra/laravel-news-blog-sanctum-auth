<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $response = array([
            "message"=>"hello world"
        ]);
        return response($response,200);
    }
}
