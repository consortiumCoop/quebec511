<?php

namespace Quebec511;

interface RegionsInterface extends \Countable, \IteratorAggregate
{
    /**
     * @return array<RegionInterface>
     */
    public function getAll(): array;

    /**
     * @param int $code
     * @return RegionInterface|null
     */
    public function getRegionByCode(int $code): ?RegionInterface;

    /**
     * @param string $name
     * @return RegionInterface|null
     */
    public function getRegionByName(string $name): ?RegionInterface;
}