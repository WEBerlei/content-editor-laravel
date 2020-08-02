<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ComponentTrix extends ComponentTextarea
{
    protected static $name = 'Text';
    protected static $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-letter-case" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <rect x="2" y="2" width="20" height="20" rx="2" />
        <path stroke="none" d="M0 0h24v24H0z"/>   <path d="M7 19l5 -13l5 13" /> <line x1="9" y1="14" x2="15" y2="14" /> </svg>';

    protected function doRender()
    {
        $v[ 'component' ] = $this;

        return view( 'content-editor::output.trix', $v )->render();
    }

    protected function doRenderEditor()
    {
        $v = $this->getEditorVariables();

        return view( 'content-editor::editors.trix', $v )->render();
    }

    function br2nl($string)
    {
        return preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, $string);
    }

    protected function getTextForPreview()
    {
        return str_replace(PHP_EOL, " - ", strip_tags( $this->br2nl( $this->text ) ) );
    }
}
