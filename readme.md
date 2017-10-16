# Kirby Sync

[![Version 0.3](https://img.shields.io/badge/version-0.3-blue.svg)](https://github.com/jenstornell/kirby-sync/blob/master/docs/changelog.md) [![Commercial license](https://img.shields.io/badge/license-commercial-red.svg)](https://github.com/jenstornell/kirby-sync/blob/master/docs/license.md) [![Commercial license](https://img.shields.io/badge/price-€9-yellow.svg)](https://github.com/jenstornell/kirby-sync/blob/master/docs/license.md)

Copy (called sync) your page on when saving the page in the panel, from a domain (called hub) > to other domains (called nodes).

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
        'projects/project-a',
    ],
    'https://anotherdomain.com' => [
        'projects'
    ]
]);
```

### 3. Add a token on both hub and nodes

A token is **required**. Use the same string on both the hub and the nodes.

```php
c::set('plugin.sync.token', null);
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
- [Changelog](docs/changelog.md)

## Good to know

- This plugin is not yet tested on multi language sites.
- You can sync sorted pages, but the sort number will not be synced because of [this issue](https://github.com/getkirby/panel/issues/827).

## Requirements

- [**Kirby**](https://getkirby.com/) 2.5.5+
- PHP 7+

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/username/plugin-name/issues/new).

## Purchase

Be sure to try before you buy. Refunds are not supported. Read more in the [license agreement](docs/license.md).

[![Pay now](https://www.paypalobjects.com/en_US/SE/i/btn/btn_paynowCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TB7ASKYRXLJD2)

### Single domain license

This license can be used for one hub domain.

**Price:** [Pay 9 EUR](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TB7ASKYRXLJD2)

### Unlimited domain license

This license can be used for unlimited number of domains. You are allowed to use this license for your clients as well.

**Price:** [Pay 50 EUR](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=U8CS633JCEW6C)

### Unlimited plugins, unlimited domains

This license can be used for unlimited plugins on [this Github account](https://github.com/jenstornell) on unlimited domains. You are allowed to use this license for your clients as well.

**Price:** [Pay 100 EUR](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3KJGBSXNPTECL)

## Donate

If you want to make a donation in addition to the purchase, you can do that by sending any amount  https://www.paypal.me/DevoneraAB

## Credits

- [Jens Törnell](https://github.com/jenstornell)