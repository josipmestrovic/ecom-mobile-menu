<?php
/**
 * Configuration — defaults + `ecom_mega_menu_config` filter.
 *
 * The hardcoded menu structure (USLUGE/PROJEKTI/BLOG/KONTAKT, the four
 * service categories, all submenu copy and SVGs) lives in render.php and
 * is intentionally NOT exposed here — it's a fixed visual template.
 *
 * What IS configurable: the logo SVG, link target / aria-label, the
 * three contact-block lines, the team-member tiles, the post type +
 * taxonomy + term used to populate the Projekti and Blog featured
 * dropdowns, and the list of links shown in the mobile overlay.
 *
 * Override any subset via the filter, e.g.:
 *
 *     add_filter( 'ecom_mega_menu_config', function( $cfg ) {
 *         $cfg['contact'] = array(
 *             'phone'   => '+1 555 0000',
 *             'email'   => 'info@example.com',
 *             'address' => '1 Example Street, City',
 *         );
 *         $cfg['featured_projects']['post_type'] = 'tour';
 *         $cfg['featured_projects']['term']      = 'featured';
 *         return $cfg;
 *     } );
 *
 * @package ECOM\HeaderMegaMenu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Returns the resolved configuration array for the mega menu.
 */
function ecom_mega_menu_get_config() {
    $defaults = array(

        /* ---- Logo (desktop header) ---- */
        'logo_svg'        => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M40.0005 30.4284C40.0005 33.1871 39.0516 35.554 37.3741 37.2569C36.8488 37.8018 35.9338 37.4101 35.9338 36.6438V29.8665C35.9338 29.2024 35.4085 28.6745 34.7476 28.6745H33.7987C33.1379 28.6745 32.6126 29.2024 32.6126 29.8665V38.9086C32.6126 39.4365 32.206 39.8793 31.6976 39.9304C31.4604 39.9474 31.2062 39.9644 30.9521 39.9644C30.6979 39.9644 30.4607 39.9474 30.2234 39.9304C29.6982 39.8793 29.2915 39.4365 29.2915 38.9086V29.8665C29.2915 29.2024 28.7662 28.6745 28.1054 28.6745H27.1565C26.4956 28.6745 25.9704 29.2024 25.9704 29.8665V36.6779C25.9704 37.4272 25.0553 37.8188 24.5301 37.2909C22.9034 35.6392 21.8867 33.3744 21.8867 30.8712C21.8867 26.8184 24.5131 23.5148 28.1732 22.2888C28.7154 22.1015 29.2915 22.5101 29.2915 23.1061V24.9963C29.2915 25.5583 29.749 26.018 30.3082 26.018H31.596C32.1551 26.018 32.6126 25.5583 32.6126 24.9963V22.9529C32.6126 22.3909 33.1549 21.9652 33.6971 22.1355C37.2893 23.1913 40.0005 26.597 40.0005 30.4284Z" fill="#5D41B0"/><path d="M36.8674 11.0508H38.9552C39.6686 11.0508 40.1732 11.7677 39.947 12.4496C38.6769 16.0866 35.2318 18.6744 31.1778 18.6744C26.0451 18.6744 21.8867 14.4954 21.8867 9.33724C21.8867 4.17906 26.0277 6.10352e-05 31.1604 6.10352e-05C35.2144 6.10352e-05 38.6595 2.60538 39.9296 6.22484C40.1732 6.90677 39.6686 7.62367 38.9378 7.62367H36.85C36.4498 7.62367 36.0844 7.39636 35.9104 7.02917C35.0057 5.14075 33.0222 3.88181 30.7777 4.03918C28.1678 4.21403 26.0625 6.34724 25.8885 8.97004C25.6797 12.0649 28.1156 14.6353 31.1604 14.6353C33.2483 14.6353 35.0578 13.4113 35.9104 11.6453C36.1018 11.2956 36.4672 11.0508 36.8674 11.0508Z" fill="#5D41B0"/><path d="M8.47298 0.153137C11.2672 0.153137 13.6648 1.12384 15.3896 2.83991C15.9416 3.37726 15.5449 4.3133 14.7687 4.3133H7.88653C7.21383 4.3133 6.67913 4.85066 6.67913 5.52668V6.49739C6.67913 7.17341 7.21383 7.71077 7.88653 7.71077H17.0455C17.5802 7.71077 18.0287 8.12678 18.0804 8.6468C18.0977 8.88948 18.1149 9.14949 18.1149 9.4095C18.1149 9.66951 18.0977 9.91219 18.0804 10.1549C18.0287 10.6922 17.5802 11.1082 17.0455 11.1082H7.88653C7.21383 11.1082 6.67913 11.6456 6.67913 12.3216V13.2923C6.67913 13.9683 7.21383 14.5057 7.88653 14.5057H14.7859C15.5449 14.5057 15.9416 15.4417 15.4069 15.9791C13.7338 17.6432 11.4397 18.6832 8.90419 18.6832C4.79904 18.6832 1.45282 15.9964 0.210931 12.2523C0.0211968 11.6976 0.435161 11.1082 1.03886 11.1082H2.9362C3.5054 11.1082 3.97111 10.6402 3.97111 10.0682V8.75081C3.97111 8.17879 3.5054 7.71077 2.9362 7.71077H0.866375C0.297173 7.71077 -0.13404 7.15608 0.0384453 6.60139C1.1251 2.92658 4.57481 0.153137 8.47298 0.153137Z" fill="#5D41B0"/><path d="M9.05745 21.795C4.0538 21.795 0 25.8689 0 30.8974C0 35.9258 4.0538 39.9997 9.05745 39.9997C14.0611 39.9997 18.1149 35.9258 18.1149 30.8974C18.1149 25.8689 14.0611 21.795 9.05745 21.795ZM9.05745 36.0792C6.20791 36.0792 3.90115 33.761 3.90115 30.8974C3.90115 28.0337 6.20791 25.7155 9.05745 25.7155C11.907 25.7155 14.2138 28.0337 14.2138 30.8974C14.2138 33.761 11.907 36.0792 9.05745 36.0792Z" fill="#5D41B0"/></svg>',
        'logo_url'        => home_url( '/' ),
        'logo_aria_label' => 'Početna',

        /* ---- Contact block (Kontakt submenu, desktop) ---- */
        'contact'         => array(
            'phone'   => '+385 99 385 4111',
            'email'   => 'info@e-com.hr',
            'address' => 'Zemljakova ulica 3, Zagreb, 10000, Hrvatska',
        ),

        /* ---- Team tiles (Kontakt submenu, desktop) ---- */
        'team'            => array(
            array(
                'image' => '/wp-content/uploads/2025/11/Marko-Gugic.webp',
                'name'  => 'Marko Gugić',
                'role'  => 'Web / graphic design',
            ),
            array(
                'image' => '/wp-content/uploads/2025/11/Josip-Mestrovic.webp',
                'name'  => 'Josip Meštrović',
                'role'  => 'Web development',
            ),
        ),

        /* ---- Featured Projekti dropdown query ---- */
        'featured_projects' => array(
            'post_type'     => 'project',
            'taxonomy'      => 'project_tag',
            'term'          => 'istaknuto',
            'count'         => 3,
            'meta_field'    => 'Client',           // post meta key shown under title; '' to hide
            'empty_message' => 'Nema istaknutih projekata.',
        ),

        /* ---- Featured Blog dropdown query ---- */
        'featured_blog'   => array(
            'post_type'     => 'post',
            'taxonomy'      => 'post_tag',
            'term'          => 'istaknuto',
            'count'         => 3,
            'empty_message' => 'Nema istaknutih objava.',
        ),

        /* ---- Mobile overlay links (in display order) ----
         * is_cta = true renders the dark pill button. Only one CTA expected.
         */
        'mobile_links'    => array(
            array( 'label' => 'Usluge',   'url' => '/usluge',   'is_cta' => false ),
            array( 'label' => 'Projekti', 'url' => '/projekti', 'is_cta' => false ),
            array( 'label' => 'Blog',     'url' => '/blog',     'is_cta' => false ),
            array( 'label' => 'O nama',   'url' => '/o-nama',   'is_cta' => false ),
            array( 'label' => 'Kontakt',  'url' => '/kontakt',  'is_cta' => true  ),
        ),
    );

    return apply_filters( 'ecom_mega_menu_config', $defaults );
}
