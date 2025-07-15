/* Employee Bee Front-End JavaScript */
document.addEventListener('DOMContentLoaded', () => {
    const debugMode = true;
    const currentPath = window.location.pathname;

    console.log('Current path:', currentPath);
    console.log('Employee Bee front-end initialized');

    /* Nav Bar Toggle for Mobile */
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mainContent = document.getElementById('main-content');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    let menuOpen = false;

    menuToggle.addEventListener('click', function () {
        menuOpen = !menuOpen;
        console.log('Menu toggle clicked, menuOpen:', menuOpen);

        if (menuOpen) {
            mobileMenu.classList.remove('hidden');
            mainContent.classList.add('hidden');
            hamburgerIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            console.log('Toggle menu opened, content hidden');
        } else {
            mobileMenu.classList.add('hidden');
            mainContent.classList.remove('hidden');
            hamburgerIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            console.log('Toggle menu closed, content visible');
        }
    });
});

