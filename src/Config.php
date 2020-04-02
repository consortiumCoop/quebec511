<?php

namespace Quebec511;

use Peak\ArrayValidation\Validation;
use Symfony\Component\Yaml\Yaml;

class Config implements ConfigInterface
{
    protected $config = [];

    /**
     * Config constructor.
     * @param string $file
     * @throws InvalidConfigException
     */
    public function __construct(string $file)
    {
        $this->config = Yaml::parseFile($file);

        $validation = (new Validation($this->config))
            ->expectExactlyKeys(['urls', 'regions'])
            ->expectKeysToBeArray(['urls', 'regions']);

        if ($validation->hasErrors()) {
            throw new InvalidConfigException($validation->getLastError());
        }
    }

    /**
     * @return array
     */
    public function getUrls(): array
    {
        return $this->config['urls'] ?? [];
    }

    /**
     * @param string $name
     * @return string
     */
    public function getUrl(string $name): string
    {
        return $this->config['urls'][$name];
    }

    /**
     * @return RegionsInterface
     */
    public function getRegions(): RegionsInterface
    {
        $regions = new Regions();

        if (isset($this->config['regions'])) {
            foreach ($this->config['regions'] as $regionArray) {
                $region = new Region(
                    $regionArray['code'],
                    $regionArray['name'],
                    $regionArray['roads']
                );
                $regions->addRegion($region);
            }
        }

        return $regions;
    }
}