<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Section extends Model implements Sortable
{
    use SortableTrait;

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "sections" );
    }

    public function content()
    {
        return $this->belongsTo( Content::class );
    }

    public function components()
    {
        return $this->hasMany( Component::class )->orderBy( 'order_column' );
    }

    public function render()
    {
        $v[ 'content' ] = "";

        foreach( $this->components as $component )
        {
            $v[ 'content' ] .= $component->render();
        }

        return view( 'content-editor::output.section', $v )->render();;
    }

    public function buildSortQuery()
    {
        return static::query()->where('content_id', $this->content_id);
    }
}
