<?php

namespace Quebec511;

interface RegionInterface extends \JsonSerializable
{
    public function getCode(): int;
    public function getName(): string;
    public function getRoads(): array;
}