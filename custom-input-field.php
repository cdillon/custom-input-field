<?php
/**
 * Plugin Name: Custom Input Field
 * Description: An example of using a custom input field in Strong Testimonials.
 * Author: Chris Dillon
 * Version: 0.1
 * Text Domain: custom-input-field
 * Requires: 3.6 or higher
 * License: GPLv2 or later
 *
 * Copyright 2017  Chris Dillon  chris@strongplugins.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


/**
 * Shortcode for custom input field.
 *
 * Use the name of your custom field in this select's id.
 * For example, for a custom field named "country", the select id is "wpmtst_country", lower-cased.
 *
 * @return string
 */
function cif_country_input() {
	ob_start();
	?>
	<div class="form-field field-country">
		<select id="wpmtst_country" name="country" tabindex="0">
			<option value="us">United States</option>
			<option value="ca">Canada</option>
			<option value="mx">Mexico</option>
		</select>
	</div>
	<?php

	return ob_get_clean();
}
add_shortcode( 'cif_country_input', 'cif_country_input' );


/**
 * @return string
 */
function cif_country_output() {
	$country = get_post_meta( get_the_ID(), 'country', true );

	return $country;
}
add_shortcode( 'cif_country_output', 'cif_country_output' );


/**
 * @param $post
 * @param $meta
 * @param $cats
 * @param $att
 */
function cif_new_testimonial( $post, $meta, $cats, $att ) {
	if ( isset( $_POST['country'] ) && $_POST['country'] ) {
		add_post_meta( $post['id'], 'country', $_POST['country'], true );
	}
}
add_action( 'wpmtst_new_testimonial_added', 'cif_new_testimonial', 10, 4 );
