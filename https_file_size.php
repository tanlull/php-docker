<?php


function get_remote_file_info($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_NOBODY, TRUE);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

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



$url = "https://github.com/tanlull/test_db/raw/master/images/house2.png";

echo "<br>file = $url";

$out = get_remote_file_info($url);

print("<br>");
var_dump($out);
