<?php
if(!file_exists(kirby()->roots()->plugins() . DS . 'kirby-blueprint-reader')) {
    require_once __DIR__ . DS. 'kirby-blueprint-reader' . DS . 'kirby-blueprint-reader.php';
}

require_once __DIR__ . DS. 'lib' . DS . 'registry.php';
require_once __DIR__ . DS. 'lib' . DS . 'routes.php';

//http://localhost/plugins/sync/sync/blueprint/projects/project-b?token=token