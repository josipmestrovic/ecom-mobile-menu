<?php
function ecom_mobile_menu_shortcode() {
    ob_start();
    ?>
    <!-- Wrapper only visible on mobile via CSS -->
    <div id="ecom-mobile-nav-wrapper">
        
        <!-- Header Bar (Always Visible) -->
        <div class="ecom-mobile-header">
            <div class="ecom-logo">
                <!-- Replace with your actual logo URL or dynamic code -->
                <a href="<?php echo home_url(); ?>">
                   <img src="/path/to/your/logo.svg" alt="Ecom Logo" />
                </a>
            </div>
            <button class="ecom-hamburger" aria-label="Open Menu">
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Full Screen Menu Overlay (Hidden by default) -->
        <div class="ecom-mobile-overlay">
            <nav class="ecom-mobile-links">
                <!-- Adjust links as needed -->
                <a href="/usluge">Usluge</a>
                <a href="/projekti">Projekti</a>
                <a href="/blog">Blog</a>
                <a href="/o-nama">O nama</a>
                
                <div class="ecom-cta-container">
                    <a href="/kontakt" class="ecom-btn-contact">Kontakt</a>
                </div>
            </nav>
        </div>

    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ecom_mobile_menu', 'ecom_mobile_menu_shortcode');
