# Node

For information about the node, read [hub and nodes](hub-nodes.md).

## Options - Optional

```php
c::set('plugin.sync.blueprint', false);
c::set('plugin.sync.prefix', 'synced-');
c::set('plugin.sync.parent', 'synced-data');
c::set('plugin.sync.parent.blueprint', 'silence');
```

### plugin.sync.blueprint

By default your blueprints are not synced. To sync your blueprints, you need to set this option to `true`.

**Be aware:** Even if you sync the blueprints, this plugin does not [register/set](https://getkirby.com/docs/developer-guide/plugins/registry) them up for you. However, if you don't set a path, they will be placed in the `blueprints` folder and Kirby will find them there.

### plugin.sync.prefix

Prefix is used by both the content text file and the blueprint file. That's because they should match. By default it will fallback to `synced-`.

**Be aware:** If you remove the prefix there is a risk that your blueprints will be overwritten if they use the same name.

### plugin.sync.parent

To prevent page collisions on your hub, you can add a parent to your data. By default `synced-data` is added as a blueprint parent.

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