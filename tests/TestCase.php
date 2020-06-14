<?php

namespace WEBerlei\ContentEditorLaravel\Tests;

use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;
use WEBerlei\ContentEditorLaravel\ContentEditorServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/database/factories');

        Route::contentEditorLaravel( 'content-editor' );
    }

    protected function getPackageProviders($app)
    {
        return [
            ContentEditorServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);


        include_once __DIR__ . '/../database/migrations/create_content_editor_tables.php.stub';
        (new \CreateContentEditorTables())->up();



    }
}
