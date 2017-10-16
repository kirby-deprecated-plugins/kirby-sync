<?php
namespace KirbySync;
use tpl;
use response;

kirby()->routes(array(
    [
        'pattern' => settings::slug() . '-test',
        'action' => function($name = null) {
            $content = tpl::load(__DIR__ . DS . 'tests' . DS . 'urls.php', true);
            return new Response($content, 'json', 200);
        }
    ],
    [
        'pattern' => settings::slug() . '-test/(:any)',
        'action' => function($name) {
            require_once __DIR__ . DS . 'tests' . DS . 'read.php';

            switch($name) {
                case 'read':
                    $TestRead = new TestRead();
                    $content = $TestRead->run();
                    break;
                case 'urls':
                    $content = tpl::load(__DIR__ . DS . 'tests' . DS . 'urls.php', true);
                    break;
            }
            return new Response($content, 'json', 200);
        }
    ],
    [
        'pattern' => settings::slug() . '/read/(:all)',
        'action'  => function($id) {
            $Read = new Read();
            return $Read->data($id);
        }
    ],
));