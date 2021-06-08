<?php

echo "Socket Server running" . PHP_EOL;

$socket = stream_socket_server('tcp://localhost:8001');

$conn = stream_socket_accept($socket);

$wait = sleep(rand(1, 5));

fwrite($conn, "Socket Server Response after $wait seconds");
