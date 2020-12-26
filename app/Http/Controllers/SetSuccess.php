<?php

namespace App\Http\Controllers;

use Config;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;

class SetSuccess extends Controller
{
    public function show(string $hash_email, string $video_name): string
    {
        \App\Movie::where('name', '=', $video_name)->firstOrFail();
        $video_name = $this->matchVideo($video_name);
        $arHashAdminEmail = Config::get('hash-admin-email');
        $isAccess = true;
        if (!in_array($hash_email, $arHashAdminEmail)) {
            $getVisitor = \App\Visitor::where('email_hash', '=', $hash_email)->firstOrFail();
            $isAccess = $getVisitor->movies()->where('name', '=', $video_name)->firstOrFail();
        }

        $signURL = URL::temporarySignedRoute(
            'watchStream',
            now()->addHour(),
            [
                'email_hash' => $hash_email,
                'section'    => $video_name,
            ]
        );
        return $isAccess ? json_encode($signURL) : '';
    }

    public function destroy(Request $request): string
    {
        $getVisitor = \App\Visitor::where('email_hash', '=', md5($request['email']))->firstOrFail();
        $getMovies = \App\Movie::where('name', '=', $request['movie'])->firstOrFail();;
        $getVisitor->movies()->detach($getMovies);
        return response(null, 204);
    }

    private function matchVideo(string $name): string
    {
        $array = [
            'master-klass-syrnye-konfety' => 'syrnye-konfety-ot-larisy-baranihinoj'
        ];
        return $array[$name] ?? $name;
    }
}
