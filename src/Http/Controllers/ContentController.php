<?php


namespace WEBerlei\ContentEditorLaravel\Http\Controllers;

class ContentController
{
    public function index()
    {
        return "ok";
    }

    public function editor()
    {
        return view( 'content-editor::editor' );
    }
}
