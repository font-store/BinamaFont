<?php
 $config = require('config.php');

function getItemCountPaymented()
{
    global $config;
    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.payping.ir/v1/permalink/".$config['paypingCode']."/BuyersListCount",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array("accept: application/json", "authorization: Bearer ".$config['token'], "cache-control: no-cache"),
            ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    $http_code = curl_getinfo($curl);
    $http_code= $http_code['http_code'];
    //  print_r([$http_code,$err,$response]);
    curl_close($curl);
    if ($err) {
        die("cURL Error: " . $err);
    }

    if($http_code !== 200){
        die("Error: get response ".$http_code);
    }

    if (empty($response)) {
        die("Error: Can not fetch count payments");
    }

    $s = json_decode($response);
    $s = $s->count;
    return $s;
}


function getItemListPaymented($offset = 0, $limit = 50)
{
    global $config;
    $url = "https://api.payping.ir/v1/permalink/".$config['paypingCode']."/BuyersList?offset=".$offset."&limit=".$limit;
    echo "Start Featching : {$offset}=>{$limit}: ".$url.PHP_EOL;

    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array("accept: application/json", "authorization: Bearer ".$config['token'], "cache-control: no-cache"),
        ));

$response = curl_exec($curl);
    $err = curl_error($curl);
    $http_code = curl_getinfo($curl);
    $http_code= $http_code['http_code'];
    // print_r([$http_code,$err,$response]);
    curl_close($curl);
    if ($err) {
        die("cURL Error: " . $err);
    }

    if($http_code !== 200){
        die("Error: get response ".$http_code);
    }

    if (empty($response)) {
        die("Error: Can not fetch count payments");
    }
   

    $s= json_decode($response);
    return $s;
}




$total = getItemCountPaymented();
print_r($total.PHP_EOL);

$res = [];
for($i = 0; $i <= $total; $i=$i+50){
$list =  getItemListPaymented($i);
$res= array_merge( $res,$list);
}
print_r(count($res));

file_put_contents($config['AllDonates'], json_encode($res,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) );
