# Node

For information about the node, read [hub and nodes](hub-nodes.md).

## Options - Optional

```php
c::set('plugin.sync.blueprint', false);
c::set('plugin.sync.blueprint.prefix', 'synced-');
c::set('plugin.sync.content.prefix', c::get('plugin.sync.blueprint.prefix'));
c::set('plugin.sync.trigger.delete', false);
c::set('plugin.sync.modified', false);
c::set('plugin.sync.parent', 'synced-data');
c::set('plugin.sync.parent.blueprint', 'silence');
```

### plugin.sync.blueprint

As default your blueprints are not synced. To sync your blueprints, you need to set this option to `true`.

**Be aware:**

Even if you sync the blueprints, this plugin does not [register/set](https://getkirby.com/docs/developer-guide/plugins/registry) them up for you.

### plugin.sync.blueprint.prefix

By default `synced-` is added as a blueprint filename prefix.

### plugin.sync.content.prefix

By default it will fallback to `plugin.sync.blueprint.prefix` and will add `synced-` to your content text file.

### plugin.sync.trigger.delete

When you delete a synced page on the hub, it will **not** be deleted on the node by default. To also delete pages on the nodes, set this option to `true`.

### plugin.sync.modified

If you need the original file modified timestamp, you can set this value to `true` and it will be sent to the node.

### plugin.sync.parent

By default `synced-data` is added as a blueprint parent.

```text
example-hub.com/my/page > example-node.com/synced-data/my/page
```

### plugin.sync.parent.blueprint

By default `silence` is the name for the blueprint that is registered for the parent pages.

When browsing in the Panel it will just display an empty page.

# Site paths

In order to change the paths you need to add `site.php` into your Kirby root.

### sync_blueprints

This option is only needed if you have enabled `plugin.sync.blueprint`.

By default the `site/blueprints` folder will be used.

```php
$kirby = kirby();
$kirby->roots->sync_blueprints = $kirby->roots()->blueprints();
```