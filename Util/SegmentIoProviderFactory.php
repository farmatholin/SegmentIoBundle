<?php

namespace Farmatholin\SegmentIoBundle\Util;

class SegmentIoProviderFactory
{
    private array $sources;
    private array $options;
    private $logger;
    private string $env;

    public function __construct(array $sources, string $env, array $options, callable $logger)
    {
        $this->sources = $sources;
        $this->options = $options;
        $this->logger = $logger;
        $this->env = $env;
    }

    public function getInstance($sourceName): SegmentIoProvider
    {
        $key = null;

        foreach ($this->sources as $source) {
            if ($source['name'] === $sourceName) {
                $key = $source['write_key'];
            }
        }

        if ($key === null) {
            throw new \InvalidArgumentException('The source name should match with one of the names provided in configurations file.');
        }

        return new SegmentIoProvider($key, $this->env, $this->options, $this->logger);

    }

}
