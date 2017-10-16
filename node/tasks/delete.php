<?php
namespace KirbySync;

class TaskDelete {
    function delete($id) {
        $page = page($id);

        if($page) {
            $page->delete(true);
        }
    }
}