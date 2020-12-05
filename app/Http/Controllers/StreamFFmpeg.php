<?php

/*
 * файл вспомогательный для общей информации
 * https://github.com/aminyazdanpanah/PHP-FFmpeg-video-streaming
 *
 * https://trac.ffmpeg.org/wiki/CompilationGuide/Centos#Updating
 * https://packagist.org/packages/aminyazdanpanah/php-ffmpeg-video-streaming
 * создание m3u:
 * https://github.com/pascalbaljetmedia/laravel-ffmpeg
 *
 * в админке compas
 * https://your-web-site.ru/admin/compass
 * выбрать php artisan queue:work с указанием параметра --timeout=86400
 * и запустить вкладку https://your-web-site.ru/НАЗВАНИЕ РАЗДЕЛА С ВИДЕО/create
 *
 * пример загрузки видео через input:
 * https://quantizd.com/transcoding-videos-using-ffmpeg-and-laravel-queues/
 *
 *
 * для гугл drive комманда
 */
//wget --load-cookies /tmp/cookies.txt "https://docs.google.com/uc?export=download&confirm=$(wget --quiet --save-cookies /tmp/cookies.txt --keep-session-cookies --no-check-certificate 'https://docs.google.com/uc?export=download&id=1FT9bD8l......' -O- | sed -rn 's/.*confirm=([0-9A-Za-z_]+).*/\1\n/p')&id=1FT9bD8lqi4hNAh91J1LKaIrGypRlvnRZ" -O FILENAME.mp4 && rm -rf /tmp/cookies.txt

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Jobs\VideoCreatJob;
use Illuminate\Http\Request;

class StreamFFmpeg extends Controller
{
    public function create($section)
    {
        VideoCreatJob::dispatch($section);
    }

    public function show($section, Request $request)
    {
        $url = Storage::url('uploads/' . $section . '/video.m3u8');
        return view('welcome')
            ->with('utl_stream', $url);
    }
}


/*
 * https://yandex.ru/dev/disk/poligon/#!//v1/disk/public/resources/GetPublicResourceDownloadLink
 * wget "https://downloader.disk.yandex.ru/disk/6330......" -O video.mp4
 */
