<?php
namespace KirbySync;
use str;

class TaskUpdate {
    function __construct() {
        $this->kirby = kirby();
    }
    function page($id, $data) {
        return page($id)->update($data['content']);
    }
}