# Hub

For information about the hub, read [hub and nodes](hub-nodes.md).

## Options - Required

These options are required in order for the plugin to work.

```php
c::set('plugin.sync.domains');
```

### plugin.sync.domains

To be able to sync the content you need to setup some domains. You also need to setup the parents that are allowed to be synced.

**Example**

In the example below `projects/project-a` will be sent to `example.com` when it's saved on the hub domain.

```php
c::set('plugin.sync.domains', [
    'https://example.com' => [
        'projects/project-k',
        'projects'
    ],
    'https://anotherdomain.com' => [
        'some-parent',
        'another/parent'
    ]
]);
```

`projects/project-a` will match `projects`, because `projects` is a parent of `projects/project-a`.