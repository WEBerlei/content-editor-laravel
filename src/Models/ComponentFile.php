<?php


namespace WEBerlei\ContentEditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ComponentFile extends ComponentBase
{
    protected static $name = 'File';
    protected static $icon = '<svg class="svg-icon" viewBox="0 0 20 20">
							<path fill="none" d="M17.206,5.45l0.271-0.27l-4.275-4.274l-0.27,0.269V0.9H3.263c-0.314,0-0.569,0.255-0.569,0.569v17.062
								c0,0.314,0.255,0.568,0.569,0.568h13.649c0.313,0,0.569-0.254,0.569-0.568V5.45H17.206z M12.932,2.302L16.08,5.45h-3.148V2.302z
								 M16.344,17.394c0,0.314-0.254,0.569-0.568,0.569H4.4c-0.314,0-0.568-0.255-0.568-0.569V2.606c0-0.314,0.254-0.568,0.568-0.568
								h7.394v4.55h4.55V17.394z"></path>
						</svg>';

    public function __construct(array $attributes = [])
    {
        $this->setTable( config( 'content-editor.table_prefix' ) . "component_files" );
    }

    protected function doRender()
    {
        if( empty( $this->path ) )
        {
            return '';
        }

        return "<a href='$this->path'>$this->path</a>";
    }

    protected function doRenderEditor()
    {
        $v[ 'component' ] = $this;

        return view( 'content-editor::editors.file', $v )->render();
    }

    public function getComponentPreview()
    {
        if( empty( $this->path ) )
        {
            return "File";
        }

        return $this->path;
    }

    protected function doVerify(Request $request)
    {
        if( $request->has( 'data_path' ) == false )
        {
            return $this->returnFailedVerify( [ 'data_path' ] );
        }

        $this->path = $request->input( 'data_path' );
        $this->save();

        return $this->returnSuccessfulVerify();
    }
}