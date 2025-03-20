<?php

namespace Texuscode\Ui\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Texuscode\Ui\Console\Commands\MakeTemplateCommand;

class TexusCodeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'texus');
        Blade::componentNamespace('Texus\\Ui\\View\\Components', 'texus');
        $this->bootCommands();
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
    }

    // protected function registerComponents() {}

    public function bootCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }
        $this->commands([
            MakeTemplateCommand::class
        ]);
    }
}
