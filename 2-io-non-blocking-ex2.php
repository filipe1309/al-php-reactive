<?php

$listaDeStreamsDeArquivos = [
    fopen('2-file1.txt', 'r'),
    fopen('2-file2.txt', 'r'),
    fopen('2-file3.txt', 'r'),
    fopen('2-file4.txt', 'r'),
    fopen('2-file5.txt', 'r'),
];

foreach ($listaDeStreamsDeArquivos as $streamDeArquivo) {
    stream_set_blocking($streamDeArquivo, false);
}

do {
    $streamsParaLer = $listaDeStreamsDeArquivos;
    $streamsComNovidades = stream_select($streamsParaLer, $write, $except, 1, 0);

    if ($streamsComNovidades === false) {
        echo 'Error';
        exit(1);
    }

    if ($streamsComNovidades === 0) {
        echo 'Do some async tasks here =)' . PHP_EOL;
        continue;
    }

    foreach ($streamsParaLer as $indice => $streamDeArquivo) {
        $conteudo = stream_get_contents($streamDeArquivo);
        echo $conteudo . PHP_EOL;
        // processa o conteúdo do arquivo
        if (feof($streamDeArquivo)) {
            fclose($streamDeArquivo);
            unset($listaDeStreamsDeArquivos[$indice]);
        }
    }
} while ($listaDeStreamsDeArquivos !== []);
