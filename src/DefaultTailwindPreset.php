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
        static::updateWelcomePage();
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
            'laravel-mix' => '^4.0.12',
            'laravel-mix-tailwind' => '^0.1.0',
            'tailwindcss' => '^0.7.4',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'laravel-mix',
            'jquery',
        ]));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->delete(public_path('js/app.js'));
            $filesystem->delete(public_path('css/app.css'));

            if (! $filesystem->isDirectory($directory = resource_path('sass'))) {
                $filesystem->makeDirectory($directory, 0755, true);
            } else {
                $filesystem->delete(resource_path('sass/_variables.scss'));
            }

            if (! $filesystem->isDirectory($directory = resource_path('sass/components'))) {
                $filesystem->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__.'/tailwindcss-stubs/resources/sass/app.scss', resource_path('sass/app.scss'));
        copy(__DIR__.'/tailwindcss-stubs/resources/sass/components/_btn.scss', resource_path('sass/components/_btn.scss'));
        copy(__DIR__.'/tailwindcss-stubs/resources/sass/components/_text.scss', resource_path('sass/components/_text.scss'));
    }

    protected static function updateBootstrapping()
    {
        (new Filesystem)->delete(resource_path('views/welcome.blade.php'));

        copy(__DIR__.'/tailwindcss-stubs/tailwind.js', base_path('tailwind.js'));

        copy(__DIR__.'/tailwindcss-stubs/webpack.mix.js', base_path('webpack.mix.js'));

        copy(__DIR__.'/tailwindcss-stubs/resources/js/app.js', resource_path('js/app.js'));
        copy(__DIR__.'/tailwindcss-stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    protected static function updateWelcomePage()
    {
        (new Filesystem)->delete(resource_path('views/welcome.blade.php'));

        copy(__DIR__.'/tailwindcss-stubs/resources/views/welcome.blade.php', resource_path('views/welcome.blade.php'));
    }

    protected static function scaffoldAuth()
    {
        (new Filesystem)->delete(resource_path('views/home.blade.php'));

        file_put_contents(app_path('Http/Controllers/HomeController.php'), static::compileControllerStub());

        file_put_contents(
            base_path('routes/web.php'),
            "Auth::routes();\n\nRoute::get('/home', 'HomeController@index')->name('home');\n\n",
            FILE_APPEND
        );

        (new Filesystem)->copyDirectory(__DIR__.'/tailwindcss-stubs/resources/views', resource_path('views'));
    }

    protected static function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            Container::getInstance()->getNamespace(),
            file_get_contents(__DIR__.'/tailwindcss-stubs/controllers/HomeController.stub')
        );
    }
}
