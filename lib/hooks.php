<?php
if(c::get('plugin.sync.hub')) {
    $kirby->set('hook',
        [
            'panel.page.create',
            'panel.page.update'
        ],
        function($page) {
            $core = new SyncCore();
            $slug = c::get('plugin.sync.slug', 'sync');
            $token = c::get('plugin.sync.token', 'token');
            $url = u() . '/' . $slug . '/content/' . $page->id() . '?method=write&token=' . $token;
            $core->getContent($url);
        }
    );
}