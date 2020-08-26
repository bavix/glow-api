<?php

namespace Bavix\GlowApi\Interfaces;

interface Viewable
{
    /**
     * @param string $bucket
     * @param array $props
     * @return array
     * @throws
     */
    public function createView(string $bucket, array $props): array;

    /**
     * @param string $bucket
     * @param string $view
     * @return array
     */
    public function showView(string $bucket, string $view): array;

    /**
     * @param string $bucket
     * @param string $view
     * @return bool
     */
    public function dropView(string $bucket, string $view): bool;

    /**
     * @param string $bucket
     * @param int $page
     * @return array
     */
    public function getViews(string $bucket, int $page): array;

    /**
     * @param string $bucket
     * @return iterable
     */
    public function allViews(string $bucket): iterable;
}
