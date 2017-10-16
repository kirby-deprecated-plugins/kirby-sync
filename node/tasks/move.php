<?php
namespace KirbySync;

class TaskMove {
    function page($id, $data, $new_name) {
        $page = page($id);
        $new_page = page($data['parents'] . '/' . $new_name);

        if($new_page) {
            $page_page->delete(true);
        }

        if($page) {
            $page->move($new_name);
        }
    }
}