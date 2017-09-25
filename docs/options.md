# Options

The following options can be set in your `/site/config/config.php` file:

**Required**

```php
c::get('plugin.sync.hub');
```

**optional**

```php
c::get('plugin.sync.slug', 'sync');
c::get('plugin.serp.parent', 'synced-data');
c::get('plugin.sync.token', 'token');
```

## Required

### plugin.sync.hub (required)

Your hub domain needs to have this option to `true`. The hub is where your original content is stored.

For node domains you don't need to set this option. Node domains are the domains where your content is copied to.

**Example**

The hub sends the content to the nodes when a page is saved.

```text
hub
L node
L node
L node
```

## Optional

### plugin.sync.slug

The slug of the sync API. You only need to change this if it collides with something else you have on `yourdomain.com/sync`.

### plugin.sync.parent

Often it's good to have a parent page for the synced content on the node.

It will look something like this with `synced-data` as the parent.

```text
example-hub.com/my/page > example-node.com/synced-data/my/page
```

### plugin.sync.token

To prevent other people to use your sync API you can protect it by a token of your choice.