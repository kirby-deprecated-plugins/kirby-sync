<?php
namespace KirbySync;
use str;
use Response;

require_once __DIR__ . DS . 'read-content.php';
//require_once __DIR__ . DS . 'read-blueprint.php';

class Read {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
        $this->ReadContent = new ReadContent();
        //$this->ReadBlueprint = new ReadBlueprint();
    }
    function read($type, $id) {
        return $this->ReadContent->read($id);
    }

    // Read status
    function status($page) {
        if($page) {
            $json = json_encode([
                'match' => true,
                'modified' => $page->modified(),
                'blueprint' => b::file($page->template()),
                'textfile' => $page->textfile()
            ]);
        } else {
            $json = json_encode([
                'match' => false,
            ]);
        }
        return new Response($json, 'json', 200);
    }
}