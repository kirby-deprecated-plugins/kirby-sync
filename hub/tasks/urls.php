<?php
namespace KirbySync;
use str;

class Urls {
    function hook($type, $page, $old_page = null) {
        //$Hooks = new Hooks();
        $parts = str::split($type, '.');
        $type = 'hook' . ucfirst(end($parts));
        return $this->trigger($type, $page, $old_page);
    }

    // Trigger
    function trigger($type, $page, $old_page = null) {
        if(settings::domains()) {
            $urls = [];
            foreach(settings::domains() as $domain => $parents) {
                foreach($parents as $parent) {
                    $old_page_id = ($old_page) ? $old_page->id() : null;
                    if($page && $this->match($parent, $page->id(), $old_page_id)) {
                        $urls[] = $this->{$type}($domain, $page->id(), $old_page_id);
                    }
                }
            }
            return $urls;
        }
    }

    // Match
    function match($parent, $page_id, $old_page_id) {
        if(str::startsWith($page_id, $parent)) {
            return true;
        }
        if($old_page_id && str::startsWith($old_page_id, $parent)){
            return true;
        }
        return false;
    }

    // Root
    function root($domain) {
        return $domain . '/' . settings::slug() . '/';
    }

    // Token
    function token() {
        return '?token=' . settings::token();
    }

    // Hub
    function hub() {
        return '&hub=' . urlencode(u());
    }

    function newName($page_id) {
        $split = str::split($page_id, '/');
        $new_page_slug = end($split);
        return ($page_id) ? '&new_name=' . $new_page_slug : '';
    }

    // Save is update, create and move
    function save($domain, $page_id, $old_page_id = null) {
        $u = $this->root($domain);
        $u .= 'save/' . $page_id;
        $u .= $this->token();
        $u .= $this->hub();
        return $u;
    }

    // Update url
    function hookUpdate($domain, $page_id) {
        return $this->save($domain, $page_id);
    }

    // Create url, inherit save url
    function hookCreate($domain, $page_id) {
        return $this->save($domain, $page_id, null);
    }

    // Move url, inherit save url
    function hookMove($domain, $page_id, $old_page_id) {
        $u = $this->root($domain);
        $u .= 'save/' . $old_page_id;
        $u .= $this->token();
        $u .= $this->hub();
        $u .= $this->newName($page_id);
        return $u;
    }

    // Delete url
    function hookDelete($domain, $page_id) {
        $u = $this->root($domain);
        $u .= 'delete/' . $page_id;
        $u .= $this->token();
        return $u;
    }
}