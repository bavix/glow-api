<?php

/**
 * @var \Bavix\GlowApi\Api $client
 */
$client = require __DIR__ . '/_client.php';

// create
$client->showOrCreateBucket('api');
// show
$client->showOrCreateBucket('api');

// get all
foreach ($client->allBuckets() as $bucket) {
    var_dump($bucket);
    var_dump($client->dropBucket($bucket['name']));
}
