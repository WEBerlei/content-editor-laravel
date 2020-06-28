<?php

namespace WEBerlei\ContentEditorLaravel\Commands;

use Illuminate\Console\Command;

class ContentEditorCommand extends Command
{
    public $signature = 'content-editor';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
