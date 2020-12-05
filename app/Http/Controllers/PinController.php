<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use \Illuminate\Support\Facades\URL;

class PinController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->pin === Config::get('settings.PIN')) {
            $section = str_replace('/', '', $request->cookie('section'));
            $url = URL::temporarySignedRoute
            (
                'watchStream',
                now()->addSecond(),
                [
                    'section' => $section
                ]
            );

            return redirect($url)->withCookie(
                'access',
                'pass',
                1,
                $request->cookie('section'),
                request()->getHost(),
                true,
                false
            );
        }
        return redirect(route('pin.create'));
    }
}
