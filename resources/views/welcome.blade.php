<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Video Cookodel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="/css/video-js.min.css" rel="stylesheet">
    <script src="/js/video.min.js"></script>
    <script src="/js/videojs-http-streaming.min.js"></script>
    <script src="/js/videojs-contrib-quality-levels.min.js"></script>
    <script src="/js/videojs-hls-quality-selector.min.js"></script>

    <style>
        body {
            margin: 0;
        }

        .container {
            margin: 20px auto;
            width: 600px;
        }

        video {
            width: 100%;
        }
    </style>
</head>
<body>

<video-js id=vid1 class="vjs-default-skin"
          style="width: 100vw;height: 100vh;"
          poster="<?php echo url('/'); ?>/img/big_logo.jpg"
          controls crossorigin playsinline>
    <source src="<?=$utl_stream?>" type="application/x-mpegURL">
</video-js>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let player = videojs('vid1', {
            playbackRates: [0.5, 1, 1.5, 2],
        });
        player.hlsQualitySelector({
            displayCurrentQuality: true,
        });
    });
</script>

</body>
</html>
