<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ComponentTextarea extends ComponentBase
{
    protected static $name = 'Textarea';
    protected static $icon = '<svg class="svg-icon" viewBox="0 0 20 20">
                        <path fill="none" d="M12.871,9.337H7.377c-0.304,0-0.549,0.246-0.549,0.549c0,0.303,0.246,0.55,0.549,0.55h5.494
                                        c0.305,0,0.551-0.247,0.551-0.55C13.422,9.583,13.176,9.337,12.871,9.337z M15.07,6.04H5.179c-0.304,0-0.549,0.246-0.549,0.55
                                        c0,0.303,0.246,0.549,0.549,0.549h9.891c0.303,0,0.549-0.247,0.549-0.549C15.619,6.286,15.373,6.04,15.07,6.04z M17.268,1.645
                                        H2.981c-0.911,0-1.648,0.738-1.648,1.648v10.988c0,0.912,0.738,1.648,1.648,1.648h4.938l2.205,2.205l2.206-2.205h4.938
                                        c0.91,0,1.648-0.736,1.648-1.648V3.293C18.916,2.382,18.178,1.645,17.268,1.645z M17.816,13.732c0,0.607-0.492,1.1-1.098,1.1
                                        h-4.939l-1.655,1.654l-1.656-1.654H3.531c-0.607,0-1.099-0.492-1.099-1.1v-9.89c0-0.607,0.492-1.099,1.099-1.099h13.188
                                        c0.605,0,1.098,0.492,1.098,1.099V13.732z"></path>
                    </svg>';

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
        $v[ 'component' ] = $this;

        return view( 'content-editor::editors.textarea', $v )->render();
    }

    public function getComponentPreview()
    {
        return $this->getPreviewFromString( $this->text, parent::getComponentPreview() );
    }

    protected function getPreviewFromString( $string, $default = "Textarea" )
    {
        if( strlen( $string ) == 0 )
        {
            return $default;
        }

        $preview = substr( $string, 0, 50 );

        if( strlen( $string ) > 53 )
        {
            $preview .= '...';
        }

        return $preview;
    }

    protected function doVerify(Request $request)
    {
        if( $request->has( 'data_text' ) == false )
        {
            return $this->returnFailedVerify( [ 'data_text' ] );
        }

        $this->text = $request->input( 'data_text' );
        $this->save();

        return $this->returnSuccessfulVerify();
    }
}
