# wp-cli-install-missing
Install any plugins that are "active" but missing. The common use case is if you migrated a database but not the full wp-content directory. 

Example: You pull down an recent copy of your database from production to your local development environment. A plugin was installed and activated on production, but isn't installed locally. This command reviews the "active" plugin list, looks for any plugins that are missing, and then installs them.
