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
    }

    // Write
    function write($type, $id) {
        $page = page($id);
        switch($type) {
            case 'content':
                return $this->setContent($id, $this->getContent($id));
                break;
            case 'blueprint':
                return $this->blueprint($page);
                break;
        }
    }

    // Get content from read api
    function getContent($id) {
        $url = u() . '/' . $this->Option->slug() . '/content/' . $id;
        $url .= '?token=' . $this->Option->token();
        $url .= '&method=read';

        $content = $this->Core->getContent($url);
        return $content;
    }

    // Write parents and content
    function setContent($id, $content) {
        $this->WriteParents->createParents();
        $this->WriteContents->createContent($id, $content);
    }
}