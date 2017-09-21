<?php
if(!file_exists(kirby()->roots()->plugins() . DS . 'kirby-blueprint-reader')) {
    require_once __DIR__ . DS. 'kirby-blueprint-reader' . DS . 'kirby-blueprint-reader.php';
}

//http://localhost/plugins/sync/sync-giver/content/projects/project-b?token=token

kirby()->routes(array(
    array(
        'pattern' => 'sync/(:any)/(:any)/(:all)',
        'action'  => function($method, $type, $id) {
            if(get('token') != c::get('token', 'token')) return new Response('Wrong token!', 'html', 404);
            if($method == 'read') {
                $page = page($id);

                if($type == 'status') {
                    if($page) {
                        $json = json_encode([
                            'match' => true,
                            'modified' => $page->modified(),
                            'blueprint' => b::file($page->template()),
                            'textfile' => $page->textfile()
                        ]);
                    } else {
                        $json = json_encode([
                            'match' => false,
                        ]);
                    }
                    return new Response($json, 'json', 200);
                }

                if($page) {
                    if($type == 'content') {
                        $output = file_get_contents( $page->textfile() );
                    } elseif($type == 'blueprint') {
                        $blueprint = b::blueprint($page->template());
                        $output = yaml::encode($blueprint);
                    }
                    return new Response($output, 'html', 200);
                }
            }
        }
    )
));