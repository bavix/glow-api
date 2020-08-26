<?php

/**
 * @var \Bavix\GlowApi\Api $client
 */
$client = require __DIR__ . '/_client.php';

// create bucket
$client->createBucket('users');

// create view
$avatar = $client->createView('users', [
    'name' => 'avatar',
    'type' => 'contain',
    'width' => 160,
    'height' => 160,
    'quality' => 75,
    'optimize' => true,
    'webp' => true,
]);

var_dump($avatar);

var_dump($client->dropView('users', 'avatar'));
var_dump($client->dropBucket('users'));
