<?php
namespace KirbySync;
use str;
use Response;

class ReadContent {
    function __construct() {

    }

    // Read content
    function read($id) {
        $pages = str::split($id, '/');
        $parent_uid = '';
        foreach($pages as $page_id) {
            $root = ltrim($parent_uid . '/', '/');
            $page = page($root . $page_id);

            if($page) {
                $array[$root . $page_id] = [
                    'modified' => $page->modified(),
                    'template' => $page->template(),
                    'content' => $page->content()->toArray(),
                ];
            }
            $parent_uid = $root . $page_id;
        }
        if(isset($array)) {
            $json = json_encode($array);
            return new Response($json, 'json', 200);
        }
    }
}