# Hub & Nodes

With this plugin we work with a hub and nodes.

## Hub

The hub is the domain where your original content is stored.

Also see how to [setup the hub](hub.md).

## Node

The nodes are the domains where your content is copied to.

```text
hub
├─ node
└─ node
```

Also see how to [setup a node](node.md).

# Options - Required

*These options needs to be set on both the hub and the nodes in order to work.*

```php
c::set('plugin.sync.token', null);
```

### plugin.sync.token

To prevent other people to use your sync API, you need to protect it by a token (string) of your choice. You need to use the same token on both the hub and the nodes in order to make the handshake.

# Options - Optional

All of these options are optional.

*These options needs to be set on both the hub and the nodes in order to work.*

In your `site/config/config.php`:

```php
c::set('plugin.sync.slug', 'sync');
c::set('plugin.sync.active', true);
```

### plugin.sync.slug

The slug of the sync API. You only need to use this config if you suspect a collision with `yourdomain.com/sync`.

### plugin.sync.active

The plugin will be update by default but by setting this value to `false` the plugin will be disabled.