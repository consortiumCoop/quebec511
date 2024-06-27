<?php

namespace Quebec511;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Quebec511\ConfigInterface;

class RegionRequest
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
     * @var int
     */
    private $regionCode;

    /**
     * RegionRequest constructor.
     * @param int $regionCode
     * @param string $language
     * @param ConfigInterface $config
     * @param ClientInterface $client
     */
    public function __construct(
        int $regionCode,
        string $language,
        ConfigInterface $config,
        ClientInterface $client
    )
    {
        $this->language = $language;
        $this->config = $config;
        $this->client = $client;
        $this->regionCode = $regionCode;
    }

    /**
     * @param array $roadCodes
     * @param string|null $category
     * @return array
     * @throws GuzzleException
     */
    public function getRoadStatuses(array $roadCodes, ?string $category = null): array
    {
        $url = $this->config->getUrl('road_status');
        $url = $this->generateLink($url, [
            'lang' => $this->language,
            'regionCode' => $this->regionCode,
            'roadCodes' => implode(';', $roadCodes),
        ]);

        $items = [];

        $response = $this->client->request('GET', $url);

        if ($response->getStatusCode() === 200) {
            $items = [];
            $xml = simplexml_load_string($response->getBody());
            if (is_iterable($xml->channel->item)) {
                foreach($xml->channel->item as $item)
                {
                    if ($category !== null && (string) $item->category !== $category) {
                        continue;
                    }
                    $itemArray = [];
                    foreach ($item as $key => $val) {
                        $itemArray[$key] = (string) $val;
                    }

                    // parse description
                    $descriptionParts = explode(' | ', $itemArray['description'] ?? []);
                    if (count($descriptionParts) === 3) {
                        $itemArray['rawDescription'] = $itemArray['description'];
                        $itemArray['description'] = $descriptionParts[0];
                        $itemArray['roadway'] = $descriptionParts[1];
                        $itemArray['visibility'] = $descriptionParts[2];
                    }

                    $items[] = $itemArray;
                }
            }
        }
        return $items;
    }


    /**
     * @param string $url
     * @param array $context
     * @return string
     */
    private function generateLink(string $url, array $context)
    {
        $replace = [];

        foreach ($context as $key => $val) {
            // check that the value can be casted to string
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }
        return strtr($url, $replace);
    }
}