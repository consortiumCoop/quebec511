<?php

namespace Quebec511;

use GuzzleHttp\ClientInterface;

class Quebec511
{
    /**
     * @var string
     */
    private $language;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Quebec511 constructor.
     * @param string $language (fr|en)
     * @param ConfigInterface $config
     * @param ClientInterface $client
     */
    public function __construct(
        string $language,
        ConfigInterface $config,
        ClientInterface $client
    ) {
        $this->language = $language;
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @param int $regionCode
     * @return RegionRequest
     */
    public function forRegion(int $regionCode): RegionRequest
    {
        return new RegionRequest(
            $regionCode,
            $this->language,
            $this->config,
            $this->client
        );
    }

    /**
     * @return RegionsInterface
     */
    public function getRegions(): RegionsInterface
    {
        return $this->config->getRegions();
    }

}