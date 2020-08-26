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
        ->addFile(bin2hex(random_bytes(8)) . '.svg', $svg)
        ->addFile(bin2hex(random_bytes(8)) . '.svg', $svg)
        ->addFile(bin2hex(random_bytes(8)) . '.svg', $svg)
        ->addFile(bin2hex(random_bytes(8)) . '.svg', $svg)
    ;

    $uploaded = $client->writeFile('logos', $files);

    foreach ($uploaded as $file) {
        var_dump($file);
    }
} catch (Exception $e) {
    // todo
}
