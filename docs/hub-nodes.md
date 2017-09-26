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

# Options - Optional

All of these options are optional.

*These options needs to be set on both the hub and the nodes in order to work.*

In your `site/config/config.php`:

```php
c::get('plugin.sync.slug', 'sync');
c::get('plugin.sync.token', 'token');
```

### plugin.sync.slug

The slug of the sync API. You only need to use this config if you suspect a collision with `yourdomain.com/sync`.

### plugin.sync.token

To prevent other people to use your sync API, you can protect it by a token of your choice.