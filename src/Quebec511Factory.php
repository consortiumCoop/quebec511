<?php

namespace Quebec511;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\FlysystemStorage;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use League\Flysystem\Adapter\Local;

class Quebec511Factory
{
    /**
     * @param string $language
     * @param int $cacheTtl
     * @return Quebec511
     * @throws InvalidConfigException
     */
    public static function createDefault(string $language = 'fr', int $cacheTtl = 300): Quebec511
    {
        return new Quebec511(
            $language,
            self::createDefaultConfig(),
            self::createClientWithCache(__DIR__.'/../cache', $cacheTtl)
        );
    }

    /**
     * @return ConfigInterface
     * @throws InvalidConfigException
     */
    protected static function createDefaultConfig(): ConfigInterface
    {
        return new Config(__DIR__.'/../config/quebec511.yml');
    }

    /**
     * @param string $pathToCache
     * @param int $ttl
     * @return ClientInterface
     */
    protected static function createClientWithCache(string $pathToCache, int $ttl): ClientInterface
    {
        // Create default HandlerStack
        $stack = HandlerStack::create();

        // Add this middleware to the top with `push`
        $stack->push(new CacheMiddleware(), 'cache');

        // Initialize the client with the handler option
        $client = new Client([
            'handler' => $stack,
        ]);

        $stack->push(
            new CacheMiddleware(
                new GreedyCacheStrategy(
                    new FlySystemStorage(
                        new Local($pathToCache)
                    ),
                    $ttl
                )
            ),
            'cache'
        );

        return $client;
    }



}