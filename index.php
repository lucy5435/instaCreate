<?php
$homepage = file_get_contents('https://api.ipify.org/?format=text');
echo $homepage;



    $url = 'https://api.ipify.org/?format=text';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_INTERFACE, "107.23.139.202");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_NOBODY, 1);

    $curl_scraped_page = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo " other: ".$curl_scraped_page;



?>