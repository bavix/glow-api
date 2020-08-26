<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$client = new \Bavix\GlowApi\HttpClient(
    'http://glow.local',
    '1|HCvCxWaFdIVCt1nez3WognpCEhj9Wec7eSQZUD6UngIbPDBkzsP6kbLDi9EiWNKZiUfoRCXEtEhXCf8X'
);

return new \Bavix\GlowApi\Api($client);
