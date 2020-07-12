<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class ComponentBase extends Model
{
    protected static $name = 'No Name';
    protected static $icon = 'No Icon';

    public function component()
    {
        return $this->morphOne(Component::class, 'renderable');
    }

    public function loadVueData()
    {
        $this->vue_id = $this->component->id;
        $this->vue_name = static::$name;
        $this->vue_icon = static::$icon;
        $this->vue_class = static::class;

        $preview = $this->getComponentPreview();

        if( !empty( $preview ) )
        {
            $this->vue_name = $preview;
        }
    }

    public static function getVueData()
    {
        return (object)[
            'vue_id' => 0,
            'vue_name' => static::$name,
            'vue_class' => static::class,
            'vue_icon' => static::$icon,
        ];
    }

    protected abstract function doRender();
    protected abstract function doRenderEditor();
    protected abstract function doVerify( Request $request );

    public function render()
    {
        return $this->doRender();
    }

    public function renderEditor()
    {
        return $this->doRenderEditor();
    }

    public function verify( Request $request )
    {
        return $this->doVerify( $request );
    }

    protected function returnSuccessfulVerify()
    {
        return json_encode( (object)[
            'isValid' => true,
            'newPreview' => $this->getComponentPreview(),
        ] );
    }
    protected function returnFailedVerify( array $invalidFields )
    {
        return json_encode( (object)[
            'isValid' => false,
            'invalidFields' => $invalidFields,
        ] );
    }

    public function getComponentPreview()
    {
        return '';
    }
}
