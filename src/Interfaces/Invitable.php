<?php

namespace Bavix\GlowApi\Interfaces;

interface Invitable
{
    /**
     * @param string $bucket
     * @param string $route
     * @param \DateTime $dateTime
     * @param array $options
     * @return array
     */
    public function inviteFile(string $bucket, string $route, \DateTime $dateTime, array $options): array;
}
