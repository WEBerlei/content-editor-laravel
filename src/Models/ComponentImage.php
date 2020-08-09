<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ComponentImage extends ComponentBase implements HasMedia
{
    use InteractsWithMedia;

    protected static $name = 'Image';
    protected static $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z"/> <line x1="15" y1="8" x2="15.01" y2="8" /> <rect x="4" y="4" width="16" height="16" rx="3" /> <path d="M4 15l4 -4a3 5 0 0 1 3 0l 5 5" /> <path d="M14 14l1 -1a3 5 0 0 1 3 0l 2 2" /> </svg>';
    protected static $field = 'path';

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "component_images" );
    }

    protected function doRender()
    {
        if( empty( $this->path ) )
        {
            return '';
        }

        return "<img src='$this->path'>";
    }

    protected function doRenderEditor()
    {
        $v = $this->getEditorVariables();

        return view( 'content-editor::editors.image', $v )->render();
    }

    public function getComponentPreview()
    {
        if( empty( $this->path ) )
        {
            return "Image";
        }

        return $this->path;
    }

    protected function doVerify(Request $request)
    {
        return $this->returnSuccessfulVerify();
    }
}
