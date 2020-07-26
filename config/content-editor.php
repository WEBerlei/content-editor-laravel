<?php

use WEBerlei\ContentEditorLaravel\Models\ComponentFile;
use WEBerlei\ContentEditorLaravel\Models\ComponentImage;
use WEBerlei\ContentEditorLaravel\Models\ComponentTextarea;

return [
    'table_prefix' => 'content_editor__',

    'components' => [
        ComponentImage::class,
        ComponentTextarea::class,
        ComponentFile::class,
    ],
];
