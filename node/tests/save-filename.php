<?php
namespace KirbySync;
use str;

class TestSaveFilename extends TestSaveUpdate {
    function __construct() {
        $this->kirby = kirby();
        $this->TaskDelete = new TaskDelete();
        $this->Tasks = new Tasks();
        $this->status = ['success' => true];
    }

    function run() {
        $this->refresh();
        $this->testRefresh();
        $this->create();
        $this->testCreate();
        $this->update();
        $this->testUpdate();
        return json_encode($this->status);
    }

    function readUpdate() {
        $blueprint = [
            'title' => 'Create',
            'fields' => [
                'title' => [
                    'label' => 'Title',
                    'type' => 'text'
                ]
            ]
        ];

        $data = [
            'about' => [
                'template' => 'about',
                'filename' => 'about',
                'content' => [
                    'title' => 'About'
                ],
                'blueprint' => $blueprint,
            ],
            'create' => [
                'template' => 'filename',
                'filename' => 'filename',
                'content' => [
                    'title' => 'Update'
                ],
                'blueprint' => $blueprint,
            ],
            'create/child' => [
                'template' => 'filename',
                'filename' => 'filename',
                'content' => [
                    'title' => 'Update child'
                ],
                'blueprint' => $blueprint,
            ],
            'create/child/grandchild' => [
                'template' => 'filename',
                'filename' => 'filename',
                'content' => [
                    'title' => 'Update grandchild'
                ],
                'blueprint' => $blueprint,
            ]
        ];

        return $data;
    }

    function testUpdate() {
        $root = kirby()->roots()->content() . DS . str_replace('/', DS, settings::parent()) . DS;
        $extension = $this->kirby->option('content.file.extension');
        $filename = settings::prefix() . 'filename.' . $extension;
        $create = $root . 'create';
        $child = $create . DS . 'child';
        $grandchild = $child . DS . 'grandchild';

        if(!file_exists($create) || !file_exists($child) || !file_exists($grandchild)) {
            $this->status['success'] = false;
        }

        if(!file_exists($create)) {
            $this->status['message'] = 'Could not change template to ' . $create . DS . $filename;
        }

        if(!file_exists($child)) {
            $this->status['message'] = 'Could not change template to ' . $child . DS . $filename;
        }

        if(!file_exists($grandchild)) {
            $this->status['message'] = 'Could not change template to ' . $grandchild . DS . $filename;
        }
    }

    function update() {
        $this->Tasks->run('create/child/grandchild', $this->readUpdate());
    }
}