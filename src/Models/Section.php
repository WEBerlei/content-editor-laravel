<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Section extends Model implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'content_id',
        'order_column',
    ];

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
        $v[ 'section' ] = $this;

        foreach( $this->components as $component )
        {
            $v[ 'content' ] .= $component->render();
        }

        return view( 'content-editor::output.section', $v )->render();;
    }

    public function teaser( $length = 200 )
    {
        $output = "";

        foreach( $this->components as $component )
        {
            if( !empty( $output ) )
            {
                $output .= " ";
            }

            $remainingLength = $length - strlen( $output );

            if( $remainingLength <= 0 )
            {
                break;
            }

            $output .= $component->teaser( $remainingLength );
        }

        return $output;
    }

    public function buildSortQuery()
    {
        return static::query()->where('content_id', $this->content_id);
    }

    public function createNewComponent( $class, $saveNewComponent = true )
    {
        $renderable = new $class();

        if( $renderable != null )
        {
            $component = new Component();
            $component->save();

            $renderable->initialize();
            $renderable->save();

            $component->setContentComponent($renderable);
        }

        $component->content_id = $this->content_id;
        $component->section_id = $this->id;
        $component->setHighestOrderNumber();

        if( $saveNewComponent == true )
        {
            $component->save();
        }

        return $component;
    }
}
