<?php

$label = $_GET["label"];
$keyword = $_GET["keyword"];
$api = "";

switch($label){
	case 0:
	default:
		break;
	case 1:
		$api = "name";
		break;
	case 2:
		$api = "capital";
		break;
	case 3:
		$api = "currency";
		break;
	case 4:
		$api = "region";
		break;
}

header('Content-Type: application/json');

if($api != ""){
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://restcountries-v1.p.rapidapi.com/".$api."/".$keyword,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"x-rapidapi-host: restcountries-v1.p.rapidapi.com",
			"x-rapidapi-key: 06cba7f53amshf379946858e53ecp179e48jsnd90d3958684d"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$r = array("status"=>500, "message"=>"cURL error: ".$err);
		echo json_encode(json_encode($r));
	} else {
		echo json_encode($response);
	}
}else{
	$r = array("status"=>400, "message"=>"Bad Request");
	echo json_encode(json_encode($r));
}