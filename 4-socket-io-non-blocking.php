<?php

$streamList = [
    stream_socket_client('tcp://localhost:8001'),
    fopen('2-file1.txt', 'r'),
    fopen('2-file2.txt', 'r')
];

foreach ($streamList as $stream) {
    stream_set_blocking($stream, false);
}

do {
    $copyReadStream = $streamList;
    $numberOfChangedStreams = stream_select($copyReadStream, $write, $except, 0, 0);

    // To avoid CPU high usage
    if ($numberOfChangedStreams === 0) {
        // echo 'Do some async tasks here =)' . PHP_EOL;
        continue;
    }

    foreach ($copyReadStream as $key => $stream) {
        $content = stream_get_contents($stream);
        echo $content;
        unset($streamList[$key]);
    }
} while (!empty($streamList));

echo 'Read All Streams =)' . PHP_EOL;
