<?php
namespace KirbySync;
use str;

class Trigger {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
        $this->log = '';
    }

    // Hook
    function hook($type, $page, $oldPage) { 
        if($this->Option->domains()) {
            $log = '';
            foreach($this->Option->domains() as $domain => $parents) {
                $match = false;
                $this->log($domain);
                foreach($parents as $parent) {
                    $this->log('Parent: ' . $parent);
                    $this->log('Page id:' . $page->id());
                    if(str::startsWith($page->id(), $parent)) {
                        $match = true;
                    } elseif($oldPage && str::startsWith($oldPage->id(), $parent)) {
                        $match = true;
                    }
                }
                if($match) {
                    $this->log('Match found: '. $domain);
                    $this->log('Method: '. $type);
                    switch($type) {
                        case 'panel.page.create':
                            $this->callNode($domain, 'write', $page);
                        case 'panel.page.update':
                            $this->callNode($domain, 'write', $page);
                            break;
                        case 'panel.page.delete':
                            $this->callNode($domain, 'delete', $page);
                            break;
                        case 'panel.page.move':
                            $this->callRename($domain, $page, $oldPage);
                            break;
                    }
                }
            }
        }
    }

    // Log
    function log($log) {
        if($this->Option->log()) {
            $this->log .= $log . "\n";
            file_put_contents($this->Option->log(), $this->log);
        }
    }

    // Call rename
    function callRename($domain, $page, $oldPage) {
        $pages_ids = str::split($page->id(), '/');

        $url = $this->Core->visitUrl($domain, $oldPage->id(), 'rename');
        $url .= '&new_name=' . end($pages_ids);

        $this->log('Visit: ' . $url);
        $this->Core->visit($url); 
    }

    // Call node
    function callNode($domain, $method, $page) {
        $url = $this->Core->visitUrl($domain, $page->id(), $method, u());
        $this->log('Visit: ' . $url);
        $this->Core->visit($url);
    }
}