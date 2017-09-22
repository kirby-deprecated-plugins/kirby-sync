<?php
kirby()->routes(array(
    array(
        'pattern' => c::get('plugin.sync.slug', 'sync') . '/(:any)/(:all)',
        'filter' => function($route) {
            if(get('token') == '' || get('token') != c::get('plugin.sync.token', 'token')) {
                return false;
            }
        },
        'action'  => function($type, $id) {
            $method = (c::get('plugin.sync.hub')) ? 'read' : 'write';
            if(get('method') == 'read' || get('method') == 'write') {
                $method = get('method');
            }

            if($method == 'read') {
                require_once __DIR__ . DS . 'read.php';
                $read = new SyncRead();
                return $read->read($type, $id);
            } elseif($method == 'write') {
                require_once __DIR__ . DS . 'write.php';
                $write = new SyncWrite();
                return $write->write($type, $id);
            }
        }
    )
));