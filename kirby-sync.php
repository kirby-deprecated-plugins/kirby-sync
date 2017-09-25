<?php
if(!file_exists(kirby()->roots()->plugins() . DS . 'kirby-blueprint-reader')) {
    require_once __DIR__ . DS. 'kirby-blueprint-reader' . DS . 'kirby-blueprint-reader.php';
}

require_once __DIR__ . DS . 'lib' . DS . 'option.php';
require_once __DIR__ . DS . 'lib' . DS . 'core.php';
require_once __DIR__ . DS . 'lib' . DS . 'registry.php';
require_once __DIR__ . DS . 'lib' . DS . 'read.php';
require_once __DIR__ . DS . 'lib' . DS . 'write.php';
require_once __DIR__ . DS . 'lib' . DS . 'routes.php';
require_once __DIR__ . DS . 'lib' . DS . 'hooks.php';

//http://localhost/plugins/sync/sync/blueprint/projects/project-b?token=token