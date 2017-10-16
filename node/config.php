<?php
$roots = kirby()->roots();

kirby()->set('option', 'plugin.sync.settings.custom', [
    'parent' => 'synced-data',
    'parent.blueprint' => 'silence',
    'blueprint' => false,
    'blueprint.root' => ($roots->sync_blueprints()) ? $roots->sync_blueprints() : $roots->blueprints(),
    'prefix' => 'synced-'
]);