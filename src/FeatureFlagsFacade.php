<?php

namespace Mwkcoding\FeatureFlags;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mwkcoding\FeatureFlags\Skeleton\SkeletonClass
 */
class FeatureFlagsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'feature-flags';
    }
}
