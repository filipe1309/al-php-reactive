<?php

$streamList = [
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
        echo 'Do some async tasks here =)' . PHP_EOL;
        continue;
    }

    foreach ($copyReadStream as $key => $stream) {
        echo fgets($stream);
        unset($streamList[$key]);
    }
} while (!empty($streamList));

echo 'Read All Files =)' . PHP_EOL;
