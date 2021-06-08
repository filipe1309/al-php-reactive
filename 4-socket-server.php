<?php

echo "Socket Server running" . PHP_EOL;

$socket = stream_socket_server('tcp://localhost:8001');

$conn = stream_socket_accept($socket);

$wait = rand(1, 5);
sleep($wait);

fwrite($conn, "Socket Server Response after $wait seconds\n");

fclose($conn);

echo "Socket Server stopped" . PHP_EOL;
