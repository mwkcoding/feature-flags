<?php

namespace Mwk\FeatureFlags\Adapters;

class ArrayFeatureAdapter implements FeatureAdapter
{
    private array $features;

    public function __construct(array $features)
    {
        $this->features = $features;
    }

    public function feature(string $name, bool $default = false): bool
    {
        if (!isset($this->features[$name])) {
            return $default;
        }

        return $this->features[$name];
    }
}
