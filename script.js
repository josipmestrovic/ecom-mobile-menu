document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.ecom-hamburger');
    const overlay = document.querySelector('.ecom-mobile-overlay');

    if (hamburger && overlay) {
        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('is-active');
            overlay.classList.toggle('is-open');
            
            // Optional: Prevent body scrolling when menu is open
            if (overlay.classList.contains('is-open')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
    }
});
