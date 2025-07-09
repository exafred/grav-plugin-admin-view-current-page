# Admin: View Current Page Plugin

The **_Admin: View Current Page_** Plugin is an extension for [Grav CMS](https://github.com/getgrav/grav). 

When I was setting up sites - or making small tweaks - for clients, I found I was flipping between admin panel and frontend page view a fair bit.

This is a very basic plugin that adds a button to the page editing view of the Admin Plugin that links to the current page on the frontend of the site (or the parent page if the page you're currently editing is a module).

## Installation

Installing the _Admin: View Current Page_ plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](https://learn.getgrav.org/cli-console/grav-cli-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install admin-view-current-page

This will install the _Admin: View Current Page_ plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/admin-view-current-page`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `admin-view-current-page`. You can find these files on [GitHub](https://github.com/exafred/grav-plugin-admin-view-current-page) or via [GetGrav.org](https://getgrav.org/downloads/plugins).

You should now have all the plugin files under

    /your/site/grav/user/plugins/admin-view-current-page
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/exafred/grav-plugin-admin-view-current-page/blob/main/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/admin-view-current-page/admin-view-current-page.yaml` to `user/config/plugins/admin-view-current-page.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true

```

Note that if you use the Admin Plugin, a file with your configuration named admin-view-current-page.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the Admin.

## Usage

When editing a page in the Admin Plugin, a button should be added, to the left of the `Delete` button. It should have a link icon on it.

![screenshot showing the location and visual styling of the button](screenshot.png)

Clicking this button will open a new tab with the URL of the current page as it would appear in the frontend.

If the page you're editing is a module, URL of the page's parent will be used instead.


## Credits

This plugin uses an awful lot of [Sebastian Laube's Draft Preview plugin](https://github.com/bitstarr/grav-plugin-draft-preview) as a base (and is pretty much the only reason this plugin exists).

## To Do

- [ ] Double-check multi-language support is OK
- [ ] Add option to automatically clear page cache when button is clicked