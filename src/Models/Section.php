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

    public function modules()
    {
        return $this->hasMany( Module::class )->orderBy( 'order' );
    }

    public function render()
    {
        $output = "";

        foreach( $this->modules as $module )
        {
            $output .= $module->render();
        }

        return $output;
    }

    public function buildSortQuery()
    {
        return static::query()->where('content_id', $this->content_id);
    }
}
