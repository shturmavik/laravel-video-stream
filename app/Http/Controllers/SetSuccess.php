<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;

class SetSuccess extends Controller
{
    public function show($email_hash, $video_name)
    {
        $getVisitor = \App\Visitor::where('email_hash', '=', $email_hash)->firstOrFail();
        $videoName = $this->matchVideo($video_name);
        $isAccess = $getVisitor->movies()
            ->where('name', '=', $videoName)->firstOrFail();

        $url = URL::temporarySignedRoute(
            'watchStream',
            now()->addHour(),
            [
                'email_hash' => $email_hash,
                'section'    => $videoName,
            ]
        );
        return $isAccess ? json_encode($url) : false;
    }

    public function destroy(Request $request)
    {
        $getVisitor = \App\Visitor::where('email_hash', '=', md5($request->email))->firstOrFail();
        $getMovies = \App\Movie::where('name', '=', $request->movie)->firstOrFail();;
        $getVisitor->movies()->detach($getMovies);
        return true;
    }

    private function matchVideo($name)
    {
        $array = [
            'master-klass-syrnye-konfety' => 'syrnye-konfety-ot-larisy-baranihinoj'
        ];

        return $array[$name] ?? $name;
    }
}
