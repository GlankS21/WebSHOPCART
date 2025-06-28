document.addEventListener('DOMContentLoaded', function() {
    const mobileMenu = document.querySelector('.mobile-menu');
    const subMobileMenu = document.querySelector('.sub-mobile-menu');

    if (mobileMenu && subMobileMenu) {
        mobileMenu.addEventListener('click', function() {
            subMobileMenu.classList.toggle('active');
            mobileMenu.classList.toggle('open');
            if (subMobileMenu.classList.contains('active')) 
                mobileMenu.classList.add('is-fixed');
            else 
                mobileMenu.classList.remove('is-fixed');
        });
        document.addEventListener('click', function(event) {
            if (!subMobileMenu.contains(event.target) && !mobileMenu.contains(event.target)) {
                if (subMobileMenu.classList.contains('active')) {
                    subMobileMenu.classList.remove('active');
                    mobileMenu.classList.remove('open');
                    mobileMenu.classList.remove('is-fixed');
                }
            }
        });
    }
});
// -------------------
document.addEventListener('DOMContentLoaded', function() {
    const filterDropdown = document.querySelector('.filter-dropdown');
    const filterToggle = document.querySelector('.filter-toggle');
    const filterOptions = document.querySelector('.filter-options');
    if (filterToggle && filterOptions && filterDropdown) {
        filterToggle.addEventListener('click', function() {
            filterDropdown.classList.toggle('active');
        });
        document.addEventListener('click', function(event) {
            if (!filterDropdown.contains(event.target))
                filterDropdown.classList.remove('active');
        });
    }
});
// ----------------
document.addEventListener('DOMContentLoaded', function() {
    const favoriteButton = document.querySelector('.favorite-button');
    if (favoriteButton) {
        favoriteButton.addEventListener('click', function() {
            this.classList.toggle('favorited');
        });
    }
});