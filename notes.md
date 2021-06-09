# DevOnTheRun Notes

> notes taken during the course

<!-- https://gitignore.io -->

## CLASS-1

```sh
composer install

php -S localhost:8080
php -S localhost:8000

time php test.php
```

## CLASS-2

https://www.php.net/manual/en/function.stream-select.php

https://dias.dev/2020-09-16-php-assincrono-de-forma-nativa/

https://imasters.com.br/front-end/node-js-o-que-e-esse-event-loop-afinal

## CLASS-3

```sh
php -S localhost:8080
```

http://localhost:8080/http-server.php

```sh
php 4-socket-server.php
telnet localhost 8001
```

## CLASS-4

https://reactphp.org/
https://reactphp.org/event-loop/
https://reactphp.org/stream/

```sh
composer require react/event-loop:^1.1.1
composer require react/stream:^1.1.1

-> php 3-socket-server.php
-> php -S localhost:8000
-> php 4-react-io-nb.php
```

https://www.reactivemanifesto.org/

## CLASS-5

```sh
-> php -S localhost:8000
```

http://localhost:8000/

http://socketo.me/ (Ratchet)

```sh
composer require cboden/ratchet
```

https://www.swoole.co.uk/
