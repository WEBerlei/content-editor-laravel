<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleTextarea extends ModuleBase
{
    protected $fillable = [
        'text',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "module_textareas" );
    }

    protected function doRender()
    {
        return $this->text;
    }
}
