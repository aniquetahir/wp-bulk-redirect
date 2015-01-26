<?php
/**
 * Plugin Name: Bulk Redirect
 * Description: Allows the addition of redirect urls in bulk
 * Version: 1.0.0
 * Author: Anique Rogers Tahir
 * Author URI: mailto:aniquetahir@gmail.com
 * Network: true
 * License: GPL2
 */
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
//Disallow direct access
defined('ABSPATH') or die('Not Found');

add_action('activate_bulk-redirect/bulk-redirect.php','bulk_redirect_install');
add_action('wp_footer','log_execution');
add_action('admin_menu','bulk_admin_actions');

function bulk_menu(){

	$redirect = get_redirects();
	include 'bulk-admin.php';
}

function bulk_admin_actions(){
	add_options_page('Bulk Redirects Administration','Add Bulk Redirects','manage_options','Bulk-Redirect','bulk_menu');
}



function log_execution(){
	echo '<!-- loggded -->';
}

function bulk_redirect_install(){
	global $wpdb;
	$table = $wpdb->prefix.'bulk_redirect';
	$structure = "
		create table $table (
			urlfrom varchar(2048),
			urlto varchar(2048)
			PRIMARY KEY (urlfrom,urlto) USING BTREE
		)
	";

	$wpdb->query($structure);
}

function add_redirect(){
	global $wpdb;

}

function remove_redirect(){
	global $wpdb;

}

function get_redirects(){
	global $wpdb;
	$table = $wpdb->prefix.'bulk_redirect';
	$redirects = $wpdb->get_results("SELECT * FROM $table");

	return $redirects;
}

