<?php

namespace Bavix\GlowApi;

use Bavix\GlowApi\File\Upload;
use Bavix\GlowApi\Interfaces\Authable;
use Bavix\GlowApi\Interfaces\Bucketable;
use Bavix\GlowApi\Interfaces\Fileable;
use Bavix\GlowApi\Interfaces\Invitable;
use Bavix\GlowApi\Interfaces\Viewable;

class Api implements Authable, Bucketable, Fileable, Invitable, Viewable
{

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * Client constructor.
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $email
     * @param string $password
     * @param array $options
     * @return array
     */
    public function createToken(string $email, string $password, array $options = []): array
    {
        $body = [
            'email' => $email,
            'password' => $password,
            'device' => 'glow-api',
        ];

        return $this->client->safePost(
            '/api/auth/token',
            \array_merge($body, $options),
        );
    }

    /**
     * @return iterable
     */
    public function allAbilities(): iterable
    {
        return $this->client->each('/api/auth/abilities');
    }

    /**
     * @param string $name
     * @return array
     */
    public function createBucket(string $name): array
    {
        return $this->client->safePost(
            '/api/bucket',
            \compact('name'),
        );
    }

    /**
     * @param string $name
     * @return array
     */
    public function showBucket(string $name): array
    {
        return $this->client->safeGet(\sprintf('/api/bucket/%s', $name));
    }

    /**
     * @param string $name
     * @return bool
     */
    public function dropBucket(string $name): bool
    {
        return $this->client->safeDelete(\sprintf('/api/bucket/%s', $name));
    }

    /**
     * @param string $name
     * @return array
     */
    public function showOrCreateBucket(string $name): array
    {
        try {
            return $this->showBucket($name);
        } catch (\Throwable $throwable) {
            return $this->createBucket($name);
        }
    }

    /**
     * @param int $page
     * @return array
     */
    public function getBuckets(int $page): array
    {
        $data = $this->client->safeGet(
            '/api/bucket',
            \compact('page'),
        );

        return $data['data'] ?? [];
    }

    /**
     * @return iterable
     */
    public function allBuckets(): iterable
    {
        return $this->client->each('/api/bucket');
    }

    /**
     * @param string $bucket
     * @param array $props
     * @return array
     */
    public function createView(string $bucket, array $props): array
    {
        return $this->client->safePost(
            \sprintf('/api/bucket/%s/view', $bucket),
            $props,
        );
    }

    /**
     * @param string $bucket
     * @param string $view
     * @return array
     */
    public function showView(string $bucket, string $view): array
    {
        return $this->client->safeGet(
            \sprintf('/api/bucket/%s/view/%s', $bucket, $view),
        );
    }

    /**
     * @param string $bucket
     * @param string $view
     * @return bool
     */
    public function dropView(string $bucket, string $view): bool
    {
        return $this->client->safeDelete(
            \sprintf('/api/bucket/%s/view/%s', $bucket, $view),
        );
    }

    /**
     * @param string $bucket
     * @param int $page
     * @return array
     */
    public function getViews(string $bucket, int $page): array
    {
        $data = $this->client->safeGet(
            \sprintf('/api/bucket/%s/view', $bucket),
            \compact('page'),
        );

        return $data['data'] ?? [];
    }

    /**
     * @param string $bucket
     * @return iterable
     */
    public function allViews(string $bucket): iterable
    {
        return $this->client->each(\sprintf('/api/bucket/%s/view', $bucket));
    }


    /**
     * @param string $bucket
     * @param Upload $upload
     * @return array
     * @throws
     */
    public function writeFile(string $bucket, Upload $upload): array
    {
        $response = $this->client->getGuzzle()->post(\sprintf('/api/bucket/%s/file', $bucket), [
            'multipart' => $upload->getMultipart(),
        ]);
        $received = new Received($response);
        return $received->asArray()['data'] ?? [];
    }

    /**
     * @param string $bucket
     * @param Upload $upload
     * @return array
     * @throws
     */
    public function rewriteFile(string $bucket, Upload $upload): array
    {
        $multipart = $upload->getMultipart();
        $multipart[] = [
            'name' => 'force',
            'contents' => true,
        ];

        $response = $this->client->getGuzzle()->post(\sprintf('/api/bucket/%s/file', $bucket), [
            'multipart' => $multipart,
        ]);
        $received = new Received($response);
        return $received->asArray()['data'] ?? [];
    }


    /**
     * @param string $bucket
     * @param int $fileId
     * @return array
     */
    public function showFile(string $bucket, int $fileId): array
    {
        return $this->client->safeGet(
            \sprintf('/api/bucket/%s/file/%d', $bucket, $fileId)
        );
    }

    /**
     * @param string $bucket
     * @param int $fileId
     * @param bool $visibility
     * @return array
     */
    public function visibilityFile(string $bucket, int $fileId, bool $visibility): array
    {
        return $this->client->safePatch(
            \sprintf('/api/bucket/%s/file/%d', $bucket, $fileId),
            ['visibility' => $visibility],
        );
    }

    /**
     * @param string $bucket
     * @param int $fileId
     * @return bool
     */
    public function dropFile(string $bucket, int $fileId): bool
    {
        return $this->client->safeDelete(
            \sprintf('/api/bucket/%s/file/%d', $bucket, $fileId),
        );
    }

    /**
     * @param string $bucket
     * @param int $page
     * @return array
     */
    public function getFiles(string $bucket, int $page): array
    {
        $data = $this->client->safeGet(
            \sprintf('/api/bucket/%s/file', $bucket),
            \compact('page'),
        );

        return $data['data'] ?? [];
    }

    /**
     * @param string $bucket
     * @return iterable
     */
    public function allFiles(string $bucket): iterable
    {
        return $this->client->each(
            \sprintf('/api/bucket/%s/file', $bucket),
        );
    }

    /**
     * @param string $bucket
     * @param int $fileId
     * @return array
     */
    public function inviteFile(string $bucket, int $fileId): array
    {
        return $this->client->safePost(
            \sprintf('/api/bucket/%s/file/%d/invite', $bucket, $fileId),
        );
    }

}
