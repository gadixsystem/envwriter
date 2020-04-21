<?php

    namespace gadixsystem\envwriter;

    use Illuminate\Support\ServiceProvider;
    use gadixsystem\envwriter\EnvWriter;
    
    class EnvWriterServiceProvider extends ServiceProvider {
        public function boot()
        {
        }
        public function register()
        {
            $this->app->singleton(EnvWriter::class, function ($app) {
                return new EnvWriter();
            });
        }
    }
    ?>