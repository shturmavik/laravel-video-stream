<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About this project

- Access to video by email hash or token number.
- Each video.mp4 has file *.m3u and many *.ts files for flood.
- Each video render in queue laravel JOB

### MovieController@store:
Add your symbolic name of video (ex.: cooking-salad) to DB
```
curl --location --request POST 'https://your-web-site.ru/api/movie/store' \
--form 'movie="cooking-salad"'
```

### VisitorController@store:
Add visitor (who will watch video)
```
curl --location --request POST 'https://your-web-site.ru/api/visitor/store' \
--form 'email="email-of-visitor@mail.ru"' \
--form 'movie="cooking-salad"'
```

### SetSuccess@destroy:
Detach video from visitor (who watches video)
```
curl --location --request DELETE 'https://your-web-site.ru/api/?email=email-of-visitor@mail.ru&movie=cooking-salad'
```

Put PIN=7264 in your .env file.

Videos put in /storage/app/public/uploads/NAME-SECTIONS/video.mp4
