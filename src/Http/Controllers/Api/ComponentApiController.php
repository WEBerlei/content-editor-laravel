<?php


namespace WEBerlei\ContentEditorLaravel\Http\Controllers\Api;

use WEBerlei\ContentEditorLaravel\Models\ComponentImage;
use WEBerlei\ContentEditorLaravel\Models\ComponentTextarea;
use WEBerlei\ContentEditorLaravel\Models\Content;

class ComponentApiController
{
    public function getComponents()
    {
        return [
            ComponentImage::class => ComponentImage::getVueData(),
            ComponentTextarea::class => ComponentTextarea::getVueData(),
        ];
    }
}
