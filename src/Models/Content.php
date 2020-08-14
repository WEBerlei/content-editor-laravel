<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "contents" );
    }

    public function components()
    {
        return $this->hasMany( Component::class );
    }

    public function sections()
    {
        return $this->hasMany( Section::class )->orderBy( 'order_column' );
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

    public function createNewSection() : Section
    {
        $section = new Section();
        $section->content_id = $this->id;
        $section->setHighestOrderNumber();
        $section->save();

        return $section;
    }
}
