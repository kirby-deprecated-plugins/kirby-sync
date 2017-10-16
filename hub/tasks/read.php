<?php
namespace KirbySync;
use str;
use response;
use b;

class Read {
    // Read content
    function data($id) {
        $pages = str::split($id, '/');
        $parent_uid = '';
        foreach($pages as $page_id) {
            $root = ltrim($parent_uid . '/', '/');
            $page = page($root . $page_id);

            if($page) {
                $array[$root . $page_id] = [
                    'template' => $page->intendedTemplate(),
                    'filename' => pathinfo($page->textfile(), PATHINFO_FILENAME),
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