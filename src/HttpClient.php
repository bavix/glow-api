<?php

namespace Bavix\GlowApi;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;

class HttpClient
{

    /**
     * @var Api
     */
    protected $guzzle;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $token;

    /**
     * Api constructor.
     * @param string $url
     * @param string $token
     */
    public function __construct(string $url, string $token)
    {
        $this->url = \rtrim($url, '/');
        $this->token = $token;
    }

    /**
     * @param string $urn
     * @param array $query
     * @return ResponseInterface
     */
    public function get(string $urn, array $query = []): ResponseInterface
    {
        return $this->getGuzzle()->get($urn, \compact('query'));
    }

    /**
     * @param string $urn
     * @param array $query
     * @return array
     * @throws
     */
    public function safeGet(string $urn, array $query = []): array
    {
        $response = $this->get($urn, $query);
        $received = new Received($response);
        return $received->asArray();
    }

    /**
     * @param string $urn
     * @param array $body
     * @param array $query
     * @return ResponseInterface
     */
    public function post(string $urn, array $body = [], array $query = []): ResponseInterface
    {
        return $this->getGuzzle()->post($urn, [
            'form_params' => $body,
            'query' => $query,
        ]);
    }

    /**
     * @param string $urn
     * @param array $body
     * @param array $query
     * @return array
     * @throws
     */
    public function safePost(string $urn, array $body = [], array $query = []): array
    {
        $response = $this->post($urn, $body, $query);
        $received = new Received($response);
        return $received->asArray();
    }

    /**
     * @param string $urn
     * @param array $body
     * @param array $query
     * @return ResponseInterface
     */
    public function patch(string $urn, array $body = [], array $query = []): ResponseInterface
    {
        return $this->getGuzzle()->patch($urn, [
            'form_params' => $body,
            'query' => $query,
        ]);
    }

    /**
     * @param string $urn
     * @param array $body
     * @param array $query
     * @return array
     * @throws
     */
    public function safePatch(string $urn, array $body = [], array $query = []): array
    {
        $response = $this->patch($urn, $body, $query);
        $received = new Received($response);
        return $received->asArray();
    }

    /**
     * @param string $urn
     * @return ResponseInterface
     */
    public function delete(string $urn): ResponseInterface
    {
        return $this->getGuzzle()->delete($urn);
    }

    /**
     * @param string $urn
     * @return bool
     * @throws
     */
    public function safeDelete(string $urn): bool
    {
        try {
            $this->delete($urn);
            return true;
        } catch (\Throwable $throwable) {
            return false;
        }
    }

    /**
     * @param string $urn
     * @param array $query
     * @param int $page
     * @return iterable
     * @throws
     */
    public function each(string $urn, array $query = [], int $page = 1): iterable
    {
        do {
            $query['page'] = $page;
            $response = $this->get($urn, $query);
            $received = new Received($response);
            $data = $received->asArray();
            foreach ($data['data'] as $datum) {
                yield $datum;
            }
        } while (++$page < ($data['last_page'] ?? 1));
    }

    /**
     * @return Client
     */
    public function getGuzzle(): Client
    {
        if (!$this->guzzle) {
            $this->guzzle = new Client([
                'base_uri' => $this->url,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept' => 'application/json',
                ],
            ]);
        }

        return $this->guzzle;
    }

}
