# Changelog

**0.3**

- Major rewrite.
- Added option `plugin.sync.active`.
- Removed option `plugin.sync.log`.
- Removed option `plugin.sync.trigger.delete`.
- Removed option `plugin.sync.modified`.
- Updated option `plugin.sync.token` is now required by security reasons.
- Replaced option `plugin.sync.blueprint.prefix` and `plugin.sync.content.prefix` with `plugin.sync.prefix`.
- Added tests for `panel.page.create`, `panel.page.update`, `panel.page.move`, template change, blueprint  and urls.
- More clever to figure out what to do. If a `panel.page.update` is triggered and the page does not exist, it will create it, for example.
- Price dropped from 50 EUR to only 9 EUR for each domain. There is also a licenses for multiple domains and multiple plugins.

**0.2**

- Delete hook implemented.
- Delete hook is triggered if `plugin.sync.trigger.delete` is set to `true` (false by default).
- Move hook implemented. When you rename the page on the hub, it will also be renamed on the nodes.
- It does only include files when they are needed.

**0.1**

- Initial release