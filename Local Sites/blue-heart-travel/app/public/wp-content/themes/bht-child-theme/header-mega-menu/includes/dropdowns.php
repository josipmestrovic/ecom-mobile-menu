<?php
/**
 * Featured-content dropdown shortcodes used inside the desktop mega menu.
 *
 * Both shortcodes drive their query off ecom_mega_menu_get_config():
 *   - [projekti_dropdown] reads $cfg['featured_projects']
 *   - [blog_dropdown]     reads $cfg['featured_blog']
 *
 * They emit ONLY semantic markup — all styling lives in styles.css under
 * the `=== Featured projects dropdown ===` / `=== Featured blog dropdown ===`
 * sections.
 *
 * @package ECOM\HeaderMegaMenu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * [projekti_dropdown] — three featured posts from the configured project
 * post type, rendered as image + title + optional client meta.
 */
function ecom_mega_menu_projekti_dropdown_shortcode() {
    $cfg  = ecom_mega_menu_get_config();
    $f    = isset( $cfg['featured_projects'] ) ? $cfg['featured_projects'] : array();

    $args = array(
        'post_type'      => isset( $f['post_type'] ) ? $f['post_type'] : 'project',
        'posts_per_page' => isset( $f['count'] ) ? (int) $f['count'] : 3,
    );
    if ( ! empty( $f['taxonomy'] ) && ! empty( $f['term'] ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => $f['taxonomy'],
                'field'    => 'slug',
                'terms'    => $f['term'],
            ),
        );
    }

    $query      = new WP_Query( $args );
    $meta_field = isset( $f['meta_field'] ) ? $f['meta_field'] : '';
    $empty_msg  = isset( $f['empty_message'] ) ? $f['empty_message'] : '';

    ob_start();
    ?>
    <div class="ecom-dropdown-featured-container">
    <?php if ( $query->have_posts() ) : ?>
        <?php while ( $query->have_posts() ) : $query->the_post();
            $post_id   = get_the_ID();
            $image_url = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
            $permalink = get_permalink( $post_id );
            $meta_val  = $meta_field ? get_post_meta( $post_id, $meta_field, true ) : '';
            ?>
            <a href="<?php echo esc_url( $permalink ); ?>" class="ecom-dropdown-featured-card">
                <?php if ( $image_url ) : ?>
                    <div class="ecom-dropdown-featured-image">
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                    </div>
                <?php endif; ?>
                <div class="ecom-dropdown-featured-info">
                    <h3 class="ecom-dropdown-title"><?php echo esc_html( get_the_title() ); ?></h3>
                    <?php if ( $meta_val ) : ?>
                        <p class="ecom-dropdown-client"><?php echo esc_html( $meta_val ); ?></p>
                    <?php endif; ?>
                </div>
            </a>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p><?php echo esc_html( $empty_msg ); ?></p>
    <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'projekti_dropdown', 'ecom_mega_menu_projekti_dropdown_shortcode' );

/**
 * [blog_dropdown] — three featured blog posts as image + title cards.
 */
function ecom_mega_menu_blog_dropdown_shortcode() {
    $cfg  = ecom_mega_menu_get_config();
    $f    = isset( $cfg['featured_blog'] ) ? $cfg['featured_blog'] : array();

    $args = array(
        'post_type'      => isset( $f['post_type'] ) ? $f['post_type'] : 'post',
        'posts_per_page' => isset( $f['count'] ) ? (int) $f['count'] : 3,
    );
    if ( ! empty( $f['taxonomy'] ) && ! empty( $f['term'] ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => $f['taxonomy'],
                'field'    => 'slug',
                'terms'    => $f['term'],
            ),
        );
    }

    $query     = new WP_Query( $args );
    $empty_msg = isset( $f['empty_message'] ) ? $f['empty_message'] : '';

    ob_start();
    ?>
    <div class="ecom-dropdown-blog-container">
    <?php if ( $query->have_posts() ) : ?>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="ecom-dropdown-blog-card">
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="ecom-dropdown-blog-link">
                    <div class="ecom-dropdown-blog-content">
                        <h3 class="ecom-dropdown-blog-title"><?php echo esc_html( get_the_title() ); ?></h3>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="ecom-dropdown-blog-image">
                        <?php endif; ?>
                    </div>
                </a>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p><?php echo esc_html( $empty_msg ); ?></p>
    <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'blog_dropdown', 'ecom_mega_menu_blog_dropdown_shortcode' );
