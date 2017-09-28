# Kirby Sync

*Version 0.1*

Sync your pages to other domains when saving the page.

```text
hub (domain)
├─ node (domain)
└─ node (domain)
```

## Table of contents

├─ [Installation](docs/installation.md)
├─ [Troubleshooting](docs/troubleshooting.md)
└─ [Hub & nodes](docs/hub-nodes.md)
   ├ [Hub](docs/hub.md)
   └ [Node](docs/node.md)

## Vocabulary

**Hub** - The domain where the original content is saved.
**Node** - One or many domains where your content will be sent.
**Sync** - One way direction copy, from the hub to the nodes.

## Simple setup

### 1. Install the plugin

[Install the plugin](docs/installation.md) on both the hub and the nodes.

### 2. Add domains

In the hub `config.php`, add node domains and page parents that should be synced to the nodes.

**Example**

```php
c::set('plugin.sync.domains', [
    'https://example.com' => [
        'projects/project-k',
        'projects'
    ],
    'https://anotherdomain.com' => [
        'some-parent'
    ]
]);
```

There are much more [options for the nodes](docs/node.md).

## Usage

1. Login to the hub domain panel and create/update a page.
1. Login to the node domain to see if the change has been synced.

## Changelog

**0.1**

- Initial release

## Requirements

- [**Kirby**](https://getkirby.com/) 2.5.5+

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/username/plugin-name/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.

## Credits

- [Jens Törnell](https://github.com/jenstornell)