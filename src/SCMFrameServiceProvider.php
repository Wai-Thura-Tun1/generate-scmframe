<?php

namespace Generate\Scmframe;

use Illuminate\Support\ServiceProvider;

class SCMFrameServiceProvider extends ServiceProvider
{
    public function register()
    {
        $serviceFiles = glob("app/Services/*Service.php");
        foreach (glob("app/Contracts/Services/*Interface.php") as $key => $file) {
            $this->app->bind(
                "App\Contracts\Services" . DIRECTORY_SEPARATOR  . substr($file, 23, -4),
                "App\Services" . DIRECTORY_SEPARATOR . substr($serviceFiles[$key], 13, -4)
            );
        }

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
