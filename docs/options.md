# Options

The following options can be set in your `/site/config/config.php` file:

**Required**

```php
c::get('plugin.sync.hub');
```

**Optional**

```php
c::get('plugin.sync.slug', 'sync');
c::get('plugin.sync.parent', 'synced-data');
c::get('plugin.sync.token', 'token');
c::get('plugin.sync.blueprint.empty', 'silence');
```

## Required

### plugin.sync.hub

The hub is where your original content is stored. The node domains are the domains where your content is copied to.

On your hub domain this option needs to be `true`. On your node domains, you don't need to set this option.

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

### plugin.blueprint.empty

By default a blueprint called `silence` is registered used for the parent `synced-data`. When browsing in the Panel it will just display an empty page. With this option you can change this blueprint name if you need to.