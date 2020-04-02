<?php

declare(strict_types=1);

namespace Tests;

use GuzzleHttp\Exception\GuzzleException;
use \PHPUnit\Framework\TestCase;
use Quebec511\InvalidConfigException;
use Quebec511\Quebec511Factory;

class Quebec511Test extends TestCase
{
    /**
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function testQuebec511()
    {
        $q511 = Quebec511Factory::createDefault('fr', 300);
        $result = $q511->forRegion(4000)->getRoadStatuses([20, 85]);
        $this->assertTrue(is_array($result));
    }
}
