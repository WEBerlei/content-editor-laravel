<?php


namespace WEBerlei\ContentEditorLaravel\Tests\Http\Controllers;


use Illuminate\Support\Facades\Route;
use WEBerlei\ContentEditorLaravel\Tests\TestCase;

class ContentControllerTest extends TestCase
{
    /** @test */
    public function the_content_controller_has_an_index_route()
    {
        $this->withoutExceptionHandling();



        $this->get( '/content-editor' )
            ->assertOk();
    }
}
