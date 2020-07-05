<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

abstract class ComponentBase extends Model
{
    public function module()
    {
        return $this->morphOne(Component::class, 'renderable');
    }

    protected abstract function doRender();
    protected abstract function doRenderEditor();

    public function render()
    {
        return $this->doRender();
    }

    public function renderEditor()
    {
        return $this->doRenderEditor();
    }
}
