<?php


namespace WEBerlei\ContentEditorLaravel\Http\Controllers;

use WEBerlei\ContentEditorLaravel\Models\Content;

class ContentController
{
    public function index( Content $content )
    {
        return "ok";
    }

    public function edit( $content_id )
    {
        $v[ 'content_id' ] = $content_id;

        return view( 'content-editor::editor', $v );
    }
}
