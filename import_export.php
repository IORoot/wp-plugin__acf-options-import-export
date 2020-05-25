<?php
/*
 * @package   ACF options importer exporter
 * @author    Andy Pearson <andy@londonparkour.com>
 * @copyright 2020 LondonParkour
 *
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - ACF Import / export for options pages
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong">TOOL</strong> | <em> Custom Fields > ACF import/export.</em> | Allows you to import and export all option DATA from the DB. 
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                              The ACF                                    │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf_admin_page.php'; 


//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                              The Class                                  │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/import_export_class.php'; 