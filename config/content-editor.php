<?php

use WEBerlei\ContentEditorLaravel\Models\ComponentFile;
use WEBerlei\ContentEditorLaravel\Models\ComponentImage;
use WEBerlei\ContentEditorLaravel\Models\ComponentTextarea;
use WEBerlei\ContentEditorLaravel\Models\ComponentTrix;

return [
    'table_prefix' => 'content_editor__',

    'components' => [
        ComponentImage::class,
        ComponentTextarea::class,
        ComponentTrix::class,
        ComponentFile::class,
    ],

    'defaultContent' => [
        [ ComponentTrix::class ]
    ]
];
