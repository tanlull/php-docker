## You can Run PHP via Docker with this command :
```
docker run --restart=always --name tan-php -v c:/tmp/php-code:/var/www/html -d -p 8888:80 richarvey/nginx-php-fpm:latest
```

## Code path in Window just put "index.php" to the folder
```
c:/tmp/php-code
```

## Run with
http://localhost:8888

## Get HTTPs File info with https redirection
```php
function get_remote_file_info($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_NOBODY, TRUE);
 <o>
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 </o> 
    $data = curl_exec($ch);
    $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
    print("<br>filesize = $fileSize");
    $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    print("<br>response code =$httpResponseCode");
    curl_close($ch);
    return [
        'fileExists' => (int) $httpResponseCode == 200,
        'fileSize' => (int) $fileSize
    ];
}

```