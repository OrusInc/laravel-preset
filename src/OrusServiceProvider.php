<?php

namespace Orus\LaravelPreset;

use Orus\LaravelPreset\Preset;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class OrusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro("orus", function($command){
            Preset::install();

            $command->info('Orus Laravel Frontend scaffold added successfully.');
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
