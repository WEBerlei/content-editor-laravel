<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ComponentFile extends ComponentBase implements HasMedia
{
    use InteractsWithMedia;

    protected static $name = 'File';
    protected static $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z"/> <path d="M14 3v4a1 1 0 0 0 1 1h4" /> <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /> <line x1="12" y1="11" x2="12" y2="17" /> <polyline points="9 14 12 17 15 14" /> </svg>';
    protected static $field = 'path';

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "component_files" );
    }

    protected function doRender()
    {
        $v[ 'component' ] = $this;

        return view( 'content-editor::output.file', $v )->render();
    }

    protected function doRenderEditor()
    {
        $v = $this->getEditorVariables();

        return view( 'content-editor::editors.file', $v )->render();
    }

    public function getComponentPreview()
    {
        if( empty( $this->path ) )
        {
            return "File";
        }

        return $this->path;
    }
}
