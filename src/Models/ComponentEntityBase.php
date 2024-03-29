<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ComponentEntityBase extends ComponentBase
{
    protected static $name = 'Entity';
    protected static $icon = '<svg class="svg-icon" viewBox="0 0 20 20">
        <path fill="none" d="M7.228,11.464H1.996c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
            c0.723,0,1.308-0.586,1.308-1.308v-5.232C8.536,12.051,7.95,11.464,7.228,11.464z M7.228,17.351c0,0.361-0.293,0.654-0.654,0.654
            H2.649c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
             M17.692,11.464H12.46c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
            c0.722,0,1.308-0.586,1.308-1.308v-5.232C19,12.051,18.414,11.464,17.692,11.464z M17.692,17.351c0,0.361-0.293,0.654-0.654,0.654
            h-3.924c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.293-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
             M7.228,1H1.996C1.273,1,0.688,1.585,0.688,2.308V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232c0.723,0,1.308-0.585,1.308-1.308
            V2.308C8.536,1.585,7.95,1,7.228,1z M7.228,6.886c0,0.361-0.293,0.654-0.654,0.654H2.649c-0.361,0-0.654-0.292-0.654-0.654V2.962
            c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.292,0.654,0.654V6.886z M17.692,1H12.46c-0.723,0-1.308,0.585-1.308,1.308
            V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232C18.414,8.848,19,8.263,19,7.54V2.308C19,1.585,18.414,1,17.692,1z M17.692,6.886
            c0,0.361-0.293,0.654-0.654,0.654h-3.924c-0.361,0-0.654-0.292-0.654-0.654V2.962c0-0.361,0.293-0.654,0.654-0.654h3.924
            c0.361,0,0.654,0.292,0.654,0.654V6.886z"></path>
    </svg>';
    protected static $field = 'entity_id';
    protected static $selectNameField = 'id';
    protected static $entity = Content::class;

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "component_entities" );
    }

    public function initialize()
    {
        $entities = $this->getAvailableEntities();

        if( count( $entities ) > 0 )
        {
            $this->{static::$field} = array_key_first( $entities );
        }
    }

    protected function doRender()
    {
        $v[ 'entity' ] = (static::$entity)::where( 'id', '=', $this->entity_id )->first();

        return view( 'content-editor::output.entity', $v )->render();
    }

    protected function doRenderEditor()
    {
        $v = $this->getEditorVariables();
        $v[ 'entities' ] = $this->getAvailableEntities();

        return view( 'content-editor::editors.entity', $v )->render();
    }

    protected function getAvailableEntities()
    {
        return (static::$entity)::all()->pluck( static::$selectNameField, 'id' )->toArray();
    }

    public function getComponentPreview()
    {
        if( $this->entity_id == 0 )
        {
            return static::$name;
        }

        $entity = (static::$entity)::where( 'id', '=', $this->entity_id )->first();

        return static::$name . ": " . $entity->{static::$field};
    }
}
