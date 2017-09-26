<?php
namespace KirbySync;
use c;

class Option {
    function __construct() {
        $this->Kirby = kirby();
    }
    function parent() {
        return c::get('plugin.sync.parent', 'synced-data');
    }

    function silence() {
        return c::get('plugin.sync.parent.blueprint', 'silence');
    }

    function slug() {
        return c::get('plugin.sync.slug', 'sync');
    }

    function token() {
        return c::get('plugin.sync.token', 'token');
    }

    function blueprint() {
        return c::get('plugin.sync.blueprint', false);
    }

    function prefix() {
        return c::get('plugin.sync.blueprint.prefix', 'synced-');
    }

    function hub() {
        return c::get('plugin.sync.hub', false);
    }

    function domains() {
        return c::get('plugin.sync.domains');
    }

    function blueprintRoot() {
        if($this->Kirby->roots()->sync_blueprints())
            return $this->Kirby->roots()->sync_blueprints();
        else
            return $this->Kirby->roots()->blueprints();
    }
}