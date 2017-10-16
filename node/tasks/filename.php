<?php
namespace KirbySync;

class TaskFilename {
    function __construct() {
        $this->kirby = kirby();
    }

    function rename($id, $data) {
        $page = page($id);
        $root = $page->root() . DS;
        $extension = $this->kirby->option('content.file.extension');
        
        $from = $root . $data['filename_node'] . '.' . $extension;
        $to = $root . settings::prefix() . $data['filename'] . '.' . $extension;

        if(file_exists($from)) {
            return rename($from, $to);
        }
    }
}