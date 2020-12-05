<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;

class SetSuccess extends Controller
{
    public function show($email_hash, $video_name)
    {
        $video_name = $this->matchVideo($video_name);
        $visitor = \App\Visitor::where('email_hash', '=', $email_hash)->firstOrFail();
        $is_access = $visitor->movies()
            ->where('name', '=', $video_name)->firstOrFail();

        $url = URL::temporarySignedRoute(
            'watchStream',
            now()->addHour(),
            [
                'email_hash' => $email_hash,
                'section'    => $video_name,
            ]
        );
        return $is_access ? json_encode($url) : false;
    }

    public function destroy(Request $request)
    {
        $visitor = \App\Visitor::where('email_hash', '=', md5($request->email))->firstOrFail();
        $movies = \App\Movie::where('name', '=', $request->movie)->firstOrFail();;
        $visitor->movies()->detach($movies);
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
