<?php
namespace KirbySync;

//require_once __DIR__ . DS . 'write-blueprints.php';
require_once __DIR__ . DS . 'write-contents.php';
require_once __DIR__ . DS . 'write-parents.php';

class Write {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
        $this->WriteParents = new WriteParents();
        $this->WriteContents = new WriteContents();
        //$this->WriteBlueprints = new WriteBlueprints();
    }

    // Write
    function write($type, $id) {
        $data = $this->Core->visit(get('hub'), $id, 'content', 'read'); // CONTENT BÖR EJ BEHÖVAS
        $this->WriteParents->createParents();
        $this->WriteContents->writeData($id, $data);
    }
}