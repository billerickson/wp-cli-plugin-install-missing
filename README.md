# wp-cli-install-missing
Install any plugins that are "active" but not installed. 

Example: You pull down an recent copy of your database from production to your local development environment. A plugin was installed and activated on production, but isn't installed locally. This command reviews the active plugin list, looks for any plugins that are missing, and then installs them.

* `wp plugin install-missing --dry-run` - Run the search and show report, but don't install missing plugins
* `wp plugin install-missing` - Run the search, show report, and install missing plugins

### Installation

Either download and install as a plugin, or run `wp package install billerickson/wp-cli-plugin-install-missing`
