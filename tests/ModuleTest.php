<?php

namespace WEBerlei\ContentEditorLaravel\Tests;

use WEBerlei\ContentEditorLaravel\Models\Content;
use WEBerlei\ContentEditorLaravel\Models\Component;
use WEBerlei\ContentEditorLaravel\Models\ComponentImage;
use WEBerlei\ContentEditorLaravel\Models\ComponentTextarea;

use \Faker\Generator;

class ModuleTest extends TestCase
{
    /** @test */
    public function it_can_be_an_image()
    {
        /** @var ComponentImage $image */
        $image = factory( ComponentImage::class )->make();
        $image->path = 'hi';

        /** @var Component $module */
        $module = factory(Component::class)->create();

        $module->setContentModule( $image );

        $this->assertEquals( "<img src='$image->path'>", $module->render() );
    }

    /** @test */
    public function it_can_be_a_textarea()
    {
        /** @var ComponentTextarea $textarea */
        $textarea = factory( ComponentTextarea::class )->make();
        $textarea->text = "Hi from Textarea";

        /** @var Component $module */
        $module = factory(Component::class)->create();

        $module->setContentModule( $textarea );

        $this->assertEquals( "Hi from Textarea", $module->render() );
    }
}
