<?php
namespace KirbySync;
use yaml;
use folder;
use f;

class WriteBlueprints {
    function __construct() {
        $this->Option = new Option();
    }
    function write($id, $data) {
        $data = json_decode($data, true);
        $blueprint = yaml::encode($data['blueprint']);

        $path = $this->Option->blueprintRoot() . DS . $this->Option->prefix() . $data['template'] . '.yml';

        f::write($path, $blueprint);
    }
}