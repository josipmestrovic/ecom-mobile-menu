<?php
/**
 * Assets — enqueue styles.css and script.js, but only on requests where
 * one of the mega-menu shortcodes actually appears in the rendered post,
 * so editorial pages aren't paying for ~30KB of CSS/JS they don't use.
 *
 * Force-load on every front-end page:
 *
 *     add_filter( 'ecom_mega_menu_should_enqueue', '__return_true' );
 *
 * Conversely, hard-disable everywhere:
 *
 *     add_filter( 'ecom_mega_menu_should_enqueue', '__return_false' );
 *
 * @package ECOM\HeaderMegaMenu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Whether to enqueue the mega-menu assets on the current request.
 *
 * Default behavior: load only when the singular post being viewed contains
 * either `[ecom_mega_menu]` or `[ecom_mobile_menu]`. Sites that wire the
 * shortcodes into a global Divi header / theme template (so they aren't
 * present in `post_content`) should force-load via the filter.
 */
function ecom_mega_menu_should_enqueue() {
    if ( is_admin() ) {
        return false;
    }

    $should = false;
    if ( is_singular() ) {
        $post = get_post();
        if ( $post && (
            has_shortcode( $post->post_content, 'ecom_mega_menu' ) ||
            has_shortcode( $post->post_content, 'ecom_mobile_menu' )
        ) ) {
            $should = true;
        }
    }

    return (bool) apply_filters( 'ecom_mega_menu_should_enqueue', $should );
}

add_action( 'wp_enqueue_scripts', 'ecom_mega_menu_enqueue_assets' );
function ecom_mega_menu_enqueue_assets() {
    if ( ! ecom_mega_menu_should_enqueue() ) {
        return;
    }

    $base_url = ECOM_MEGA_MENU_URL;
    $base_dir = ECOM_MEGA_MENU_DIR;

    wp_enqueue_style(
        'ecom-mega-menu',
        $base_url . '/styles.css',
        array(),
        file_exists( $base_dir . '/styles.css' ) ? filemtime( $base_dir . '/styles.css' ) : ECOM_MEGA_MENU_VERSION
    );

    wp_enqueue_script(
        'ecom-mega-menu',
        $base_url . '/script.js',
        array(), // vanilla JS — no jQuery dependency
        file_exists( $base_dir . '/script.js' ) ? filemtime( $base_dir . '/script.js' ) : ECOM_MEGA_MENU_VERSION,
        true
    );
}
