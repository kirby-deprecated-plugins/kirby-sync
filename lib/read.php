<?php
namespace KirbySync;
use str;
use Response;
use b;

class Read {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
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
                    'template' => $page->intendedTemplate(),
                    'content' => $page->content()->toArray(),
                    'blueprint' => b::blueprint($page->intendedTemplate())
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