<?php

include_once '../models/connect_db.php';
include_once './sessionController.php';
include_once '../models/connect_db.php';

$inputSearch = $_POST['search'];

$url = 'https://api.mercadolibre.com/sites/MLB/search?q=' . "$inputSearch";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

http_response_code(200);

$output = curl_exec($ch);

curl_close($ch);


$data = json_decode($output, true);


include '../view/producstResultApi.php';