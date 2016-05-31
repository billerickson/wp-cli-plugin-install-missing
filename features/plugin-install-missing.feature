Feature: Install any plugins that are active but missing

  Scenario: No missing plugins
    Given a WP install
    And I run `wp plugin install-missing --dry-run`
    Then STDOUT should contain:
       """
   No missing plugins
      """

  Scenario: Install missing plugins
    Given a WP install
    And I run `wp plugin install display-posts-shortcode --activate`
    And I run `rm -rf wp-content/plugins/display-posts-shortcode`
    And I run `wp plugin install-missing --dry-run`
    Then STDOUT should contain:
      """
      display-posts-shortcode
      """
    
    When I run `wp plugin install-missing`
    Then STDOUT should contain:
      """
    Installed missing plugins.
      """