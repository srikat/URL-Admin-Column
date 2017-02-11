<?php
/**
 * Plugin Name: URL Admin Column
 * Plugin URI: https://github.com/srikat/URL-Admin-Column
 * Description: Adds a URL column in Media Library admin screen.
 * Version: 1.0.0
 * Author: Sridhar Katakam
 * Author URI: https://sridharkatakam.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */


if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin version of https://sridharkatakam.com/add-url-admin-column-wordpress-media-library/
 */

add_filter( 'manage_media_columns', 'sk_media_columns_url' );
/**
 * Filter the Media list table columns to add a URL column.
 *
 * @param array $posts_columns Existing array of columns displayed in the Media list table.
 * @return array Amended array of columns to be displayed in the Media list table.
 */
function sk_media_columns_url( $posts_columns ) {
	$posts_columns['media_url'] = 'URL';
	return $posts_columns;
}

add_action( 'manage_media_custom_column', 'sk_media_custom_column_url' );
/**
 * Display URL custom column in the Media list table.
 *
 * @param string $column_name Name of the custom column.
 */
function sk_media_custom_column_url( $column_name ) {
	if ( 'media_url' !== $column_name ) {
		return;
	}

	echo '<input type="text" width="100%" onclick="jQuery(this).select();" value="' . wp_get_attachment_url() . '" />';
}

add_action( 'admin_print_styles-upload.php', 'sk_url_column_css' );
/**
 * Custom CSS on Media Library page in WP admin
 */
function sk_url_column_css() {
	echo '<style>
			@media only screen and (min-width: 1400px) {
				.fixed .column-media_url {
					width: 15%;
				}
			}
		</style>';
}
