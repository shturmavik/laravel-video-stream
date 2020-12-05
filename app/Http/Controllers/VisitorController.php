<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $visitor = \App\Visitor::firstOrCreate(
            [
                'name' => "''",
                'email' => $request['email'],
                'email_hash' => md5($request['email']),
            ]
        );
        $movies = \App\Movie::where('name', '=', $request['movie'])->firstOrFail();;
        $visitor->movies()->attach($movies);
    }
}
