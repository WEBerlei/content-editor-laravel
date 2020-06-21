<?php

namespace WEBerlei\ContentEditorLaravel\Tests;

use WEBerlei\ContentEditorLaravel\Models\Content;
use WEBerlei\ContentEditorLaravel\Models\Module;
use WEBerlei\ContentEditorLaravel\Models\ModuleImage;
use WEBerlei\ContentEditorLaravel\Models\ModuleTextarea;

use \Faker\Generator;

class ModuleTest extends TestCase
{
    /** @test */
    public function it_can_be_an_image()
    {
        /** @var ModuleImage $image */
        $image = factory( ModuleImage::class )->make();
        $image->path = 'hi';

        /** @var Module $module */
        $module = factory(Module::class)->create();

        $module->setContentModule( $image );

        $this->assertEquals( "<img src='$image->path'>", $module->render() );
    }

    /** @test */
    public function it_can_be_a_textarea()
    {
        /** @var ModuleTextarea $textarea */
        $textarea = factory( ModuleTextarea::class )->make();
        $textarea->text = "Hi from Textarea";

        /** @var Module $module */
        $module = factory(Module::class)->create();

        $module->setContentModule( $textarea );

        $this->assertEquals( "Hi from Textarea", $module->render() );
    }
}
