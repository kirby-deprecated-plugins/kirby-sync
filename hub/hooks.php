<?php
namespace KirbySync;
use str;

require_once __DIR__ . DS . 'tasks' . DS . 'urls.php';

kirby()->hook('panel.page.*', function($page, $old_page = null) {
    $Urls_class = new Urls();
    $urls = $Urls_class->hook($this->type(), $page, $old_page);
    foreach($urls as $url) {
        $Fetch = new Fetch();
        $Fetch->visit($url);
    }
});