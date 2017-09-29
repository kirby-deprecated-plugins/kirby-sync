<?php
namespace KirbySync;
use c;
use str;

$Option = new Option();

if(get('token') == $Option->token()) {

    $Read = new Read();
    $Write = new Write();
    $Delete = new Delete();
    $Rename = new Rename();

    kirby()->routes(array(
        array(
            'pattern' => $Option->slug() . '/(:any)/(:all)',
            'action'  => function($method, $id) use ($Read, $Write, $Delete, $Rename) {
                switch($method) {
                    case 'read':
                        return $Read->read($id);
                        break;
                    case 'write':
                        return $Write->write($id);
                        break;
                    case 'delete':
                        return $Delete->delete($id);
                        break;
                    case 'rename':
                        return $Rename->rename($id);
                        break;
                }
            }
        )
    ));
}