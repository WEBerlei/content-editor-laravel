<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

abstract class ModuleBase extends Model
{
    public function module()
    {
        return $this->morphOne(Module::class, 'renderable');
    }

    protected abstract function doRender();

    public function render()
    {
        return $this->doRender();
    }
}
