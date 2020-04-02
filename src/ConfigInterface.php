<?php

namespace Quebec511;

interface ConfigInterface
{
    public function getUrls(): array;
    public function getUrl(string $name): string;
    public function getRegions(): RegionsInterface;

}