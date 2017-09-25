<?php
namespace KirbySync;
use str;

class WriteContents {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
    }

    // Create content
    function createContent($id, $content) {
        $uids = str::split($id, '/');
        $pages = json_decode($content, true);
        $page_uid = '';
        $prefixed_uid = $this->Option->parent();

        foreach($uids as $page_id) {
            $page_uid = ltrim($page_uid . '/' . $page_id, '/');
            $prefixed_root = ltrim($prefixed_uid . '/');

            if(!page($prefixed_root . $page_id)) {
                $this->createPage(
                    $this->getObject($prefixed_uid),
                    $page_id,
                    $pages[$page_uid]['template'],
                    $pages[$page_uid]['content']
                );
            } else {
                page($prefixed_root . $page_id)->update($pages[$page_uid]['content']);
            }            
            $prefixed_uid = $prefixed_root . $page_id;
        }
    }
}