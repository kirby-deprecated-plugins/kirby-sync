<?php
namespace KirbySync;
use c;
use str;
use response;
use tpl;

kirby()->routes(array(
    [
        'pattern' => settings::slug() . '/save/(:all)',
        'action' => function($id) {
            $Tasks = new Tasks();
            // http://localhost/plugins/node/sync/save/level1/level2/level3?token=token&hub=http%3A%2F%2Flocalhost%2Fplugins%2Fsync&new_name=hahaha
            $url = urldecode(get('hub')) . '/';
            $url .= settings::slug() . '/read/';
            $url .= $id . '?token=' . settings::token();

            $Fetch = new Fetch();
            $read = json_decode($Fetch->visit($url), true);
            $Tasks->run($id, $read, get('new_name'));
        }
    ],
    [
        'pattern' => settings::slug() . '/delete/(:all)',
        'action' => function($id) {
            $TaskDelete = new TaskDelete();
            // http://localhost/plugins/node/sync/delete/projects?token=token
            $url = trim(settings::parent() . '/' . $id, '/');
            $TaskDelete->delete($url);
        }
    ],
    [
        'pattern' => settings::slug() . '-test',
        'action' => function() {
            require_once __DIR__ . DS . 'tests' . DS . 'save-create.php';
            require_once __DIR__ . DS . 'tests' . DS . 'save-update.php';
            require_once __DIR__ . DS . 'tests' . DS . 'save-filename.php';

            $TestSaveCreate = new TestSaveCreate();
            $TestSaveUpdate = new TestSaveUpdate();
            $TestSaveFilename = new TestSaveFilename();

            $create = json_decode($TestSaveCreate->run(), true);
            $update = json_decode($TestSaveUpdate->run(), true);
            $filename = json_decode($TestSaveFilename->run(), true);

            if(!$create['success'])
                return new Response(json_encode($create), 'json', 200);
            if(!$update['success'])
                return new Response(json_encode($update), 'json', 200);
            if(!$filename['success'])
                return new Response(json_encode($filename), 'json', 200);

            return new Response(json_encode(['success' => true]), 'json', 200);
        }
    ],
    [
        'pattern' => settings::slug() . '-test/(:any)/(:any)',
        'action' => function($hook, $name) {
            require_once __DIR__ . DS . 'tests' . DS . 'save-create.php';
            require_once __DIR__ . DS . 'tests' . DS . 'save-update.php';
            require_once __DIR__ . DS . 'tests' . DS . 'save-filename.php';
            require_once __DIR__ . DS . 'tests' . DS . 'save-move.php';

            if($hook == 'save') {
                switch($name) {
                    case 'create':
                        $TestSaveCreate = new TestSaveCreate();
                        $content = $TestSaveCreate->run();
                        break;
                    case 'update':
                        $TestSaveUpdate = new TestSaveUpdate();
                        $content = $TestSaveUpdate->run();
                        break;
                    case 'filename':
                        $TestSaveFilename = new TestSaveFilename();
                        $content = $TestSaveFilename->run();
                        break;
                    case 'move':
                        $TestSaveMove = new TestSaveMove();
                        $content = $TestSaveMove->run();
                        break;
                }
            }
            return new Response($content, 'json', 200);
        }
    ],
    [
        'pattern' => settings::slug() . '-test/(:any)',
        'action' => function($name) {
            require_once __DIR__ . DS . 'tests' . DS . 'save-create.php';
            require_once __DIR__ . DS . 'tests' . DS . 'delete.php';

            $TestSaveDelete = new TestSaveDelete();
            $content = $TestSaveDelete->run();

            return new Response($content, 'json', 200);
        }
    ]
));