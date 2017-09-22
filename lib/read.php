<?php
class SyncRead {
    function read($type, $id) {
        $page = page($id);
        switch($type) {
            case 'status':
                return $this->status($page);
                break;
            case 'content':
                return $this->content($page);
                break;
            case 'blueprint':
                return $this->blueprint($page);
                break;
        }
    }

    // Read status
    function status($page) {
        if($page) {
            $json = json_encode([
                'match' => true,
                'modified' => $page->modified(),
                'blueprint' => b::file($page->template()),
                'textfile' => $page->textfile()
            ]);
        } else {
            $json = json_encode([
                'match' => false,
            ]);
        }
        return new Response($json, 'json', 200);
    }

    // Read content
    function content($page) {
        $pages = str::split($page, '/');
        $parent_uid = '';
        foreach($pages as $page_id) {
            $root = $this->getRoot($parent_uid);
            $page = page($root . $page_id);

            if($page) {
                $array[$root . $page_id] = [
                    'modified' => $page->modified(),
                    'template' => $page->template(),
                    'content' => $page->content()->toArray(),
                ];
            }
            $parent_uid = $root . $page_id;
        }
        if(isset($array)) {
            $json = json_encode($array);
            return new Response($json, 'json', 200);
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

    // Read blueprint
    function blueprint($page) {
        $blueprint = b::blueprint($page->template());
        $output = yaml::encode($blueprint);
        return new Response($output, 'html', 200);
    }
}