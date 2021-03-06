<?php

namespace Bavix\GlowApi\Interfaces;

use Bavix\GlowApi\File\Upload;

interface Fileable
{
    /**
     * @param string $bucket
     * @param Upload $upload
     * @return array
     * @throws
     */
    public function writeFile(string $bucket, Upload $upload): array;

    /**
     * @param string $bucket
     * @param Upload $upload
     * @return array
     * @throws
     */
    public function rewriteFile(string $bucket, Upload $upload): array;

    /**
     * @param string $bucket
     * @param string $route
     * @return array
     */
    public function showFile(string $bucket, string $route): array;

    /**
     * @param string $bucket
     * @param string $route
     * @param bool $visibility
     * @return array
     */
    public function visibilityFile(string $bucket, string $route, bool $visibility): array;

    /**
     * @param string $bucket
     * @param string $route
     * @return bool
     */
    public function dropFile(string $bucket, string $route): bool;

    /**
     * @param string $bucket
     * @param int $page
     * @return array
     */
    public function getFiles(string $bucket, int $page): array;

    /**
     * @param string $bucket
     * @return iterable
     */
    public function allFiles(string $bucket): iterable;
}
