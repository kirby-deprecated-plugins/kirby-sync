# Options

The following options can be set in your `/site/config/config.php` file:

```php
c::get('plugin.sync.hub');
c::get('plugin.sync.slug', 'sync');
c::get('plugin.serp.parent', 'synced-data');
c::get('plugin.sync.token', 'token');
```

### plugin.sync.hub (required)

If this option is `true` the domain is treated like a hub where the original content is stored. When you save a page in hub mode, it will run a hook that copies the content to all the other domains.

If this option is not set, the domain will be seen as a node. You need to have one domain that works as a hub.

**Example**

The hub sends the content to the nodes when a page is saved.

```text
hub
L node
L node
L node
```

### plugin.sync.slug

The slug of the sync API.

### plugin.sync.parent

Often it's good to have a parent page for the synced content on the node.

It will look something like this with `synced-data` as the parent.

```text
example-hub.com/my/page > example-node.com/synced-data/my/page
```

### plugin.sync.token

To prevent other people to use your sync API you can protect it by a token of your choice.