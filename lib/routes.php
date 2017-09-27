<?php
namespace KirbySync;
use c;
use str;

$Option = new Option();
$Read = new Read();
$Write = new Write();

if(get('token') == $Option->token()) {
    kirby()->routes(array(
        array(
            'pattern' => $Option->slug() . '/(:any)/(:all)',
            'action'  => function($method, $id) use ($Read, $Write) {
                switch($method) {
                    case 'read':
                        return $Read->read($id);
                        break;
                    case 'write':
                        return $Write->write($id);
                        break;
                }
            }
        )
    ));
}