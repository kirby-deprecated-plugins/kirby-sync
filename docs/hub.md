# Hub

For information about the hub, read [hub and nodes](options.md).

## Options - Required

These options are required in order for the plugin to work.

```php
c::get('plugin.sync.domains');
```

### plugin.sync.domains

To be able to sync the content you need to have domains. You also need to setup the parents that are allowed to be synced.

**Example**

In the example below `projects/project-a` will be sent to `example.com` when it's saved on the hub domain.

- `projects/project-a` will not match the first rule, `projects/project-k`, because `projects/project-a` is not a direct match, or a child of `projects/project-k`.
- `projects/project-a` will match `projects` because it's a child of `projects`.

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