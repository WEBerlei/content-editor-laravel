<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentTextarea extends ComponentBase
{
    protected $fillable = [
        'text',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "component_textareas" );
    }

    protected function doRender()
    {
        return $this->text;
    }

    protected function doRenderEditor()
    {
        return "ModuleTextareaEditor";
    }
}
