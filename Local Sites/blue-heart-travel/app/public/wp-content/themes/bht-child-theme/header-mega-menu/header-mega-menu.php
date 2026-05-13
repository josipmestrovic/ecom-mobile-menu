<?php
/**
 * Plugin Name: ECOM Header Mega Menu
 * Description: Self-contained Divi child-theme module that registers two
 *              shortcodes — `[ecom_mega_menu]` (desktop mega menu with
 *              hover-driven submenus, "Usluge" tab switcher, featured
 *              projects/blog dropdowns) and `[ecom_mobile_menu]` (sticky
 *              mobile header + fullscreen overlay nav).
 * Author:      E-COM (refactored for Blue Heart Travel)
 * Version:     1.0.0
 *
 * This is a Divi child-theme module — not a plugin. Activation is opt-in.
 * Add the following line to your child theme's `functions.php`:
 *
 *     require_once get_stylesheet_directory() . '/header-mega-menu/header-mega-menu.php';
 *
 * Then drop the shortcodes wherever you need them (e.g. a Divi Code module
 * inside the global header):
 *
 *     [ecom_mega_menu]    -> desktop layout
 *     [ecom_mobile_menu]  -> mobile / sticky bar layout
 *
 * Assets are auto-enqueued only on pages that actually use one of the two
 * shortcodes (see includes/assets.php).
 *
 * File structure:
 *   header-mega-menu/
 *   ├── header-mega-menu.php  ← this bootstrap (loads the modules below)
 *   ├── styles.css            ← all styles (desktop + mobile + dropdowns)
 *   ├── script.js             ← hover/blur, tab switch, hamburger, scroll-hide
 *   ├── README.md             ← documentation
 *   └── includes/
 *       ├── config.php        ← ecom_mega_menu_get_config() + filter
 *       ├── assets.php        ← conditional wp_enqueue_scripts
 *       ├── render.php        ← [ecom_mega_menu] + [ecom_mobile_menu]
 *       └── dropdowns.php     ← [projekti_dropdown] + [blog_dropdown]
 *
 * @package ECOM\HeaderMegaMenu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* -------------------------------------------------------------------------
 * Module constants
 * ---------------------------------------------------------------------- */

if ( ! defined( 'ECOM_MEGA_MENU_DIR' ) ) {
    define( 'ECOM_MEGA_MENU_DIR', __DIR__ );
}
if ( ! defined( 'ECOM_MEGA_MENU_URL' ) ) {
    define( 'ECOM_MEGA_MENU_URL', get_stylesheet_directory_uri() . '/header-mega-menu' );
}
if ( ! defined( 'ECOM_MEGA_MENU_VERSION' ) ) {
    define( 'ECOM_MEGA_MENU_VERSION', '1.0.0' );
}

/*
 * Module loader.
 *
 * Order matters:
 *   1. config.php     — defines ecom_mega_menu_get_config() used by every
 *                        other file.
 *   2. dropdowns.php  — registers [projekti_dropdown] / [blog_dropdown]
 *                        shortcodes used inside the desktop markup.
 *   3. render.php     — registers [ecom_mega_menu] / [ecom_mobile_menu]
 *                        shortcodes (does the do_shortcode() call into the
 *                        dropdown helpers above).
 *   4. assets.php     — wp_enqueue_scripts callback; checks for shortcode
 *                        presence on the current request.
 */
require_once ECOM_MEGA_MENU_DIR . '/includes/config.php';
require_once ECOM_MEGA_MENU_DIR . '/includes/dropdowns.php';
require_once ECOM_MEGA_MENU_DIR . '/includes/render.php';
require_once ECOM_MEGA_MENU_DIR . '/includes/assets.php';
