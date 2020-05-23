<?php
/*
Author: IFWP
Author URI: https://github.com/ifwp
Description: Automatically updates all <a href="https://github.com/ifwp">IFWP</a> plugins within the WordPress Admin area.
Domain Path:
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Network:
Plugin Name: IFWP Updater
Plugin URI: https://github.com/ifwp/ifwp-updater
Text Domain: ifwp-updater
Version: 1.0
*/

    defined('ABSPATH') or die("Hi there! I'm just a plugin, not much I can do when called directly.");

 // --------------------------------------------------

    require_once(plugin_dir_path(__FILE__) . 'plugin-update-checker-4.9/plugin-update-checker.php');

 // --------------------------------------------------

    add_action('after_setup_theme', function(){
        $themes_and_plugins = [
            [
                'full_path' => __FILE__,
                'metadata_url' => 'https://github.com/ifwp/ifwp-updater',
                'slug' => 'ifwp-updater',
            ],
        ];
        $themes_and_plugins = apply_filters('ifwp_updater_themes_and_plugins', $themes_and_plugins);
        if($themes_and_plugins){
            foreach($themes_and_plugins as $theme_or_plugin){
                $theme_or_plugin = shortcode_atts([
                    'full_path' => '',
                    'metadata_url' => '',
                    'slug' => '',
                ], $theme_or_plugin);
                if($theme_or_plugin['metadata_url'] and $theme_or_plugin['full_path'] and $theme_or_plugin['slug']){
                    Puc_v4_Factory::buildUpdateChecker($theme_or_plugin['metadata_url'], $theme_or_plugin['full_path'], $theme_or_plugin['slug']);
                }
            }
        }
    });

 // --------------------------------------------------
