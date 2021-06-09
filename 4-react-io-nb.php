<?php

use React\EventLoop\Factory;
use React\Stream\DuplexResourceStream;
use React\Stream\ReadableResourceStream;

require_once 'vendor/autoload.php';

$loop = Factory::create();

$streamList = [
    new ReadableResourceStream(stream_socket_client('tcp://localhost:8001'), $loop), // Socker Server
    new ReadableResourceStream(fopen('2-file1.txt', 'r'), $loop),
    new ReadableResourceStream(fopen('2-file2.txt', 'r'), $loop)
];

$http = new DuplexResourceStream(stream_socket_client('tcp://localhost:8000'), $loop); // Http Server
$http->write('GET /http-server.php HTTP/1.1' . "\r\n\r\n");
$http->on('data', function (string $data) {
    // Jump HTTP headers, if is a HTTP stream
    $endHTTPHeadersPosition = strpos($data, "\r\n\r\n");
    echo substr($data, $endHTTPHeadersPosition + 4); // 4 =  \r\n\r\n

});

foreach ($streamList as $readableStream) {
    $readableStream->on('data', function (string $data) {
        echo $data . PHP_EOL;
    });
}


$loop->run();
