<?php

namespace SCLaravelFrontendPresets\DefaultTailwindPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class DefaultTailwindPresetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        PresetCommand::macro('default-tailwind', function ($command) {
            DefaultTailwindPreset::install();

            $command->info('Tailwind CSS scaffolding and default settings installed successfully.');
            $command->info('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });

        PresetCommand::macro('default-tailwind-auth', function ($command) {
            DefaultTailwindPreset::installAuth();

            $command->info('Tailwind CSS scaffolding and default settings with auth views installed successfully.');
            $command->info('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });
    }
}
