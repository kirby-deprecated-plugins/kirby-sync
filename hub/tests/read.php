<?php
namespace KirbySync;
use yaml;

class TestRead {
    function __construct() {
        $this->Read = new Read();
    }
    function run() {
        $this->status = ['success' => true];
        $this->refresh();
        $this->createBlueprint();
        $this->testBlueprint();
        $this->testRefresh();
        $this->createPages();
        $this->testRead();

        return $this->status;
    }

    function createPages() {
        $parent_object = $this->getParentObject();
        $parent_object->children()->create('level1', 'level', [
            'title' => 'Level1'
        ]);

        $parent_object = $this->getParentObject('level1');
        $parent_object->children()->create('level2', 'level', [
            'title' => 'Level2'
        ]);

        $parent_object = $this->getParentObject('level1/level2');
        $new_page = $parent_object->children()->create('level3', 'level', [
            'title' => 'Level3'
        ]);
    }

    function getParentObject($uri = '') {
        if(!empty($uri))
            return site()->find($uri);
        else
            return site()->pages();
    }

    function refresh() {
        $page = page('level1');
        if($page) {
            $page->delete(true);
        }
    }

    function createBlueprint() {
        yaml::write(kirby()->roots()->blueprints() . DS . 'level.yml', [
            'title' => 'Level'
        ]);
    }

    function testBlueprint() {
        if(!file_exists(kirby()->roots()->blueprints() . DS . 'level.yml')) {
            $this->status = [
                'success' => false,
                'message' => 'Blueprint does not exists'
            ];
        }
    }

    function testRefresh() {
        if(page('level1')) {
            $this->status = [
                'success' => false,
                'message' => 'Refresh did not work'
            ];
        }
    }

    function testCreatePages() {
        if(!page('level1/level2/level3')) {
            $this->status = [
                'success' => false,
                'message' => 'Pages was not created correctly'
            ];
        }
    }

    function testRead() {
        $data = json_decode($this->Read->data('level1/level2'), true);

        if(array_key_exists('level3', $data)) {
            $this->status = [
                'success' => false,
                'message' => 'Level3 should not exist'
            ];
        }
        if(!array_key_exists('level1', $data)) {
            $this->status = [
                'success' => false,
                'message' => 'Level1 is missing'
            ];
        }
        if(!array_key_exists('level1/level2', $data)) {
            $this->status = [
                'success' => false,
                'message' => 'Level2 is missing'
            ];
        }
        if($data['level1/level2']['template'] != 'level') {
            $this->status = [
                'success' => false,
                'message' => 'Template is missing'
            ];
        }
        if($data['level1/level2']['filename'] != 'level') {
            $this->status = [
                'success' => false,
                'message' => 'Filename is missing'
            ];
        }
        if(empty($data['level1/level2']['content'])) {
            $this->status = [
                'success' => false,
                'message' => 'Content is missing'
            ];
        }
        if(empty($data['level1/level2']['blueprint'])) {
            $this->status = [
                'success' => false,
                'message' => 'Blueprint is missing'
            ];
        }
    }
}