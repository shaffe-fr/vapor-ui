<?php

namespace Laravel\VaporUi\Concerns;

use Illuminate\Support\Facades\Config;
use Laravel\VaporUi\Support\Manifest;

trait ConfiguresVaporUi
{
    /**
     * Ensure Vapor UI is properly configured.
     *
     * @return void
     */
    protected function ensureVaporUiIsConfigured()
    {
        // Ensure we are running on Vapor...
        if (! isset($_ENV['VAPOR_SSM_PATH'])) {
            return;
        }

        Config::set('vapor-ui', array_merge([
            'key' => $_ENV['AWS_ACCESS_KEY_ID'] ?? null,
            'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'] ?? null,
            'region' => $_ENV['AWS_DEFAULT_REGION'] ?? 'us-east-1',
            'token' => $_ENV['AWS_SESSION_TOKEN'] ?? null,
            'queue' => [
                'prefix' => $_ENV['SQS_PREFIX'] ?? null,
                'name' => $_ENV['SQS_QUEUE'] ?? null,
            ],
        ], Config::get('vapor-ui') ?? []));

        if (Config::get('vapor-ui.queues') === null) {
            Config::set('vapor-ui.queues', Manifest::queues() ?: [Config::get('vapor-ui.queue.name')]);
        }
    }
}
