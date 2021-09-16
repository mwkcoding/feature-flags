<?php

namespace Mwk\FeatureFlags;

use Mwk\FeatureFlags\Adapters\FeatureAdapter;

class FeatureManager
{
    private FeatureAdapter $adapter;

    public function __construct(FeatureAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function feature(string $name, bool $default = false): Feature
    {
        return new Feature($this->adapter->feature($name, $default));
    }
}
