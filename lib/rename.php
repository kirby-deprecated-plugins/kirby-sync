<?php
namespace KirbySync;

class Rename {
    function __construct() {
        $this->Option = new Option();
    }

    // Rename
    function rename($id) {
        $page_id = ltrim($this->Option->parent() . '/' . $id, '/');
        $new_name = get('new_name');
        $page = page($page_id);

        if($page) {
            $page->move($new_name);
        }
    }
}