<?php

use Ds\Set;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\WsServer;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

require_once 'vendor/autoload.php';

$chatComponent = new class implements MessageComponentInterface
{
    private Set $connections;

    public function __construct()
    {
        $this->connections = new Set();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo 'WebSocket connection opened' . PHP_EOL;
        $this->connections->add($conn);
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo 'WebSocket connection finished' . PHP_EOL;
        $this->connections->remove($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo 'Error ' .  $e->getTraceAsString();
    }

    public function onMessage(ConnectionInterface $connFrom, MessageInterface $msg)
    {
        foreach ($this->connections as $conn) {
            if ($conn !== $connFrom) {
                $conn->send((string) $msg);
            }
        }
    }
};


$server = IoServer::factory(new HttpServer(
    new WsServer($chatComponent)
), 8002);

$server->run();
