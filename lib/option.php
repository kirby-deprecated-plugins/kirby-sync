<?php
namespace KirbySync;
use c;

class Option {
    function parent() {
        return c::get('plugin.sync.parent', 'synced-data');
    }

    function slug() {
        return c::get('plugin.sync.slug', 'sync');
    }

    function token() {
        return c::get('plugin.sync.token', 'token');
    }

    function silence() {
        return c::get('plugin.sync.blueprint.empty', 'silence');
    }
}