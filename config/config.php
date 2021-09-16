<?php

use Mwk\FeatureFlags\Adapters\ArrayFeatureAdapter;

return [

    /**
     * Controls which adapter is being used for feature flags. Default is ArrayFeatureAdapter::class
     * ArrayFeatureAdapter: Uses the config (feature-flags.features)
     * EloquentFeatureAdapter: Uses the database, but if no feature exists in table, it'll check the config, if found there it'll create it in database for future reference
     */
    'adapter' => ArrayFeatureAdapter::class,

    /**
     * Create feature entry in database if not exists. This only applies if using EloquentFeatureAdapter.
     */
    'create_if_not_exists' => true,

    'features' => [
        'my-feature' => true,
    ]
];
