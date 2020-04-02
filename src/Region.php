<?php

namespace Quebec511;

class Region implements RegionInterface
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $roads;

    /**
     * Region constructor.
     * @param int $code
     * @param string $name
     * @param array $roads
     */
    public function __construct(int $code, string $name, array $roads)
    {
        $this->code = $code;
        $this->name = $name;
        $this->roads = $roads;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getRoads(): array
    {
        return $this->roads;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'roads' => $this->roads
        ];
    }
}