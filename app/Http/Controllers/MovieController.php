<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function store(Request $request)
    {
        \App\Movie::create(
            [
                'name' => $request['movie'],
            ]
        );
    }
}
