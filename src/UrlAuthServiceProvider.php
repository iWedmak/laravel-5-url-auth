<?php namespace iWedmak\UrlAuth;

use Illuminate\Support\ServiceProvider;

require_once 'helper.php';

class UrlAuthServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('urlauth.php')
        ], 'config');
        // Register commands
        $this->commands('command.urlauth.migration');
        
        // Register route
        $this->loadRoutesFrom(__DIR__.'/routes.php');        
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }
    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.urlauth.migration', function ($app) {
            return new MigrationCommand();
        });
    }
    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.urlauth.migration'
        ];
    }
}