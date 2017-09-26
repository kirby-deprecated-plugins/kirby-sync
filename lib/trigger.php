<?php
namespace KirbySync;
use str;

class Trigger {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
    }

    // Trigger on create / update
    function createUpdate($page) {    
        foreach($this->Option->domains() as $domain => $parents) {
            $match = false;
            foreach($parents as $parent) {
                if(str::startsWith($page->id(), $parent))
                    $match = true;
            }
            if($match) {
                $this->callNode($domain, $page);
            }
        }
    }

    // Call node
    function callNode($domain, $page) {
        $this->Core->visit($domain, $page->id(), 'content', 'write', u());
        
        if($this->Option->blueprint()) {
            $this->Core->visit($domain, $page->id(), 'blueprint', 'write', u());
        }
    }
}