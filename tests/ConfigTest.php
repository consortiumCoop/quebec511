<?php

declare(strict_types=1);

namespace Tests;


use \PHPUnit\Framework\TestCase;
use Quebec511\Config;
use Quebec511\Region;
use Quebec511\RegionsInterface;

class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $config = new Config(__DIR__.'/../config/quebec511.yml');
        $this->assertTrue($config->getRegions() instanceof RegionsInterface);
    }
}
