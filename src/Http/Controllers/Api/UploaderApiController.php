<?php


namespace WEBerlei\ContentEditorLaravel\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use WEBerlei\ContentEditorLaravel\Models\Component;

class UploaderApiController
{
    public function files( Request $request )
    {
        $componentId = $request->input('componentId');

        /** @var Component $component */
        $component = Component::where('id', '=', $componentId)->first();

        if ($component == null)
        {
            return Response::json('error', 400);
        }

        $files = $component->renderable->getMedia( 'files' );
        $output = array();

        foreach( $files as $file )
        {
            $output[] = $this->getOutputFromFile( $file );
        }

        return Response::json($output, 200);
    }

    function getOutputFromFile( $file )
    {
        return (object)[
            "id" => $file->id,
            "name" => $file->name,
            "size" => $file->size,
            "url" => $file->getUrl()
        ];
    }

    public function post( Request $request )
    {
        $componentId = $request->input( 'componentId' );

        /** @var Component $component */
        $component = Component::where( 'id', '=', $componentId )->first();

        if( $component == null )
        {
            return Response::json('error', 400);
        }

        $renderable = $component->renderable;
        $media = $renderable->addMediaFromRequest('file')->toMediaCollection('files');

        $renderable->path = $media->getUrl();
        $renderable->save();

        return Response::json( $this->getOutputFromFile( $media ), 200);
    }

    public function remove( Request $request )
    {
        $componentId = $request->input( 'componentId' );

        /** @var Component $component */
        $component = Component::where( 'id', '=', $componentId )->first();

        if( $component == null )
        {
            return Response::json('error', 400);
        }

        $files = $component->renderable->getMedia( 'files' );

        foreach( $files as $file )
        {
            if( $file->id == $request->input( 'fileId' ) ) {
                $file->delete();
            }
        }

        return Response::json([ 'response' => 'ok' ], 200);
    }
}
