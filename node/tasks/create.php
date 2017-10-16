<?php
namespace KirbySync;
use str;

class TaskCreate {
    function page($id, $data) {
        $parent_obj = $this->getParentObject($data['parents']);
        $this->create($id, $parent_obj, $data);
    }

    function create($id, $parent_obj, $data) {
        if(!page($id)) {
            return $parent_obj->children()->create($data['current'], settings::prefix() . $data['template'], $data['content']);
        }
        return true;
    }

    function getParentObject($uri) {
        if(!empty($uri))
            return site()->find($uri);
        else
            return site()->pages();
    }
}