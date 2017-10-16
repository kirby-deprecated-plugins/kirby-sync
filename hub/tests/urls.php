<?php
namespace KirbySync;
$Urls = new Urls();

$domains = settings::domains();
$domain = key($domains);
$hub = urlencode(u());

$data = [
    'create' => [
        'test' => $Urls->hook('page.panel.create', page('projects/project-a')),
        'match' => $domain . '/sync/save/projects/project-a?token=token&hub=' . $hub
    ],
    'update' => [
        'test' => $Urls->hook('page.panel.update', page('projects/project-a'), page('projects/project-a')),
        'match' => $domain . '/sync/save/projects/project-a?token=token&hub=' . $hub
    ],
    'move' => [
        'test' => $Urls->hook('page.panel.move', page('projects/project-b'), page('projects/project-a')),
        'match' => $domain . '/sync/save/projects/project-a?token=token&hub=' . $hub . '&new_name=project-b'
    ],
    'delete' => [
        'test' => $Urls->hook('page.panel.delete', page('projects/project-a')),
        'match' => $domain . '/sync/delete/projects/project-a?token=token'
    ]
];

$result = ['success' => true];

foreach($data as $type => $items) {
    if($items['match'] != $items['test'][0]) {
        $result = [
            'success' => false,
            'Message' => 'Url ' . $type . ' . is wrong'
        ];
    }
}

$unallowed = $Urls->hook('page.panel.update', page('unallowed'), page('unallowed'));

if(!empty($unallowed)) {
    $result = [
        'success' => false,
        'Message' => 'The page unallowed should not be available'
    ];
}

echo json_encode($result);