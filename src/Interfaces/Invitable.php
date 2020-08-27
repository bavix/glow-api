<?php

namespace Bavix\GlowApi\Interfaces;

interface Invitable
{
    /**
     * @param string $bucket
     * @param string $route
     * @param int $timestamp
     * @param array $options
     * @return array
     */
    public function inviteFile(string $bucket, string $route, int $timestamp, array $options): array;
}
