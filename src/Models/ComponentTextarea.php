<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ComponentTextarea extends ComponentBase
{
    protected static $name = 'Textarea';
    protected static $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-letter-case" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z"/> <circle cx="18" cy="16" r="3" /> <line x1="21" y1="13" x2="21" y2="19" /> <path d="M3 19l5 -13l5 13" /> <line x1="5" y1="14" x2="11" y2="14" /> </svg>';

    protected $fillable = [
        'text',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "component_textareas" );
    }

    protected function doRender()
    {
        $v[ 'component' ] = $this;

        return view( 'content-editor::output.textarea', $v )->render();
    }

    protected function doRenderEditor()
    {
        $v = $this->getEditorVariables();

        return view( 'content-editor::editors.textarea', $v )->render();
    }

    public function teaser( $length = 200 )
    {
        return $this->getPreviewFromString( $this->getTextForPreview(), $length, "" );
    }

    public function getComponentPreview()
    {
        return $this->getPreviewFromString( $this->getTextForPreview(), 50, parent::getComponentPreview() );
    }

    protected function getTextForPreview()
    {
        return $this->text;
    }

    protected function getPreviewFromString( $string, $length = 50, $default = "Textarea" )
    {
        if( strlen( $string ) == 0 )
        {
            return $default;
        }

        $preview = substr( $string, 0, $length );

        if( strlen( $string ) > $length + 3 )
        {
            $preview .= '...';
        }

        return $preview;
    }
}
