<?php
 $config = require('config.php');

 

function getItemCountPaymented()
{
    global $config;
    $curl = curl_init();

    curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.payping.ir/v1/permaLink/".$config['paypingCode']."/BuyersListCount",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Bearer ".$config['token'],
                "cache-control: no-cache",
            ),
            ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    print_r([$err,$response]);
    curl_close($curl);
    if ($err) {
        die("cURL Error #:" . $err);
    }

    if (empty($response)) {
        die("Error: Can not fetch count payments");
    }
 
    $s = json_decode($response);
      // print_r($response);
    return $s->count;
}


function getItemListPaymented($offset = 0, $limit = 50)
{
    global $config;
    $url = "https://api.payping.ir/v1/permaLink/".$config['paypingCode']."/BuyersList?offset=".$offset."&limit=".$limit;
    echo "Start Featching : {$offset}=>{$limit}".PHP_EOL;

    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Bearer ".$config['token'],
                "cache-control: no-cache",
            ),
            ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    // print_r([$err,$response]);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
        //return;
    }
    if (empty($response)) {
        die("Error: Can not fetch count payments");
    }

    $s= json_decode($response);
    return $s;
}



    
     $total = getItemCountPaymented();
      print_r($total);

    $res = [];
    for($i = 0; $i <= $total; $i=$i+50){
        $list =  getItemListPaymented($i);
        $res= array_merge( $res,$list);
    }

   file_put_contents($config['AllDonates'], json_encode($res,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) );
