# Kirby Sync

*Version 0.1*

Copy (called sync) your page on save from a domain (called hub) > to other domains (called nodes).

```text
hub (domain)
├─ node (domain)
└─ node (domain)
```

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

There are much more options for the [hub and nodes](docs/hub-nodes.md) and for [nodes](docs/node.md).

## Usage

1. Login to the hub domain panel and create/update a page.
1. Login to the node domain to see if the change has been synced.

### Table of contents

- [Installation](docs/installation.md)
- [Hub & nodes](docs/hub-nodes.md)
  - [Hub](docs/hub.md)
  - [Node](docs/node.md)
- [Troubleshooting](docs/troubleshooting.md)

## Changelog

**0.1**

- Initial release

## Requirements

- [**Kirby**](https://getkirby.com/) 2.5.5+

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/username/plugin-name/issues/new).

## Purchase

Be sure to try before you buy. Refunds are not supported. Read more in the [license agreement](docs/license.md).

[![Pay now](https://www.paypalobjects.com/en_US/SE/i/btn/btn_paynowCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=W68WGMJVFLTFU)

**Price:** 50 EUR (on each hub domain)

## Credits

- [Jens Törnell](https://github.com/jenstornell)