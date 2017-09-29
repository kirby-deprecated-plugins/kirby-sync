<?php
namespace KirbySync;

kirby()->hook('panel.page.*', function($page, $oldPage = null) {
    $Trigger = new Trigger();
    $Trigger->hook($this->type(), $page, $oldPage);
});