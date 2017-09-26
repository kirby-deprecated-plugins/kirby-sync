<?php
namespace KirbySync;
use str;
use yaml;
use f;

class WriteContents {
    function __construct() {
        $this->Core = new Core();
        $this->Option = new Option();
    }

    // Write data
    function writeData($id, $content) {
        $uids = str::split($id, '/');
        $pages = json_decode($content, true);
        $page_uid = '';
        $full_uid = $this->Option->parent();

        foreach($uids as $page_id) {
            $page_uid = $this->pageUid($page_uid, $page_id);
            $data = [
                'content' => $pages[$page_uid]['content'],
                'template' => $pages[$page_uid]['template'],
                'blueprint' => $pages[$page_uid]['blueprint'],
                'page_id' => $page_id,
                'root' => $this->root($full_uid),
                'page_uid' => $page_uid,
                'full_parent_uid' => $full_uid
            ];
            
            $this->writeContent($data);

            if($this->Option->blueprint()) {
                $this->writeBlueprint($data);
            }

            $full_uid = $this->root($full_uid) . $page_id;
        }
    }

    // Full page uid without parent
    function pageUid($page_uid, $page_id) {
        return ltrim($page_uid . '/' . $page_id, '/');
    }

    // Full page parent
    function root($full_uid) {
        return ltrim($full_uid . '/', '/');
    }

    // Write content
    function writeContent($data) {
        if(!page($data['root'] . $data['page_id'])) {
            $this->Core->createPage(
                $this->Core->getObject($data['full_parent_uid']),
                $data['page_id'],
                $data['template'],
                $data['content']
            );
        } else {
            page($data['root'] . $data['page_id'])->update($data['content']);
        }
    }

    // Write blueprint
    function writeBlueprint($data) {
        $blueprint = yaml::encode($data['blueprint']);            
        $blueprint_path = $this->Option->blueprintRoot() . DS . $this->Option->prefix() . $data['template'] . '.yml';
        f::write($blueprint_path, $blueprint);
    }
}