# About

Provides the ability to import and otherwise work with data directly from an ExpressionEngine database. Currently includes support for Channels, Entries (including entry fields / data), Comments, Members (including member fields / data), MemberGroups, Categories, and CategoryGroups.

# Installation

To install from the [Marketplace](https://octobercms.com/plugin/luketowers-eeimport), click on the "Add to Project" button and then select the project you wish to add it to before updating the project to pull in the plugin.

To install from the backend, go to **Settings -> Updates & Plugins -> Install Plugins** and then search for `LukeTowers.EEImport`.

To install from [the repository](https://github.com/luketowers/oc-eeimport-plugin), clone it into **plugins/luketowers/eeimport** and then run `composer update` from your project root in order to pull in the dependencies.

To install it with Composer, run `composer require luketowers/oc-eeimport-plugin` from your project root.

# Documentation

ExpressionEngine stores data as "entries" organized by "channels" with additional "categories" for further classification of data. As an example, you could have an `Articles` channel for blog posts, a `Pages` channel for regular static pages, and a `Products` channel for available products. Custom fields can be specified for different channels and that data is stored in the `channel_data` table while the main Entry records themselves are stored in the `channel_titles` table.

All custom field data for entries is stored as individual columns on the `channel_data` table, which makes things very inconvenient to work with. Fortunately, this plugin will automatically "Just Work" and will load any additional fields defined for a given entry's channel directly onto the individual Entry records under the relevant field names.

This plugin currently just supports the following ExpressionEngine record types implemented through OctoberCMS Models with OctoberCMS relationships configured appropriately:

- Channels (Main data types)
- Entries (Main data entries for the given Channels)
- Comments (Related records attached to Entries)
- Members (user accounts on the system, attached to entries and comments)
- MemberGroups (essential user roles)
- Categories (further organization of Entries)
- CategoryGroups (grouping of the above categories for even more organization)

More may be added on an as-needed basis, feel free to submit an issue or even a pull request adding support yourself.