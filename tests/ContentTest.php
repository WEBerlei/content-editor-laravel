<?php

namespace WEBerlei\ContentEditorLaravel\Tests;

use WEBerlei\ContentEditorLaravel\Models\Content;

class ContentTest extends TestCase
{
    /** @test */
    public function it_can_store_content_in_the_database()
    {
        factory(Content::class)->create();
        /*$response = $this->post( '/content', [

        ] );

        $response->assertOk();*/

        //Content::create([]);

        $this->assertDatabaseCount( config( 'content-editor.table_prefix' ) . 'contents', 1 );
    }


    public function content_contains_multiple_modules()
    {
        $content = factory(Content::class)->create();
        /*$content->modules()->createMany(
            factory(App\Post::class, 3)->make()->toArray()
        );*/

        //$this->assertEquals( 3, $content->modules()->count() );
    }

    public function content_can_echo_html_output_from_its_modules()
    {

    }
}
