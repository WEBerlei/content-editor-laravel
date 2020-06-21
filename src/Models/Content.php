<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "contents" );
    }

    public function modules()
    {
        return $this->hasMany( Module::class );
    }

    public function sections()
    {
        return $this->hasMany( Section::class )->orderBy( 'order' );
    }

    public function render()
    {
        $output = "";

        foreach( $this->sections as $section )
        {
            $output .= $section->render();
        }

        return $output;
    }
}
