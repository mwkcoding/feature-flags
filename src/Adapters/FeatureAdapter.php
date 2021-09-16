<?php

namespace Mwk\FeatureFlags\Adapters;

interface FeatureAdapter
{
    public function feature(string $name, bool $default = false): bool;
}
