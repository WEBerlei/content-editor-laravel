<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Module extends Model implements Sortable
{
    use SortableTrait;

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "modules" );
    }

    public function setContentModule( ModuleBase $module )
    {
        $this->renderable()->associate( $module )->save();
    }

    public function content()
    {
        return $this->belongsTo( Content::class );
    }

    public function section()
    {
        return $this->belongsTo( Section::class );
    }

    public function renderable()
    {
        return $this->morphTo();
    }

    public function render()
    {
        if( $this->renderable == null )
        {
            return 'No content module loaded';
        }

        return $this->renderable->render();
    }

    public function buildSortQuery()
    {
        return static::query()->where('section_id', $this->section_id);
    }
}
