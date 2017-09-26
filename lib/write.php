<?php
namespace KirbySync;

require_once __DIR__ . DS . 'write-blueprints.php';
require_once __DIR__ . DS . 'write-contents.php';
require_once __DIR__ . DS . 'write-parents.php';

class Write {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
        $this->WriteParents = new WriteParents();
        $this->WriteContents = new WriteContents();
        $this->WriteBlueprints = new WriteBlueprints();
    }

    // Write
    function write($type, $id) {
        switch($type) {
            case 'content':
                $data = $this->Core->visit(get('hub'), $id, 'content', 'read');
                $this->WriteParents->createParents();
                $this->WriteContents->createContent($id, $data);
                break;
            case 'blueprint':
                $data = $this->Core->visit(get('hub'), $id, 'blueprint', 'read');
                return $this->WriteBlueprints->write($id, $data);
                break;
        }
    }
}