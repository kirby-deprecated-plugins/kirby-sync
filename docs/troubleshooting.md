# Troubleshooting

### Use the latest versions

Make sure you are using at least PHP 7 and Kirby 2.5.5. Also make sure you have the latest version of this plugin.

### Make sure the routes work

If your site prevents plugin routes to run, this plugin will not work. To test it, try the sync read API on both the hub and the nodes.

**Example**

```text
https://example.com/sync/read/projects/project-a?token=token
```

### Make sure your domains are setup correctly

On the hub, you need to have a config to call the nodes when updating a page. Make sure the domains are correct. Also make sure you create/update a page that exists within one of the parents listed.

```php
c::set('plugin.sync.domains', [
    'https://example.com' => [
        'projects/project-a',
    ],
    'https://anotherdomain.com' => [
        'projects',
    ]
]);
```

### Make sure you save on the hub, not on the node

It's easy to think the wrong way. Make sure to save the data on the hub and not on the node.