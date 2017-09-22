<?php
kirby()->routes(array(
    array(
        'pattern' => c::get('plugin.sync.slug', 'sync') . '/(:any)/(:all)',
        'action'  => function($type, $id) {
            if(get('token') != c::get('plugin.sync.token', 'token')) {
                return new Response('Wrong token!', 'html', 404);
            }

            $method = (c::get('plugin.sync.hub')) ? 'read' : 'write';
            if(get('method') == 'read' || get('method') == 'write') {
                $method = get('method');
            }

            if($method == 'read') {
                require_once __DIR__ . DS . 'read.php';
                $read = new SyncRead();
                return $read->read($type, $id);
            } else {
                require_once __DIR__ . DS . 'write.php';

                $write = new SyncWrite();
                return $write->write($type, $id);
            }
        }
    )
));