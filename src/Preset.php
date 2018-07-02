<?php
namespace Orus\LaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset {

    public static function install()
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();
        static::updateWebpackConfiguration();
        static::updateBootstrapping();
        static::updateComponent();
        static::updateTailwind();
        static::removeNodeModules();
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return [
            'vue' => '^2.5.7',
            "tailwindcss" => "^0.5.3",
            'laravel-mix-tailwind' => "^0.1.0",
        ] + Arr::except($packages, [
            'babel-preset-react',
            'react',
            'react-dom',
            'jquery',
            'bootstrap',
            'popper.js',
            'lodash',
        ]);
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    protected static function updateWebpackConfiguration()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Update the example component.
     *
     * @return void
     */
    protected static function updateComponent()
    {
        (new Filesystem)->delete(
            resource_path('assets/js/components/Example.js')
        );

        (new Filesystem)->delete(
            resource_path('assets/js/components/ExampleComponent.vue')
        );

        copy(
            __DIR__.'/stubs/Example.vue',
            resource_path('assets/js/components/Example.vue')
        );
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        (new Filesystem)->delete(
            resource_path('assets/sass/_variables.scss')
        );

        copy(__DIR__.'/stubs/app.js', resource_path('assets/js/app.js'));
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        copy(__DIR__.'/stubs/app.scss', resource_path('assets/sass/app.scss'));
    }

    /**
     * Update the tailwind init file.
     *
     * @return void
     */
    protected static function updateTailwind()
    {
        copy(__DIR__.'/stubs/tailwind.js', base_path('tailwind.js'));
    }
}
