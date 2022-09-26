<?php

namespace Generate\Scmframe;

use Illuminate\Support\ServiceProvider;

class SCMFrameServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SCMFrameCommand::class
            ]);
        }
    }
}
