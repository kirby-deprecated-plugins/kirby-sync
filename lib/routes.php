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
            'action'  => function($type, $id) use ($Read, $Write){
                switch(get('method')) {
                    case 'read':
                        return $Read->read($type, $id);
                        break;
                    case 'write':
                        return $Write->write($type, $id);
                        break;
                }
            }
        )
    ));
}