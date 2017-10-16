<?php
namespace KirbySync;
use str;

class TestSaveUpdate extends TestSaveCreate {
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
        $split = str::split(settings::parent(), '/');
        $split[] = 'create';
        $split[] = 'child';
        $split[] = 'grandchild';

        $uid = '';
        foreach($split as $item) {
            $uid .= $item . '/';
            $page_id = trim($uid, '/');
            $page = page($uid);
            if($page->slug() == 'create' && $page->title() != 'Update') {
                $this->status['success'] = false;
                $this->status['message'] = 'Could not update "' . $page_id . '".';
            } elseif($page->slug() == 'child' && $page->title() != 'Update child') {
                $this->status['success'] = false;
                $this->status['message'] = 'Could not update "' . $page_id . '".';
            } elseif($page->slug() == 'grandchild' && $page->title() != 'Update grandchild') {
                $this->status['success'] = false;
                $this->status['message'] = 'Could not update "' . $page_id . '".';
            }
        }
    }

    function update() {
        $this->Tasks->run('create/child/grandchild', $this->readUpdate());
    }
}