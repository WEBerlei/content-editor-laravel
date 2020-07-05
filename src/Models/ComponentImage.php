<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentImage extends ComponentBase
{
    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "component_images" );
    }

    protected function doRender()
    {
        return "<img src='$this->path'>";
    }

    protected function doRenderEditor()
    {
        return "ModuleImageEditor";
    }
}
