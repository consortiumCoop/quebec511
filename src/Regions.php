<?php

namespace Quebec511;

class Regions implements RegionsInterface
{
    /**
     * @var array<Region>
     */
    protected $regions = [];

    /**
     * @param RegionInterface $region
     * @return $this
     */
    public function addRegion(RegionInterface $region)
    {
        $this->regions[] = $region;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->regions;
    }

    /**
     * @inheritDoc
     */
    public function getRegionByCode(int $code): ?RegionInterface
    {
        /** @var Region $region */
        foreach ($this->regions as $region) {
            if ($region->getCode() === $code) {
                return $region;
            }
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getRegionByName(string $name): ?RegionInterface
    {
        /** @var Region $region */
        foreach ($this->regions as $region) {
            if ($region->getName() === $name) {
                return $region;
            }
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->regions);
    }
}
