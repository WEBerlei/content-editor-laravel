<?php


namespace WEBerlei\ContentEditorLaravel\Http\Controllers\Api;

use WEBerlei\ContentEditorLaravel\Models\ComponentFile;
use WEBerlei\ContentEditorLaravel\Models\ComponentImage;
use WEBerlei\ContentEditorLaravel\Models\ComponentTextarea;
use WEBerlei\ContentEditorLaravel\Models\Content;

class ComponentApiController
{
    public function getComponents()
    {
        $components = array();

        foreach( config( 'content-editor.components' ) as $componentClass )
        {
            $components[ $componentClass ] = $componentClass::getVueData();
        }

        return $components;
    }
}
