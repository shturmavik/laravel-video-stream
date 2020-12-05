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
 * php artisan queue:work --timeout=86400
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
use App\Jobs\ProcessVideoRender;
use Illuminate\Http\Request;

class StreamFFmpeg extends Controller
{
    public function create($section)
    {
        dispatch(new \App\Jobs\ProcessVideoRender($section));
//        ProcessVideoRender::dispatch($section);
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

/*
nohup /home/admin/bin/ffmpeg -y -i /usr/share/nginx/html/storage/app/public/uploads/video-urok-skazka-v-dome-ot-etno-pryanik/video.mp4 -c:v libx264 -s:v 640x360 -crf 20 -sc_threshold 0 -g 48 -keyint_min 48 -hls_list_size 0 -hls_time 2 -hls_allow_cache 1 -b:v 287k -maxrate 344k -hls_segment_type mpegts -hls_fmp4_init_filename video_init.mp4 -hls_segment_filename /usr/share/nginx/html/storage/app/public/uploads/video-urok-skazka-v-dome-ot-etno-pryanik/video_360p_%04d.ts -strict -2 /usr/share/nginx/html/storage/app/public/uploads/video-urok-skazka-v-dome-ot-etno-pryanik/video_360p.m3u8 -c:v libx264 -s:v 854x480 -crf 20 -sc_threshold 0 -g 48 -keyint_min 48 -hls_list_size 0 -hls_time 2 -hls_allow_cache 1 -b:v 359k -maxrate 430k -hls_segment_type mpegts -hls_fmp4_init_filename video_init.mp4 -hls_segment_filename /usr/share/nginx/html/storage/app/public/uploads/video-urok-skazka-v-dome-ot-etno-pryanik/video_480p_%04d.ts -strict -2 /usr/share/nginx/html/storage/app/public/uploads/video-urok-skazka-v-dome-ot-etno-pryanik/video_480p.m3u8 -c:v libx264 -s:v 1280x720 -crf 20 -sc_threshold 0 -g 48 -keyint_min 48 -hls_list_size 0 -hls_time 2 -hls_allow_cache 1 -b:v 479k -maxrate 574k -hls_segment_type mpegts -hls_fmp4_init_filename video_init.mp4 -hls_segment_filename /usr/share/nginx/html/storage/app/public/uploads/video-urok-skazka-v-dome-ot-etno-pryanik/video_720p_%04d.ts -strict -2 /usr/share/nginx/html/storage/app/public/uploads/video-urok-skazka-v-dome-ot-etno-pryanik/video_720p.m3u8 -c:v libx264 -s:v 1920x1080 -crf 20 -sc_threshold 0 -g 48 -keyint_min 48 -hls_list_size 0 -hls_time 2 -hls_allow_cache 1 -b:v 719k -maxrate 862k -hls_segment_type mpegts -hls_fmp4_init_filename video_init.mp4 -hls_segment_filename /usr/share/nginx/html/storage/app/public/uploads/video-urok-skazka-v-dome-ot-etno-pryanik/video_1080p_%04d.ts -strict -2 -threads 12 /usr/share/nginx/html/storage/app/public/uploads/video-urok-skazka-v-dome-ot-etno-pryanik/video_1080p.m3u8 &
*/
