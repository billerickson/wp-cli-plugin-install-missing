# wp-cli-install-missing
Install any plugins that are "active" but not installed. 

I use it when pulling an updated database from my development server to my local installation. If any plugins were installed since I last worked on the site, this will add them to my local install as well.

* `wp plugin install-missing --dry-run` - Run the search and show report, but don't install missing plugins
* `wp plugin install-missing` - Run the search, show report, and install missing plugins

### Installation

Either download and install as a plugin, or run `wp package install billerickson/wp-cli-plugin-install-missing`
