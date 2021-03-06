<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Streaming\FFMpeg;

class ProcessVideoRender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected static $document_root = '/usr/share/nginx/html';
    private $section;
    public $timeout = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($section)
    {
        $this->section = $section;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $config = [
            'ffmpeg.binaries'  => '/home/admin/bin/ffmpeg',
//            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
//            'ffprobe.binaries' => '/home/admin/bin/ffprobe',
//            'ffmpeg.binaries'  => '/usr/local/bin/ffmpeg',
//            'ffprobe.binaries' => '/usr/local/bin/ffprobe',
            'timeout'          => 86400, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFmpeg should use
        ];

        $log = new Logger('FFmpeg_Streaming');
        $log->pushHandler(
            new StreamHandler(self::$document_root . '/storage/logs/ffmpeg-streaming.log')
        );

        $ffmpeg = FFMpeg::create($config, $log);
        $video = $ffmpeg->open(self::$document_root . '/storage/app/public/uploads/' . $this->section . '/video.mp4');

        $save_to = self::$document_root . '/storage/key_dir/' . $this->section . '/random_key.key';
        $url = url('/') . '/key_dir/' . $this->section . '/random_key.key';

        $video->HLS()
            ->encryption($save_to, $url)
            ->X264()
            ->autoGenerateRepresentations([1080, 720, 480, 360]) // You can limit the number of representatons
            ->setHlsTime(2)
            ->save();
    }
}
