<?php
namespace KirbySync;
use str;

class Trigger {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
        $this->log = '';
    }

    // Trigger on create / update
    function createUpdate($page) {    
        if($this->Option->domains()) {
            $log = '';
            foreach($this->Option->domains() as $domain => $parents) {
                $match = false;
                $this->log($domain);
                foreach($parents as $parent) {
                    $this->log($parent);
                    $this->log($page->id());
                    if(str::startsWith($page->id(), $parent)) {
                        $match = true;
                    }
                }
                if($match) {
                    $this->callNode($domain, $page);
                }
            }
        }
    }

    function log($log) {
        if($this->Option->log()) {
            $this->log .= $log . "\n";
            file_put_contents($this->Option->log(), $this->log);
        }
    }

    // Call node
    function callNode($domain, $page) {
        $this->Core->visit($domain, $page->id(), 'write', u());
    }
}