<?php

namespace Shturmavik;

if (!class_exists('managerByVideos')) {
    class managerByVideos
    {
        protected static $video;
        protected static $email;
        protected static $action;
        protected static $url;

        public function __construct($video, $email, $action = '')
        {
            self::$video = $video;
            self::$email = $email;
            self::$action = $action;
        }

        public function cURL()
        {
            //получить видео на просмотр
            if (self::$action === 'CHECK') {
                self::$url = md5(self::$email) . '/' . self::$video;
            }

            $queryUrl = 'https://stream.cookodel.ru/api/' . self::$url;

            $arCurlArray = [
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST           => self::$action === 'CHECK' ? 0 : 1,
                CURLOPT_HEADER         => 0,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL            => $queryUrl,
            ];

            if (self::$action === 'DELETE') {
                $arCurlArray[CURLOPT_CUSTOMREQUEST] = self::$action;
            }

            if (self::$action !== 'CHECK') {
                $queryData = http_build_query(
                    [
                        'movie' => self::$video,
                        'email' => self::$email,
                    ]
                );
                $arCurlArray[CURLOPT_POSTFIELDS] = $queryData;
            }

            $curl = curl_init();
            curl_setopt_array(
                $curl, $arCurlArray
            );
            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }
    }
}



$obj = new managerByVideos('secrets-of-candies', 'shturmavik@mail.ru', 'DELETE');
$result = $obj->cURL();
print_r($result);
