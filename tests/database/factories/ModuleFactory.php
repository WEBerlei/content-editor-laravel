<?php

use \Faker\Generator;
use WEBerlei\ContentEditorLaravel\Models\Component;
use WEBerlei\ContentEditorLaravel\Models\ComponentImage;
use WEBerlei\ContentEditorLaravel\Models\ComponentTextarea;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Component::class, function (Generator $faker) {
    return [

    ];
});

$factory->define(ComponentImage::class, function (Generator $faker) {
    return [

    ];
});

$factory->define(ComponentTextarea::class, function (Generator $faker) {
    return [
        'text' => 'Ahoi from Textarea',
    ];
});
