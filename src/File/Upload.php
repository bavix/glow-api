<?php

namespace Bavix\GlowApi\File;

class Upload
{

    /**
     * @var DataSet[]
     */
    protected $dataSets = [];

    /**
     * @param string $route
     * @param $file
     * @param bool $visibility
     * @return $this
     */
    public function addFile(string $route, $file, bool $visibility = true): self
    {
        $this->dataSets[] = new DataSet($file, $route, $visibility);
        return $this;
    }

    /**
     * @return array
     */
    public function getMultipart(): array
    {
        $multipart = [];
        foreach ($this->dataSets as $dataSet) {
            \array_push($multipart, ...$dataSet->getMultipart());
        }

        return $multipart;
    }

}
