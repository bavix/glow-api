<?php

namespace Bavix\GlowApi\Interfaces;

interface Bucketable
{
    /**
     * @param string $name
     * @return array
     */
    public function createBucket(string $name): array;

    /**
     * @param string $name
     * @return array
     */
    public function showBucket(string $name): array;

    /**
     * @param string $name
     * @return bool
     */
    public function dropBucket(string $name): bool;

    /**
     * @param string $name
     * @return array
     */
    public function showOrCreateBucket(string $name): array;

    /**
     * @param int $page
     * @return array
     */
    public function getBuckets(int $page): array;

    /**
     * @return iterable
     */
    public function allBuckets(): iterable;
}
