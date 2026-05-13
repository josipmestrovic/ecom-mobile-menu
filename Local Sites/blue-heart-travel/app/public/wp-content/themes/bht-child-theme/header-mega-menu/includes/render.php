<?php
/**
 * Render — registers the two front-end shortcodes:
 *
 *   [ecom_mega_menu]    — desktop hover-driven mega menu
 *   [ecom_mobile_menu]  — fixed mobile header + fullscreen overlay nav
 *
 * Menu structure (USLUGE / PROJEKTI / BLOG / KONTAKT, the four service
 * categories, all submenu copy and SVG icons) is intentionally hardcoded
 * here — it's a fixed visual template. Only logo, contact block, team
 * tiles, mobile-overlay links, and the embedded featured-post dropdowns
 * read from ecom_mega_menu_get_config().
 *
 * Note on output: $cfg['logo_svg'] is printed raw on purpose so editors
 * can supply inline SVG markup. Whoever overrides that key is responsible
 * for trusted markup. All other config values are escaped at output.
 *
 * @package ECOM\HeaderMegaMenu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* =========================================================================
 * [ecom_mega_menu] — desktop layout
 * ====================================================================== */
function ecom_mega_menu_shortcode() {
    $cfg     = ecom_mega_menu_get_config();
    $contact = isset( $cfg['contact'] ) ? $cfg['contact'] : array( 'phone' => '', 'email' => '', 'address' => '' );
    $team    = isset( $cfg['team'] ) && is_array( $cfg['team'] ) ? $cfg['team'] : array();

    ob_start();
    ?>
    <header class="ecom-header">
        <div class="ecom-header-container">

            <!-- Lijevi (left) menu: USLUGE + PROJEKTI -->
            <nav class="ecom-lijevi-izbornik">
                <ul>

                    <li>
                        <a href="/usluge">
                            USLUGE
                            <span class="menu-arrow">
                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0.999817L5 4.99982L9 0.999817" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </a>
                        <div class="sub-menu">
                            <div class="dropdown">
                                <div class="dropdown-sidebar" style="width:240px; margin-right:25px;">
                                    <h3>Usluge</h3>
                                    <div class="usluge-categories">
                                        <button class="category active" data-category="1">
                                            <span>KLJUČ U RUKE</span>
                                            <span class="arrow"><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 9.5L5 5.5L1 1.5" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                        </button>
                                        <button class="category" data-category="2">
                                            <span>STRATEGIJA I DIZAJN</span>
                                            <span class="arrow"><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 9.5L5 5.5L1 1.5" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                        </button>
                                        <button class="category" data-category="3">
                                            <span>DIGITALNI MARKETING</span>
                                            <span class="arrow"><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 9.5L5 5.5L1 1.5" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                        </button>
                                        <button class="category" data-category="4">
                                            <span>PODRŠKA I ODRŽAVANJE</span>
                                            <span class="arrow"><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 9.5L5 5.5L1 1.5" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="usluge-content">
                                    <div class="content" data-category="1">
                                        <ul>
                                            <li><a href="https://e-com.hr/usluge/izrada-web-stranice/"><h4>Izrada web stranice</h4><p>Predstavite svoju firmu na dobar način uz modernu web stranicu.</p></a></li>
                                            <li><a href="https://e-com.hr/usluge/izrada-web-trgovine/"><h4>Izrada web trgovine</h4><p>Ostvarite više prodaje kroz savršeno optimiziran webshop.</p></a></li>
                                            <li><a href="https://e-com.hr/usluge/izrada-web-aplikacije/"><h4>Izrada web aplikacija</h4><p>Razvijte skalabilnu web aplikaciju uz tim koji pokriva sve faze razvoja.</p></a></li>
                                        </ul>
                                    </div>
                                    <div class="content" data-category="2" style="display:none;">
                                        <ul>
                                            <li><a href="https://e-com.hr/usluge/web-strategija/"><h4>Web strategija</h4><p>Postignite jasniji smjer weba i marketinga uz strategiju koja povezuje ciljeve i sadržaj.</p></a></li>
                                            <li><a href="https://e-com.hr/usluge/brending/"><h4>Brendiranje</h4><p>Postanite prepoznatljivi na tržištu kroz jasno definiran brend i vizualne smjernice.</p></a></li>
                                            <li><a href="https://e-com.hr/usluge/ux-ui-dizajn/"><h4>UX / UI dizajn</h4><p>Povećajte prodaju uz UX / UI dizajn koji pretvara klikove u konverzije.</p></a></li>
                                            <li><a href="https://e-com.hr/usluge/programiranje/"><h4>Programiranje</h4><p>Osigurajte pouzdan web uz robustan kod i stabilne integracije.</p></a></li>
                                        </ul>
                                    </div>
                                    <div class="content" data-category="3" style="display:none;">
                                        <ul>
                                            <li><a href="https://e-com.hr/usluge/optimizacija-za-trazilice-seo/"><h4>Optimizacija za tražilice (SEO)</h4><p>Povećanje vidljivosti na tražilicama poput Google-a.</p></a></li>
                                            <li><a href="https://e-com.hr/usluge/digitalno-oglasavanje/"><h4>Digitalno oglašavanje</h4><p>Ciljamo pravu publiku, kroz kampanje s rezultatima.</p></a></li>
                                            <li><a href="https://e-com.hr/usluge/vodenje-drustvenih-mreza/"><h4>Vođenje društvenih mreža</h4><p>Kreiranje sadržaja i upravljanje profilima.</p></a></li>
                                            <li><a href="https://e-com.hr/usluge/pisanje-tekstova-copywriting/"><h4>Pisanje tekstova (Copywriting)</h4><p>Pisanje kvalitetnog sadržaja za web, blogove i kampanje.</p></a></li>
                                        </ul>
                                    </div>
                                    <div class="content" data-category="4" style="display:none;">
                                        <ul>
                                            <li><a href="https://e-com.hr/usluge/web-odrzavanje/"><h4>Web održavanje</h4><p>Održavajte svoj web brzim, sigurnim i stabilnim uz redovno tehničko održavanje.</p></a></li>
                                            <li><a href="https://e-com.hr/usluge/popravci-i-nadogradnja-web-stranice/"><h4>Popravci i nadogradnje weba</h4><p>Rješavanje tehničkih problema i nadogradnje.</p></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="/projekti">
                            PROJEKTI
                            <span class="menu-arrow"><svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0.999817L5 4.99982L9 0.999817" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </a>
                        <div class="sub-menu">
                            <div class="dropdown">
                                <div class="dropdown-sidebar" style="padding-right: 32px; width:272px; margin-right:30px;">
                                    <h3>Projekti</h3>
                                    <div class="usluge-categories">
                                        <a href="/projekti/" class="ecom-btn--tertiary--dd">
                                            <span>VIŠE</span>
                                            <span class="ecom-btn__icon"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6L8 10L12 6" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="projekti-dropdown-content"><?php echo do_shortcode( '[projekti_dropdown]' ); ?></div>
                            </div>
                        </div>
                    </li>

                </ul>
            </nav>

            <!-- Logo -->
            <div class="ecom-logo-container">
                <a href="<?php echo esc_url( $cfg['logo_url'] ); ?>" aria-label="<?php echo esc_attr( $cfg['logo_aria_label'] ); ?>">
                    <?php echo $cfg['logo_svg']; // intentional: trusted inline SVG from config ?>
                </a>
            </div>

            <!-- Desni (right) menu: BLOG + KONTAKT -->
            <nav class="ecom-desni-izbornik">
                <ul>

                    <li>
                        <a href="/blog">
                            BLOG
                            <span class="menu-arrow"><svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0.999817L5 4.99982L9 0.999817" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </a>
                        <div class="sub-menu">
                            <div class="dropdown">
                                <div class="dropdown-sidebar" style="padding-right: 25px; height: 202px; width:240px;">
                                    <h3>Blog</h3>
                                    <p style="width: 250px; margin-top: -20px;">Inspiracija, savjeti i trendovi</p>
                                    <div class="usluge-categories">
                                        <a href="/blog" class="ecom-btn--tertiary--dd" style="margin-top: 107px;">
                                            <span>VIŠE</span>
                                            <span class="ecom-btn__icon"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6L8 10L12 6" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="projekti-dropdown-content"><?php echo do_shortcode( '[blog_dropdown]' ); ?></div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="/kontakt">
                            KONTAKT
                            <span class="menu-arrow"><svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0.999817L5 4.99982L9 0.999817" stroke="#2A2730" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </a>
                        <div class="sub-menu">
                            <div class="dropdown">
                                <div class="dropdown-sidebar" style="width: 240px;">
                                    <h3>Kontakt</h3>
                                    <p style="width: 250px; margin-top: -20px;">Tko smo i kako nas kontaktirati</p>
                                    <div class="usluge-categories">
                                        <a href="/o-nama" class="ecom-btn ecom-btn--secondary" style="margin-top: 127px; justify-content: space-around;">
                                            O NAMA
                                            <span class="ecom-btn__icon"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6L8 10L12 6" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
                                        </a>
                                        <a href="/kontakt" class="ecom-btn ecom-btn--primary" style="justify-content: space-around;">
                                            KONTAKT
                                            <span class="ecom-btn__icon"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6L8 10L12 6" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
                                        </a>
                                    </div>
                                </div>

                                <div class="team-column">
                                    <?php foreach ( $team as $member ) :
                                        $img  = isset( $member['image'] ) ? $member['image'] : '';
                                        $name = isset( $member['name'] ) ? $member['name'] : '';
                                        $role = isset( $member['role'] ) ? $member['role'] : '';
                                        ?>
                                        <div class="team-member">
                                            <?php if ( $img ) : ?>
                                                <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="team-member-image" />
                                            <?php endif; ?>
                                            <div class="team-member-info">
                                                <h4 class="team-member-name"><?php echo esc_html( $name ); ?></h4>
                                                <p class="team-member-role"><?php echo esc_html( $role ); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="contact-column">
                                    <?php if ( ! empty( $contact['phone'] ) ) : ?>
                                        <div class="contact-item">
                                            <span class="contact-label">TELEFON</span>
                                            <p style="color:#2A2730;"><?php echo esc_html( $contact['phone'] ); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $contact['email'] ) ) : ?>
                                        <div class="contact-item">
                                            <span class="contact-label">E-MAIL</span>
                                            <p style="color:#2A2730;"><?php echo esc_html( $contact['email'] ); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $contact['address'] ) ) : ?>
                                        <div class="contact-item">
                                            <span class="contact-label">ADRESA</span>
                                            <p style="color:#2A2730;"><?php echo esc_html( $contact['address'] ); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </nav>

        </div>
    </header>
    <?php
    return ob_get_clean();
}
add_shortcode( 'ecom_mega_menu', 'ecom_mega_menu_shortcode' );

