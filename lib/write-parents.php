<?php
namespace KirbySync;
use str;

class WriteParents {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
    }
    function createParents() {
        $parents = str::split($this->Option->parent(), '/');

        $parent_uid = '';
        foreach($parents as $page_id) {
            $root = ltrim($parent_uid . '/');

            if(!page($root . $page_id)) {
                $this->Core->createPage(
                    $this->Core->getObject($parent_uid),
                    $page_id,
                    $this->Option->silence(),
                    []
                );
            } else {
                page($root . $page_id)->update(['title' => 'Update']);
            }
            $parent_uid = $root . $page_id;
        }
    }
}