<?php
namespace KirbySync;
use Response;
use b;

class ReadBlueprint {
    function __construct() {

    }

    // Read blueprint
    function read($id) {
        $page = page($id);
        $blueprint = b::blueprint($page->template());
        $array = [
            'id' => $page->id(),
            'template' => $page->template(),
            'blueprint' => b::blueprint($page->template())
        ];
        return new Response(json_encode($array), 'json', 200);
    }
}