<?php
namespace KirbySync;
use str;

class TestSaveDelete extends TestSaveCreate {
    function __construct() {
        $this->TaskDelete = new TaskDelete();
        $this->Tasks = new Tasks();
        $this->status = ['success' => true];
    }

    function run() {
        $this->create();
        $this->testCreate();
        $this->refresh();
        $this->testRefresh();
        return json_encode($this->status);
    }

    function testRefresh() {
        if(page($this->parentRoot())) {
            $this->status['success'] = false;
            $this->status['message'] = 'Did not delete all pages.';
        }
    }

    function refresh() {
        $this->TaskDelete->delete($this->parentRoot());
    }
}