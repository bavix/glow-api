<?php

namespace Bavix\GlowApi\Interfaces;

interface Invitable
{
    /**
     * @param string $bucket
     * @param string $route
     * @return array
     */
    public function inviteFile(string $bucket, string $route): array;
}
