<?php

namespace Mwk\FeatureFlags\Adapters;

use Illuminate\Support\Str;
use Mwk\FeatureFlags\Models\Feature;

class EloquentFeatureAdapter implements FeatureAdapter
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $name name of feature in kebab-case slug (new-feature) format
     * @param bool $default the fallback return value for "enabled" if feature does not exist
     *
     * @return bool The state of the requested feature
     */
    public function feature(string $name, bool $default = false): bool
    {
        $feature = Feature::where('slug', $name)->first();

        if (null === $feature) {
            if (!isset($this->config[$name]) && config('feature-flags.create_if_not_exists')) {
                $newName = Str::title(Str::replace('-', ' ', $name));

                $feature = new Feature();
                $feature->name = $newName;
                $feature->description = $newName . ' Description';
                $feature->is_enabled = $default;
                $feature->slug = Str::slug($newName);
                $feature->save();
                return $feature->is_enabled;
            }
            return $default;
        }

        return $feature->is_enabled;
    }
}
