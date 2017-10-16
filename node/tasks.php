<?php
namespace KirbySync;
use str;
use c;

require_once __DIR__ . DS . 'tasks' . DS . 'create.php';
require_once __DIR__ . DS . 'tasks' . DS . 'update.php';
require_once __DIR__ . DS . 'tasks' . DS . 'delete.php';
require_once __DIR__ . DS . 'tasks' . DS . 'filename.php';
require_once __DIR__ . DS . 'tasks' . DS . 'blueprint.php';
require_once __DIR__ . DS . 'tasks' . DS . 'move.php';

class Tasks {
    function __construct() {
        $this->TaskCreate = new TaskCreate();
        $this->TaskUpdate = new TaskUpdate();
        $this->TaskFilename = new TaskFilename();
        $this->TaskBlueprint = new TaskBlueprint();
        $this->TaskMove = new TaskMove();
    }

    // Run
    function run($id, $data, $new_name = null) {
        $tasklist = $this->tasklist($id, $data);
        $this->execute($tasklist, $new_name);
    }

    // Tasklist
    function tasklist($id, $data_pages) {
        $uid = '';
        foreach(str::split($id, '/') as $id) {
            $uid .= $id . '/';
            $page_id = trim($uid, '/');
            $page_id_full = trim(settings::parent() . '/' . $page_id);

            $data = $data_pages[$page_id];
            $data_extra = [
                'filename_node' => $this->filenameNode($page_id_full, $data['filename']),
                'current' => $this->pageUid($page_id),
                'parents' => $this->parentId($page_id_full),
                'is_page' => true,
            ];

            $tasks[$page_id_full] = [
                'page_exists' => $this->pageExists($page_id_full),
                'data' => array_merge($data, $data_extra),
            ];
        }
        $parents = $this->parents();
        $tasks = array_merge($parents, $tasks);
        return $tasks;
    }

    // Parents
    function parents() {
        $parent_uid = '';
        $uid = '';
        $parents = [];
        foreach(str::split(settings::parent(), '/') as $id) {
            $uid .= $id . '/';
            $page_id = trim($uid, '/');
            $data = [
                'template' => settings::parentBlueprint(),
                'filename' => settings::parentBlueprint(),
                'content' => [],
                'blueprint' => [],
                'filename_node' => $this->filenameNode($page_id, settings::parentBlueprint()),
                'current' => $this->pageUid($page_id),
                'parents' => $this->parentId($page_id),
                'is_page' => false,
            ];
            $parents[$page_id] = [
                'page_exists' => $this->pageExists($page_id),
                'data' => $data
            ];
        }
        return $parents;
    }

    // Execute tasklist
    function execute($tasklist, $new_name) {
        foreach($tasklist as $id => $task) {
            if(!$task['page_exists']) {
                $this->TaskCreate->page($id, $task['data']);
            } else {
                if($task['data']['is_page']) {
                    if(settings::prefix() . $task['data']['filename'] == $task['data']['filename_node']) {
                        $this->TaskUpdate->page($id, $task['data']);
                    } else {
                        $this->TaskFilename->rename($id, $task['data']);
                    }
                }
            }
            $saved_blueprints = $this->saveBlueprint($id, $task, $saved_blueprints = []);
        }

        $last = end($tasklist);
        if($new_name) {
            $this->TaskMove->page($id, $last['data'], $new_name);
        }
    }

    // Save blueprint
    function saveBlueprint($id, $task, $saved_blueprints) {
        if(settings::blueprint()) {
            if($task['data']['is_page']) {
                if(!in_array($task['data']['template'], $saved_blueprints)) {
                    $this->TaskBlueprint->write($task['data']);
                    $saved_blueprints[] = $task['data']['template'];
                }
            }
        }
        return $saved_blueprints;
    }

    // Filename node
    function filenameNode($page_id, $filename) {
        $page = page($page_id);
        if($page) {
            $filename = pathinfo($page->textfile(), PATHINFO_FILENAME);
        }
        return $filename;
    }

    // Get page uid
    function pageUid($page_id) {
        $split = str::split($page_id, '/');
        return end($split);
    }

    // Get parents
    function parentId($uid) {
        $uris = str::split($uid, '/');
        array_pop($uris);
        return implode($uris, '/');
    }

    // Check if page exists
    function pageExists($uid) {
        if(page($uid)) return true;
        return false;
    }
}