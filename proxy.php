<?php
// السماح بالوصول من أي مكان (لحل مشكلة CORS نهائياً)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// استقبال التاريخ
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$url = "https://auziatv.com/matches_api.php?date=" . $date;

// إعدادات الاتصال لتبدو وكأنها متصفح حقيقي (لتجنب الحظر)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

$response = curl_exec($ch);

if(curl_errno($ch)){
    echo json_encode(["error" => curl_error($ch)]);
} else {
    echo $response;
}
curl_close($ch);
?>
