<?php
// Install
// sudo apt-get install mysql-server
// sudo apt-get install php-fpm
// sudo apt-get install php-mysql
// sudo apt-get install php-curl
// WIthout these packages functionality isnt guarunteed
function perform_Calculation($like1, $like2) {
// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://indra.lambda3.org/relatedness');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\t\"corpus\": \"googlenews\",\n\t\"model\": \"W2V\",\n\t\"language\": \"EN\",\n\t\"scoreFunction\": \"COSINE\",\n\t\"pairs\": [{\n\t\t\"t2\": \"" . $like1 . "\",\n\t\t\"t1\": \"" . $like2 . "\"\n\t}]\n}");
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

$someArray = json_decode($result, true);
$pairsFromJson = $someArray["pairs"];
$listInPairs = $pairsFromJson[0];
$scoreOfStrings = $listInPairs["score"];

return (double)$scoreOfStrings;
}

//$res1  = perform_Calculation("cake", "desserts");

//echo $res1;

?>
