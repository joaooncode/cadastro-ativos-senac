<?php

include_once '../models/connect_db.php';
include_once './sessionController.php';


$search = '';

$url = 'https://api.mercadolibre.com/sites/MLA/search?q=' . "$search";

$ch = curl_setopt($ch, CURLOPT_URL, $url);

http_response_code(200);