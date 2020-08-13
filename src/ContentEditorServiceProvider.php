<?php

namespace WEBerlei\ContentEditorLaravel;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use WEBerlei\ContentEditorLaravel\Commands\ContentEditorCommand;
use WEBerlei\ContentEditorLaravel\Commands\SkeletonCommand;
use WEBerlei\ContentEditorLaravel\Http\Controllers\Api\ComponentApiController;
use WEBerlei\ContentEditorLaravel\Http\Controllers\Api\ComponentEditorApiController;
use WEBerlei\ContentEditorLaravel\Http\Controllers\Api\ContentApiController;
use WEBerlei\ContentEditorLaravel\Http\Controllers\Api\UploaderApiController;
use WEBerlei\ContentEditorLaravel\Http\Controllers\ContentController;
use WEBerlei\ContentEditorLaravel\Models\Content;
use WEBerlei\ContentEditorLaravel\Observers\ContentObserver;

class ContentEditorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/content-editor.php' => config_path('content-editor.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/content-editor'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../resources/images' => public_path('images'),
            ], 'public');

            $this->publishes([
                __DIR__ . '/../resources/js' => resource_path('js/vendor/content-editor')
            ], 'vue-components');

            if (! class_exists('CreatePackageTables')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_content_editor_tables.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_content_editor_tables.php'),
                ], 'migrations');
            }

            $this->commands([
                ContentEditorCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'content-editor');

        Route::macro('contentEditorLaravel', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::get('{content}', [ContentController::class, 'index']);
                Route::get('{content_id}/edit', [ContentController::class, 'edit']);
            });

            Route::prefix($prefix . '/api')->group(function () {
                Route::get('/content/{content_id}', [ContentApiController::class, 'get']);
                Route::get('/content/{content_id}/render', [ContentApiController::class, 'render']);
                Route::post('/content/{content_id}/store', [ContentApiController::class, 'store']);
                Route::post('/content/{content_id}/addComponent', [ContentApiController::class, 'addComponent']);

                Route::get('/components', [ComponentApiController::class, 'getComponents']);

                Route::post('/component-editor', [ComponentEditorApiController::class, 'getEditor']);
                Route::post('/component-editor/save', [ComponentEditorApiController::class, 'saveEditorData']);

                Route::post('/uploader/files', [UploaderApiController::class, 'files']);
                Route::post('/uploader/post', [UploaderApiController::class, 'post']);
                Route::post('/uploader/remove', [UploaderApiController::class, 'remove']);
            });
        });

        Content::observe( ContentObserver::class );
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/content-editor.php', 'content-editor');
    }
}
