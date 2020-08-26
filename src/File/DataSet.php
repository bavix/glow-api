<?php

namespace Bavix\GlowApi\File;

class DataSet
{

    /**
     * @var resource|string
     */
    protected $file;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var bool
     */
    protected $visibility;

    /**
     * DataSet constructor.
     * @param resource|string $file
     * @param string $route
     * @param bool $visibility
     */
    public function __construct($file, string $route, bool $visibility)
    {
        $this->file = $file;
        $this->route = $route;
        $this->visibility = $visibility;
    }

    /**
     * @return resource|string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return bool
     */
    public function isVisibility(): bool
    {
        return $this->visibility;
    }

    /**
     * @return array[]
     */
    public function getMultipart(): array
    {
        return [
            [
                'name' => 'file[]',
                'contents' => \is_resource($this->file) ?
                    $this->file : \fopen($this->file, 'rb'),
            ],
            [
                'name' => 'route[]',
                'contents' => $this->route,
            ],
            [
                'name' => 'visibility[]',
                'contents' => $this->visibility,
            ],
        ];
    }

}
