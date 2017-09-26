# Node

For information about the node, read [hub and nodes](options.md).

## Options - Required

```php
c::get('plugin.sync.blueprint', false);
c::get('plugin.sync.blueprint.prefix', 'synced-');
c::get('plugin.sync.parent', 'synced-data');
c::get('plugin.sync.parent.blueprint', 'silence');
```

### plugin.sync.blueprint

As default your blueprints are not synced. To sync your blueprints, you need to set this option to `true`.

**Be aware:**

Even if you sync the blueprints, this plugin does not [register/set](https://getkirby.com/docs/developer-guide/plugins/registry) them up for you.

### plugin.sync.blueprint.prefix

By default `synced-` is added as a blueprint filename prefix and with this config you can change it.

### plugin.sync.parent

Often it's good to have a parent page for the synced content on the node.

By default `synced-data` is added as a blueprint parent.

```text
example-hub.com/my/page > example-node.com/synced-data/my/page
```

### plugin.sync.parent.blueprint

By default a blueprint called `silence` is registered used for the parent `synced-data`. When browsing in the Panel it will just display an empty page. With this option you can change this blueprint name if you need to.

# Site paths

In order to change the paths you need to add `site.php` into your Kirby root.

### sync_blueprints

This is how the blueprint path looks like. If you have not enabled `plugin.sync.blueprint`, you can skip this option.

```php
$kirby = kirby();
$kirby->roots->sync_blueprints = $kirby->roots()->blueprints();
```