/* =========================================================================
 * [ecom_mobile_menu] — sticky mobile header + fullscreen overlay
 * ====================================================================== */
function ecom_mobile_menu_shortcode() {
    $cfg   = ecom_mega_menu_get_config();
    $links = isset( $cfg['mobile_links'] ) && is_array( $cfg['mobile_links'] ) ? $cfg['mobile_links'] : array();

    ob_start();
    ?>
    <!-- Sticky mobile header -->
    <div class="ecom-mobile-header-container">
        <a href="<?php echo esc_url( $cfg['logo_url'] ); ?>" class="ecom-logo" aria-label="<?php echo esc_attr( $cfg['logo_aria_label'] ); ?>"></a>

        <div class="ecom-hamburger" id="ecom-hamburger" role="button" aria-label="Open menu" aria-expanded="false" tabindex="0">
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>

    <!-- Fullscreen menu overlay -->
    <div class="ecom-menu-overlay" id="ecom-menu-overlay">
        <nav class="ecom-nav-items">
            <?php foreach ( $links as $link ) :
                $label  = isset( $link['label'] ) ? $link['label'] : '';
                $url    = isset( $link['url'] ) ? $link['url'] : '#';
                $is_cta = ! empty( $link['is_cta'] );
                $class  = $is_cta ? 'ecom-btn-kontakt' : '';
                ?>
                <a href="<?php echo esc_url( $url ); ?>"<?php echo $class ? ' class="' . esc_attr( $class ) . '"' : ''; ?>><?php echo esc_html( $label ); ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'ecom_mobile_menu', 'ecom_mobile_menu_shortcode' );
