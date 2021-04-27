<?php

declare(strict_types=1);

namespace Codeat3\BladeJamIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladeJamIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('jam-icons', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'jam',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-jam-icons'),
            ], 'blade-jam-icons');
        }
    }
}
