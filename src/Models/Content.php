<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "contents" );
    }
}
