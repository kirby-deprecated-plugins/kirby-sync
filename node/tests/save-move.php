<?php
namespace KirbySync;
use str;

class TestSaveMove extends TestSaveUpdate {
    function __construct() {
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
                'template' => 'create',
                'filename' => 'create',
                'content' => [
                    'title' => 'Update'
                ],
                'blueprint' => $blueprint,
            ],
            'create/child' => [
                'template' => 'create',
                'filename' => 'create',
                'content' => [
                    'title' => 'Update child'
                ],
                'blueprint' => $blueprint,
            ],
            'create/child/grandchild' => [
                'template' => 'create',
                'filename' => 'create',
                'content' => [
                    'title' => 'Update grandchild'
                ],
                'blueprint' => $blueprint,
            ]
        ];

        return $data;
    }

    function testUpdate() {
        $old_id = settings::parent() . '/create/child/grandchild';
        $new_id = settings::parent() . '/create/child/renamed';

        if(page($old_id)) {
            $this->status['success'] = false;
            $this->status['message'] = 'Old page ' . $old_id . ' did not get moved';
        } elseif(!page($new_id)) {
            $this->status['success'] = false;
            $this->status['message'] = 'New page ' . $new_id . ' missing';
        }
    }

    function update() {
        $this->Tasks->run('create/child/grandchild', $this->readUpdate(), 'renamed');
    }
}