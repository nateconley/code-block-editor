# Code Block Editor

This plugin allows users to place and edit code snippets using WordPress' block editor. The block is called "Code Snippets".

There is a settings screen in the admin of the site ("Settings" > "Code Block Editor"). This allows you to choose the theme that is used for both the block and the frontend display of code snippets. Please note that there are a few differences in display of these two views, even when using the same theme.

Under the hood, this plugin relies on CodeMirror (https://codemirror.net/) for the admin block editor and Prism.js (https://prismjs.com/) for the frontend display.

## Support

**The following languages are supported:**

- CSS/Scss
- HTML
- JavaScript
- JSON
- Markdown
- PHP
- shell

In the future, support for more languages may be added.

## Installation

1. Download a zip file from this repository.
1. In the WordPress admin, navigate to "Plugins" and click on "Add New".
1. Upload the zip file and install the plugin.
1. Activate the plugin.

### TODO

- Further testing
- Add live preview to settings page
- Expand languages and options
  - Tabs vs. Spaces
  - Indent
- Update to CodeMirror 6
