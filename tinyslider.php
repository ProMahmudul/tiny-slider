<?php
/**
 * Plugin Name:       Tiny Slider
 * Plugin URI:        https://mahmudulhassan.me
 * Description:       Tiny slider
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mahmudul Hassan
 * Author URI:        https://mahmudulhassan.me/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       tinyslider
 * Domain Path:       /languages
 */

function tinys_load_textdomain() {
	load_plugin_textdomain( 'tinyslider', false, dirname( __FILE__ ) . "/languages" );
}

add_action( 'plugins_loaded', 'tinys_load_textdomain' );

function tinys_init() {
	add_image_size( 'tiny-slider', 800, 600, true );
}

add_action( 'init', 'tinys_init' );

function tinys_assets() {
	wp_enqueue_style( 'tinyslider-css', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css', null, '1.0' );
	wp_enqueue_script( 'tinyslider-js', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js', null, '1.0', true );

	wp_enqueue_script( 'tinyslider-main-js', plugin_dir_url( __FILE__ ) . "assets/js/main.js", array( 'jquery' ), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'tinys_assets' );

function tinys_shortcode_tslider( $atts, $content ) {
	$defaults = array(
		'width'  => 800,
		'height' => 600,
		'id'     => ''
	);

	$attributes = shortcode_atts( $defaults, $atts );
	$content    = do_shortcode( $content );

	$shortcode_output = <<<EOD
							<div id="{$attributes['id']}" style="width: {$attributes['width']}; height: {$attributes['height']}">
								<div class="ts-slider">
									{$content}
								</div>
							</div>
						EOD;

	return $shortcode_output;

}

add_shortcode( 'tslider', 'tinys_shortcode_tslider' );

function tinys_shortcode_tslide( $atts ) {
	$defaults   = array(
		'caption' => '',
		'id'      => '',
		'size'    => 'large'
	);
	$attributes = shortcode_atts( $defaults, $atts );

	$image_src = wp_get_attachment_image_url( $attributes['id'], $attributes['size'] );

	$option_output = <<<EOD
							<div class="slide">
								<p><img src="{$image_src}" alt="{$attributes['caption']}"></p>
								<p>{$attributes['caption']}</p>
							</div>
						EOD;

	return $option_output;

}

add_shortcode( 'tslide', 'tinys_shortcode_tslide' );