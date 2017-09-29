<?php
namespace KirbySync;

class Delete {
    function __construct() {
        $this->Option = new Option();
    }

    // Delete
    function delete($id) {
        if(!$this->Option->triggerDelete()) return;

        $page_id = ltrim($this->Option->parent() . '/' . $id, '/');
        $page = page($page_id);

        if($page) {
            $page->delete(true);
        }
    }
}