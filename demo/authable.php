<?php

/**
 * @var \Bavix\GlowApi\Api $client
 */
$client = require __DIR__ . '/_client.php';

foreach ($client->allAbilities() as $ability) {
    var_dump($ability);
}
