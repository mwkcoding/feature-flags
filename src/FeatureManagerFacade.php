<?php

namespace Mwk\FeatureFlags;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mwk\FeatureFlags\FeatureManager
 */
class FeatureManagerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'feature-manager';
    }
}
