<?php

use \Faker\Generator;
use WEBerlei\ContentEditorLaravel\Models\Module;
use WEBerlei\ContentEditorLaravel\Models\ModuleImage;
use WEBerlei\ContentEditorLaravel\Models\ModuleTextarea;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Module::class, function (Generator $faker) {
    return [

    ];
});

$factory->define(ModuleImage::class, function (Generator $faker) {
    return [

    ];
});

$factory->define(ModuleTextarea::class, function (Generator $faker) {
    return [
        'text' => 'Ahoi from Textarea',
    ];
});
