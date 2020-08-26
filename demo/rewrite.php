<?php

/**
 * @var \Bavix\GlowApi\Api $client
 */
$client = require __DIR__ . '/_client.php';

// file
$svg = 'https://stat.babichev.net/svg/logo.svg';

// create bucket
$client->showOrCreateBucket('logos');

try {
    $files = (new \Bavix\GlowApi\File\Upload())
        ->addFile('logotype.svg', $svg)
    ;

    $uploaded = $client->rewriteFile('logos', $files);

    foreach ($uploaded as $file) {
        var_dump($file);
    }
} catch (Exception $e) {
    var_dump($e);
}
