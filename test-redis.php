<?php

require 'vendor/autoload.php';

use Predis\Client;

$client = new Client([
    'host' => 'redis-11484.c8.us-east-1-2.ec2.redns.redis-cloud.com',
    'port' => 11484,
    'database' => 0,
    'username' => 'default',
    'password' => 'BPeykbUo4S2xUhqCX3ZkjKmiQzRHrwhw',
]);

try {
    $client->set('test_key', 'Hello, Redis!');
    $value = $client->get('test_key');
    echo "Valor recuperado do Redis: " . $value;
} catch (Exception $e) {
    echo "Erro ao conectar ao Redis: " . $e->getMessage();
}