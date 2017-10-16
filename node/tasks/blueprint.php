<?php
namespace KirbySync;
use yaml;
use f;

class TaskBlueprint {
    // Write blueprint
    function write($data) {
        $path = $this->path($data['template']);
        $yaml = yaml::encode($data['blueprint']);
        return f::write($path, $yaml);
    }

    // Blueprint path
    function path($template) {
        return settings::blueprintRoot() . DS . settings::prefix() . $template . '.yml';
    }
}