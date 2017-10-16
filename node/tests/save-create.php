<?php
namespace KirbySync;
use str;

class TestSaveCreate {
    function __construct() {
        $this->TaskDelete = new TaskDelete();
        $this->Tasks = new Tasks();
        $this->status = ['success' => true];
    }

    function run() {
        $this->refresh();
        $this->testRefresh();
        $this->refreshBlueprint();
        $this->testRefreshBlueprint();
        $this->create();
        $this->testCreate();
        return json_encode($this->status);
    }

    function read() {
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
                    'title' => 'Create'
                ],
                'blueprint' => $blueprint,
            ],
            'create/child' => [
                'template' => 'create',
                'filename' => 'create',
                'content' => [
                    'title' => 'Create child'
                ],
                'blueprint' => $blueprint,
            ],
            'create/child/grandchild' => [
                'template' => 'create',
                'filename' => 'create',
                'content' => [
                    'title' => 'Create grandchild'
                ],
                'blueprint' => $blueprint,
            ]
        ];

        return $data;
    }

    function testRefresh() {
        if(page($this->parentRoot())) {
            $this->status['success'] = false;
            $this->status['message'] = 'Did not delete all pages.';
        }
    }

    function testCreate() {
        $split = str::split(settings::parent(), '/');
        $split[] = 'create';
        $split[] = 'child';
        $split[] = 'grandchild';

        $uid = '';
        foreach($split as $item) {
            $uid .= $item . '/';
            $page_id = trim($uid, '/');
            $page = page($uid);
            if(!$page) {
                $this->status['success'] = false;
                $this->status['message'] = 'Could not create "' . $page_id . '".';
            }
            $this->testBlueprint($page->intendedTemplate());
        }
    }

    function testBlueprint($template) {
        $path = settings::blueprintRoot() . DS . $template . '.yml';
        $match = settings::blueprintRoot() . DS . settings::prefix() . settings::parentBlueprint() . '.yml';

        if($path != $match) {
            if(!file_exists($path)) {
                $this->status['success'] = false;
                $this->status['message'] = 'Could not create blueprint "' . $path . '".';
            }
        }
    }

    function parentRoot() {
        $split = str::split(settings::parent(), '/');
        return $split[0];
    }

    function create() {
        $this->Tasks->run('create/child/grandchild', $this->read());
    }

    function refresh() {
        $this->TaskDelete->delete($this->parentRoot());
    }

    function refreshBlueprint() {
        $query = settings::blueprintRoot() . DS . '*';
        foreach(glob($query) as $file) {
            unlink($file);
        }
    }

    function testRefreshBlueprint() {
        $query = settings::blueprintRoot() . DS . '*';
        if(!empty(glob($query))) {
            $this->status['success'] = false;
            $this->status['message'] = 'Could not refresh blueprint.';
        }
    }
}