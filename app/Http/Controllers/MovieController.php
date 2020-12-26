<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function store(Request $request): string
    {
        \App\Movie::create(
            [
                'name' => $request['movie'],
            ]
        );
        return response(null, 201);
    }
}
