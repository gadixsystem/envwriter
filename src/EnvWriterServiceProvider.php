<?php

namespace gadixsystem\envwriter;

use Illuminate\Support\ServiceProvider;

class EnvWriterServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register(): void
    {
        $this->app->singleton(
            EnvWriter::class,
            function ($app) {
                return new EnvWriter();
            }
        );
    }
}
