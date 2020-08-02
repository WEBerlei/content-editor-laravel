<?php

namespace WEBerlei\ContentEditorLaravel\Observers;

use WEBerlei\ContentEditorLaravel\Models\Content;
use WEBerlei\ContentEditorLaravel\Models\Section;

class ContentObserver
{
    /**
     * Handle the Content "created" event.
     *
     * @param  \WEBerlei\ContentEditorLaravel\Models\Content $content
     * @return void
     */
    public function created(Content $content)
    {
        $defaultContentSections = config( 'content-editor.defaultContent' );

        foreach( $defaultContentSections as $section )
        {
            /** @var Section $section */
            $newSection = new Section();
            $newSection->content_id = $content->id;
            $newSection->save();

            foreach( $section as $componentClass )
            {
                $newSection->createNewComponent( $componentClass );
            }
        }
    }

    /**
     * Handle the Content "updated" event.
     *
     * @param  \WEBerlei\ContentEditorLaravel\Models\Content $content
     * @return void
     */
    public function updated(Content $content)
    {
        //
    }

    /**
     * Handle the Content "deleted" event.
     *
     * @param  \WEBerlei\ContentEditorLaravel\Models\Content $content
     * @return void
     */
    public function deleted(Content $content)
    {
        //
    }

    /**
     * Handle the Content "forceDeleted" event.
     *
     * @param  \WEBerlei\ContentEditorLaravel\Models\Content $content
     * @return void
     */
    public function forceDeleted(Content $content)
    {
        //
    }
}
