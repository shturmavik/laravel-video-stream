<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request): string
    {
        $getMovieByCode = \App\Movie::where('name', '=', $request['movie'])->firstOrFail();
        $processVisitor = \App\Visitor::firstOrCreate(
            [
                'name'       => "''",
                'email'      => $request['email'],
                'email_hash' => md5($request['email']),
            ]
        );
        $processVisitor->movies()->attach($getMovieByCode);
        return response(null, 201);
    }
}
