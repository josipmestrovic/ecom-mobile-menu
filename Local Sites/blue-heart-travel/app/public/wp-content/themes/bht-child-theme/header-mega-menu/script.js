/* =============================================================================
 * ECOM Header Mega Menu — script
 *
 * Loaded by includes/assets.php in the footer. Vanilla JS, no jQuery.
 *
 * Concerns (in order):
 *   A. Mobile hamburger toggle + dynamic body padding
 *   B. Mobile scroll-hide header (show on scroll up)
 *   C. Desktop hover/blur + open submenu
 *   D. Desktop "Usluge" tab switcher (data-category)
 *   E. Desktop scroll-close submenus
 *
 * Each concern is wrapped in its own DOMContentLoaded block so a missing
 * piece of markup (e.g. only the desktop or only the mobile shortcode is
 * on the page) doesn't break the rest.
 * ============================================================================= */


/* -----------------------------------------------------------------------------
 * A + B. Mobile sticky header — hamburger toggle, body padding, scroll-hide
 * -------------------------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.getElementById('ecom-hamburger');
    const overlay   = document.getElementById('ecom-menu-overlay');
    const header    = document.querySelector('.ecom-mobile-header-container');

    let lastScrollTop = 0;
    const delta = 5;

    // Push page content down by the live header height (0 when hidden via CSS).
    function adjustBodyPadding() {
        if (!header) return;
        const headerHeight = header.offsetHeight;
        document.body.style.paddingTop = headerHeight + 'px';
    }
    adjustBodyPadding();
    window.addEventListener('resize', adjustBodyPadding);

    // A. Hamburger toggles the fullscreen overlay + locks body scroll.
    if (hamburger && overlay) {
        hamburger.addEventListener('click', function () {
            hamburger.classList.toggle('active');
            overlay.classList.toggle('open');

            const isOpen = overlay.classList.contains('open');
            hamburger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });
    }

    // B. Hide header on scroll-down past one header-height; show on scroll-up.
    if (header) {
        window.addEventListener('scroll', function () {
            // Don't hide while overlay is open.
            if (overlay && overlay.classList.contains('open')) return;

            const st = window.pageYOffset || document.documentElement.scrollTop;
            if (Math.abs(lastScrollTop - st) <= delta) return;

            if (st > lastScrollTop && st > header.offsetHeight) {
                header.classList.add('ecom-header-hidden');
            } else {
                header.classList.remove('ecom-header-hidden');
            }
            lastScrollTop = st;
        });
    }
});


/* -----------------------------------------------------------------------------
 * C + D + E. Desktop mega menu — hover/blur, tab switcher, scroll-close
 * -------------------------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', function () {
    const menuItems       = document.querySelectorAll('.ecom-header-container nav > ul > li');
    const headerContainer = document.querySelector('.ecom-header-container');
    const mainArea        = document.getElementById('et-main-area'); // Divi main wrapper

    // C. Hover-activated submenus + page blur.
    menuItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            menuItems.forEach(i => { if (i !== item) i.classList.remove('active'); });
            item.classList.add('active');

            if (mainArea) {
                mainArea.style.filter = 'blur(10px)';
                mainArea.style.transition = 'filter 0.3s ease-in-out';
            }
        });
    });

    if (headerContainer) {
        headerContainer.addEventListener('mouseleave', () => {
            menuItems.forEach(item => item.classList.remove('active'));
            if (mainArea) mainArea.style.filter = 'none';
        });
    }

    // D. "Usluge" submenu category tabs (left rail switches right content).
    const categoryButtons = document.querySelectorAll('.usluge-categories .category');
    const contentDivs     = document.querySelectorAll('.usluge-content .content');

    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            const categoryId = button.getAttribute('data-category');

            categoryButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            contentDivs.forEach(div => {
                div.style.display = (div.getAttribute('data-category') === categoryId) ? 'block' : 'none';
            });
        });
    });

    // E. Close any open submenu the moment the user starts scrolling down.
    let lastScrollY = window.scrollY;
    let ticking     = false;

    function handleScroll() {
        if (window.scrollY > lastScrollY) {
            menuItems.forEach(item => item.classList.remove('active'));
            if (mainArea) mainArea.style.filter = 'none';
        }
        lastScrollY = window.scrollY;
    }

    window.addEventListener('scroll', function () {
        if (!ticking) {
            window.requestAnimationFrame(function () {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    });
});
