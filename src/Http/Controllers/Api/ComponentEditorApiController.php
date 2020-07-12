<?php


namespace WEBerlei\ContentEditorLaravel\Http\Controllers\Api;


use Illuminate\Http\Request;
use WEBerlei\ContentEditorLaravel\Models\Component;

class ComponentEditorApiController
{
    public function getEditor( Request $request )
    {
        $componentId = $request->input( 'componentId' );

        $component = Component::where( 'id', '=', $componentId )->first();

        if( $component == null )
        {
            $componentClass = $request->input( 'componentClass' );

            return ( new $componentClass() )->renderEditor();
        }

        return $component->renderEditor();
    }

    public function saveEditorData( Request $request )
    {
        $componentId = $request->input( 'componentId' );

        $component = Component::where( 'id', '=', $componentId )->first();

        if( $component == null )
        {
            $componentClass = $request->input( 'componentClass' );

            return ( new $componentClass() )->verify( $request );
        }

        return $component->verify( $request );
    }
}
