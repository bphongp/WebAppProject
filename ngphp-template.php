<?php

header('Access-Control-Allow-Origin: http://localhost:4200');//if request coming from this domain then accept

header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
$getdata= $_GET['str'];
$request = json_decode($getdata);
$data =[];
foreach($request as $k=>$v){
    $data[0]['get'.$k] =$v;
}
echo json_encode(['content'=>$data]);


?>