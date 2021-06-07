<?php

$streamList = [
    fopen('2-file1.txt', 'r'),
    fopen('2-file2.txt', 'r')
];

foreach ($streamList as $stram) {
    stream_set_blocking($stram, false);
}

echo fgets($streamList[0]);
