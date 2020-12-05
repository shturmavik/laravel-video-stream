<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class RandomKey extends Controller
{
    public function get($section)
    {
        return File::get(storage_path('key_dir/' . $section . '/random_key.key'));
    }
}
