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
       $plugins = [
           [
               'metadata_url' => 'https://github.com/ifwp/ifwp-updater',
               'full_path' => __FILE__,
               'slug' => 'ifwp-updater',
           ],
       ];
       $plugins = apply_filters('ifwp_updater_plugins', $plugins);
       if($plugins){
           foreach($plugins as $plugin){
               $plugin = shortcode_atts([
                   'metadata_url' => '',
                   'full_path' => '',
                   'slug' => '',
               ], $plugin);
               if($plugin['metadata_url'] and $plugin['full_path'] and $plugin['slug']){
                   Puc_v4_Factory::buildUpdateChecker($plugin['metadata_url'], $plugin['full_path'], $plugin['slug']);
               }
           }
       }
   });

// --------------------------------------------------
