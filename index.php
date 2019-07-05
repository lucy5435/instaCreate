<?php
$homepage = file_get_contents('https://api.ipify.org/?format=text');
echo $homepage;



    $curl_connection = curl_init("https://api.ipify.org/?format=text");
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_connection, CURLOPT_INTERFACE, "107.23.139.202");
    curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 0);
    ob_start();
    $response = curl_exec($curl_connection);
    ob_end_clean();
    $err = curl_error($curl_connection);
    curl_close($curl_connection);
    if ($err) {return "hata";} else {}
    if (strpos($response, 'sorry') !== false OR strpos($response, 'Sorry') !== false){
        return "hata";
    }else{
        echo " curl: ". $response;
    }




?>