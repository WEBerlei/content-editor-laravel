<?php


namespace WEBerlei\ContentEditorLaravel\Http\Controllers\Api;

use Illuminate\Http\Request;
use WEBerlei\ContentEditorLaravel\Models\Component;
use WEBerlei\ContentEditorLaravel\Models\ComponentTextarea;
use WEBerlei\ContentEditorLaravel\Models\Content;
use WEBerlei\ContentEditorLaravel\Models\Section;

class ContentApiController
{
    public function get( $content_id )
    {
        $content = Content::with( [ 'sections.components.renderable' ] )->firstOrCreate( [ 'id' => $content_id ] );

        foreach( $content->sections as $section )
        {
            foreach( $section->components as $component )
            {
                $component->renderable->loadVueData();
            }
        }

        return $content;
    }

    public function render( $content_id )
    {
        $content = Content::with( [ 'sections.components.renderable' ] )->firstOrCreate( [ 'id' => $content_id ] );

        return $content->render();
    }

    public function store( Request $request, $content_id )
    {
        $content = Content::with( [ 'components', 'sections.components' ] )->firstOrCreate( [ 'id' => $content_id ] );

        $sections = $request->input( 'sections' );
        $sectionOrder = array();
        $componentIds = array();

        foreach( $sections as $sectionData )
        {
            $section = null;

            if( $sectionData[ "id" ] == 0 )
            {
                $section = new Section();
                $section->content_id = $content->id;
                $section->save();
            }
            else
            {
                $section = Section::firstOrCreate( [ 'id' => $sectionData[ "id" ] ] );
            }

            $sectionOrder[] = $section->id;
            $componentOrder = array();

            foreach( $sectionData[ 'components' ] as $componentData )
            {
                $component = null;

                if( $componentData[ "id" ] == 0 )
                {
                    $component = new Component();
                    $component->save();

                    $renderable = new $componentData[ "class" ]();
                    $renderable->save();

                    $component->setContentComponent( $renderable );
                }
                else
                {
                    $component = Component::firstOrCreate( [ 'id' => $componentData[ "id" ] ] );
                }

                $component->content_id = $content->id;
                $component->section_id = $section->id;
                $component->save();

                $componentOrder[] = $component->id;
                $componentIds[] = $component->id;
            }

            Component::setNewOrder( $componentOrder );
        }

        Section::setNewOrder( $sectionOrder );

        /** @var Component $component */
        foreach( $content->components as $component )
        {
            if( !in_array( $component->id, $componentIds ) )
            {
                $component->delete();
            }
        }

        return $sections;
    }
}