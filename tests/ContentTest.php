<?php

namespace WEBerlei\ContentEditorLaravel\Tests;

use WEBerlei\ContentEditorLaravel\Models\Content;

class ContentTest extends TestCase
{
    /** @test */
    public function it_can_create_content()
    {
        factory(Content::class)->create();
        /*$response = $this->post( '/content', [

        ] );

        $response->assertOk();*/

        //Content::create([]);

        $this->assertDatabaseCount('content_editor__content', 1);
    }
}
