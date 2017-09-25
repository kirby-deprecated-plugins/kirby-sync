<?php
namespace KirbySync;
use c;

if(c::get('plugin.sync.hub')) {
    $kirby->set('hook',
        [
            'panel.page.create',
            'panel.page.update'
        ],
        function($page) {
            $Core = new Core();
            $Option = new Option();

            $url = u() . '/' . $Option->slug() . '/content/' . $page->id() . '?method=write&token=' . $Option->token();
            $Core->getContent($url);
        }
    );
}