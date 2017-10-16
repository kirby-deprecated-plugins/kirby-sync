<?php
namespace KirbySync;
use str;
use c;

if(c::get('plugin.sync.active', true)) {
    require_once __DIR__ . DS . 'shared' . DS . 'settings.php';
    require_once __DIR__ . DS . 'shared' . DS . 'config.php';
    require_once __DIR__ . DS . 'shared' . DS . 'fetch.php';

    if(settings::domains()) {
        require_once __DIR__ . DS . 'hub' . DS . 'hooks.php';
    } else {
        require_once __DIR__ . DS . 'node' . DS . 'config.php';
    }

    if(!empty(settings::token()) && get('token') == settings::token()) {
        if(!file_exists(kirby()->roots()->plugins() . DS . 'kirby-blueprint-reader')) {
            require_once __DIR__ . DS. 'blueprint-reader' . DS . 'kirby-blueprint-reader.php';
        }

        if(settings::domains()) {
            require_once __DIR__ . DS . 'hub' . DS . 'tasks' . DS . 'read.php';
            require_once __DIR__ . DS . 'hub' . DS . 'routes.php';
        } else {
            require_once __DIR__ . DS . 'node' . DS . 'routes.php';
            require_once __DIR__ . DS . 'node' . DS . 'tasks.php';
        }
    }

    if(!settings::domains()) {
        $path = __DIR__ . DS . 'blueprints' . DS . 'silence.yml';
        $kirby->set('blueprint', settings::prefix() . settings::parentBlueprint(), $path);
    }
}