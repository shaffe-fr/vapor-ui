<?php

namespace Laravel\VaporUi\Support;

use Illuminate\Support\Arr;
use Symfony\Component\Yaml\Yaml;

class Manifest
{
    /**
     * Retrieve the vapor manifest path.
     *
     * @return string
     */
    public static function path()
    {
        return app()->basePath('vapor.yml');
    }

    /**
     * Get Vapor's manifest section for current environement.
     * @return array
     */
    public static function current()
    {
        if (! file_exists(self::path())) {
            return [];
        }
        
        $manifest = Yaml::parse(file_get_contents(self::path())) ?? [];
        $environment = config('vapor-ui.environment');

        return Arr::get($manifest, "environments.$environment", []);
    }

    /**
     * Retrieve the queues configured for current environment.
     *
     * @return mixed
     */
    public static function queues()
    {
        return Arr::get(self::current(), 'queues');
    }
}
