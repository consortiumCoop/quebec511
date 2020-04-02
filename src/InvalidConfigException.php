<?php

namespace Quebec511;

class InvalidConfigException extends \Exception
{

    /**
     * InvalidConfigException constructor.
     */
    public function __construct()
    {
        parent::__construct('Configuration contain(s) error(s). Expecting key "urls" and "regions" to be present and to be array type');
    }
}