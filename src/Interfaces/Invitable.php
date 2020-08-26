<?php

namespace Bavix\GlowApi\Interfaces;

interface Invitable
{
    /**
     * @param string $bucket
     * @param int $fileId
     * @return array
     */
    public function inviteFile(string $bucket, int $fileId): array;
}
