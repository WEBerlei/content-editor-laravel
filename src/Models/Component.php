<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Component extends Model implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'content_id',
        'section_id',
        'order_column',
        'renderable_id',
        'renderable_type',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "components" );
    }

    public function setContentComponent( ComponentBase $component )
    {
        $this->renderable()->associate( $component )->save();
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

    public function teaser( $length = 200 )
    {
        if( $this->renderable != null )
        {
            return $this->renderable->teaser( $length );
        }
        
        return "";
    }

    public function render()
    {
        if( $this->renderable == null )
        {
            throw new \Exception( 'No content module loaded' );
        }

        return $this->renderable->render();
    }

    public function renderEditor()
    {
        if( $this->renderable == null )
        {
            throw new \Exception( 'No content module loaded' );
        }

        return $this->renderable->renderEditor();
    }

    public function verify( Request $request )
    {
        if( $this->renderable == null )
        {
            throw new \Exception( 'No content module loaded' );
        }

        return $this->renderable->verify( $request );
    }

    public function buildSortQuery()
    {
        return static::query()->where('section_id', $this->section_id);
    }
}
