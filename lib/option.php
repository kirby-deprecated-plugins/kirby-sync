<?php
namespace KirbySync;
use c;

class Option {
    function __construct() {
        $this->Kirby = kirby();
    }

    function get($name, $data) {
        return c::get('plugin.sync.' . $name, $data);
    }
    function parent() {
        return $this->get('parent', 'synced-data');
    }

    function silence() {
        return $this->get('parent.blueprint', 'silence');
    }

    function slug() {
        return $this->get('slug', 'sync');
    }

    function token() {
        return $this->get('token', 'token');
    }

    function blueprint() {
        return $this->get('blueprint', false);
    }

    function blueprintPrefix() {
        return $this->get('blueprint.prefix', 'synced-');
    }

    function contentPrefix() {
        return $this->get('content.prefix', $this->blueprintPrefix());
    }

    function hub() {
        return $this->get('hub', false);
    }

    function domains() {
        return $this->get('domains', null);
    }

    function modified() {
        return $this->get('modified', false);
    }

    function blueprintRoot() {
        if($this->Kirby->roots()->sync_blueprints())
            return $this->Kirby->roots()->sync_blueprints();
        else
            return $this->Kirby->roots()->blueprints();
    }
}