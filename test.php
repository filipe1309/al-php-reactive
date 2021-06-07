<?php

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;

require_once 'vendor/autoload.php';

$client = new Client();

// Sync

// $response1 = $client->get('http://localhost:8080/http-server.php');
// $response2 = $client->get('http://localhost:8000/http-server.php');

// echo 'Response 1: ' . $response1->getBody()->getContents();
// echo 'Response 2: ' . $response2->getBody()->getContents();


// Async

$promess1 = $client->getAsync('http://localhost:8080/http-server.php');
$promess2 = $client->getAsync('http://localhost:8000/http-server.php');

$awnsers = Utils::unwrap([
    $promess1,
    $promess2
]);


echo 'Response 1: ' . $awnsers[0]->getBody()->getContents();
echo 'Response 2: ' . $awnsers[1]->getBody()->getContents();
