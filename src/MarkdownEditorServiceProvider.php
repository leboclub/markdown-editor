<?php 

namespace Leboclub\MarkdownEditor;

use Illuminate\Support\ServiceProvider;

class MarkdownEditorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom('./../resources/views', 'markdown');

        $this->publishes([
            __DIR__.'/../config/markdown.php' => config_path('markdown.php'),
            __DIR__.'/../public/assets' => public_path('vendor/markdown'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/markdown'),
        ], 'markdown');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("markdown-editor", function(){
            return new MarkdownEditor();
        });
    }
}
