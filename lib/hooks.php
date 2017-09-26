<?php
namespace KirbySync;

$kirby->set('hook',
    [
        'panel.page.create',
        'panel.page.update'
    ],
    function($page) {
        $Trigger = new Trigger();
        $Trigger->createUpdate($page);
    }
);