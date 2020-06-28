<?php

namespace WEBerlei\ContentEditorLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \WEBerlei\ContentEditorLaravel\ContentEditor
 */
class ContentEditorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'content-editor';
    }
}
