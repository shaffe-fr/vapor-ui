<?php

test('runtime', function () {
    expect(config('vapor-ui'))->toHaveKeys([
        'key',
        'secret',
        'region',
        'project',
        'environment',
        'queue',
        'queues',
    ]);
});

test('middleware', function () {
    expect(config('vapor-ui.middleware'))->toBeArray();
});
