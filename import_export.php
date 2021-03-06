<?php
/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - ACF - Import / Export options data
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong">🔧TOOL</strong> | <em> Custom Fields > ACF import/export.</em> | Allows you to import and export all option DATA from the DB. 
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                              The ACF                                    │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf_admin_page.php'; 

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                              The Class                                  │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/import_export_class.php'; 