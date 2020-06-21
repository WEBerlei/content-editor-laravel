<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleImage extends ModuleBase
{
    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "module_images" );
    }

    protected function doRender()
    {
        return "<img src='$this->path'>";
    }
}
