<?php

namespace WEBerlei\ContentEditorLaravel;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use WEBerlei\ContentEditorLaravel\Commands\SkeletonCommand;
use WEBerlei\ContentEditorLaravel\Http\Controllers\ContentController;

class ContentEditorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/content-editor.php' => config_path('content-editor.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/skeleton'),
            ], 'views');

            if (! class_exists('CreatePackageTables')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_content_editor_tables.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_skeleton_tables.php'),
                ], 'migrations');
            }

            $this->commands([
                SkeletonCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'skeleton');

        Route::macro('contentEditorLaravel', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::get('/', [ContentController::class, 'index']);
            });
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/content-editor.php', 'content-editor');
    }
}
