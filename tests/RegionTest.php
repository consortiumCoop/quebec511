<?php

declare(strict_types=1);

namespace Tests;


use \PHPUnit\Framework\TestCase;
use Quebec511\Region;

class RegionTest extends TestCase
{
    public function testRegion()
    {
        $region = new Region(2333, 'test', []);

        $this->assertTrue($region->getCode() === 2333);
        $this->assertTrue($region->getName() === 'test');
        $this->assertTrue($region->getRoads() === []);
    }
}
