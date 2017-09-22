<?php
class SyncWrite {
    function write($type, $id) {
        $page = page($id);
        switch($type) {
            case 'content':
                return $this->content($page);
                break;
            case 'blueprint':
                return $this->blueprint($page);
                break;
        }
    }

    function content($id) {
        $url = u() . '/sync/content/' . $id . '?token=token&method=read'; // TOKEN!!!
        $content = $this->get($url);
        $this->create($id, $content);
    }

    // cURL get
    function get($url) {
		$ch = curl_init();  
 
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	 
		$output = curl_exec($ch);
	 
		curl_close($ch);
		return $output;
    }

    function parentUid() {
        return c::get('plugin.serp.parent', 'synced-data');
    }
    
    // Create parents and content
    function create($id, $content) {
        $this->createParents();
        $this->createContent($id, $content);
    }

    // Create parents
    function createParents() {
        $parents = str::split($this->parentUid(), '/');

        $parent_uid = '';
        foreach($parents as $page_id) {
            $root = $this->getRoot($parent_uid);
            if(!page($root . $page_id)) {
                $this->createPage(
                    $this->getObject($parent_uid),
                    $page_id,
                    'silence',
                    []
                );
            } else {
                page($root . $page_id)->update(['title' => 'Update']);
            }
            $parent_uid = $root . $page_id;
        }
    }

    // Create content
    function createContent($id, $content) {
        $uids = str::split($id, '/');
        $pages = json_decode($content, true);
        $page_uid = '';
        $prefixed_uid = $this->parentUid();

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

    // Get root and prevent slash as first character
    function getRoot($uid) {
        if($uid) {
            return $uid . '/';
        } else {
            return $uid;
        }
    }

    // Get object
    function getObject($parent_uid) {
        if($parent_uid != '') {
            $object = site()->find($parent_uid);
        } else {
            $object = site()->pages();
        }
        return $object;
    }

    // Create page
    function createPage($object, $page_id, $template, $data) {
        $newPage = $object->children()->create($page_id, $template, $data);
        return $newPage;
    }
}