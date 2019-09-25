<?php

namespace SCLaravelFrontendPresets\DefaultTailwindPreset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

class DefaultTailwindPreset extends Preset
{
    public static function install()
    {
        static::updatePackages();
        static::updateStyles();
        static::updateBootstrapping();
        static::updateDefaultViews();
        static::removeNodeModules();
    }

    public static function installAuth()
    {
        static::install();
        static::scaffoldAuth();
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'laravel-mix' => '^4.1.2',
            'postcss-import' => '^12.0.1',
            'postcss-nesting' => '^7.0.1',
            'tailwindcss' => '^1.1.2',
            'vue' => '^2.6.10',
            'vue-template-compiler' => '^2.6.10',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'laravel-mix',
            'jquery',
            'sass',
            'sass-loader',
        ]));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->delete(public_path('js/app.js'));
            $filesystem->delete(public_path('css/app.css'));

            if (! $filesystem->isDirectory($directory = resource_path('css'))) {
                $filesystem->makeDirectory($directory, 0755, true);
            }

            if ($filesystem->isDirectory($directory = resource_path('css/components'))) {
                $filesystem->cleanDirectory($directory);
            } else {
                $filesystem->makeDirectory($directory, 0755, true);
            }

            $filesystem->delete(resource_path('css/app.css'));
        });

        copy(__DIR__.'/tailwindcss-stubs/resources/css/app.css', resource_path('css/app.css'));
        copy(__DIR__.'/tailwindcss-stubs/resources/css/components/button.css', resource_path('css/components/button.css'));
        copy(__DIR__.'/tailwindcss-stubs/resources/css/components/core.css', resource_path('css/components/core.css'));
        copy(__DIR__.'/tailwindcss-stubs/resources/css/components/dropdown.css', resource_path('css/components/dropdown.css'));
        copy(__DIR__.'/tailwindcss-stubs/resources/css/components/loader.css', resource_path('css/components/loader.css'));
        copy(__DIR__.'/tailwindcss-stubs/resources/css/components/nav.css', resource_path('css/components/nav.css'));
    }

    protected static function updateBootstrapping()
    {
        if (! (new Filesystem)->isDirectory($directory = resource_path('js/components'))) {
            (new Filesystem)->makeDirectory($directory, 0755, true);
        }

        copy(__DIR__.'/tailwindcss-stubs/tailwind.config.js', base_path('tailwind.config.js'));

        copy(__DIR__.'/tailwindcss-stubs/webpack.mix.js', base_path('webpack.mix.js'));

        copy(__DIR__.'/tailwindcss-stubs/resources/js/app.js', resource_path('js/app.js'));
        copy(__DIR__.'/tailwindcss-stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));
        copy(__DIR__.'/tailwindcss-stubs/resources/js/components/Flash.vue', resource_path('js/components/Flash.vue'));
        copy(__DIR__.'/tailwindcss-stubs/resources/js/components/Dropdown.vue', resource_path('js/components/Dropdown.vue'));
    }

    protected static function updateDefaultViews()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->delete(resource_path('views/welcome.blade.php'));

            $filesystem->copyDirectory(__DIR__.'/tailwindcss-stubs/resources/views/layouts', resource_path('views/layouts'));
        });

        copy(__DIR__.'/tailwindcss-stubs/resources/views/welcome.blade.php', resource_path('views/welcome.blade.php'));
    }

    protected static function scaffoldAuth()
    {
        file_put_contents(app_path('Http/Controllers/HomeController.php'), static::compileControllerStub());

        file_put_contents(
            base_path('routes/web.php'),
            "Auth::routes();\n\nRoute::get('/home', 'HomeController@index')->name('home');\n\n",
            FILE_APPEND
        );

        tap(new Filesystem, function ($filesystem) {
            $filesystem->delete(resource_path('views/home.blade.php'));
            $filesystem->copyDirectory(__DIR__.'/tailwindcss-stubs/resources/views/auth', resource_path('views/auth'));
        });

        copy(__DIR__.'/tailwindcss-stubs/resources/views/home.blade.php', resource_path('views/home.blade.php'));
    }

    protected static function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            Container::getInstance()->getNamespace(),
            file_get_contents(__DIR__.'/tailwindcss-stubs/app/Http/Controllers/HomeController.stub')
        );
    }
}
