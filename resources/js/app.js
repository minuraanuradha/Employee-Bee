/* Employee Bee Front-End JavaScript*/
document.addEventListener('DOMContentLoaded', () => {
    console.log('Employee Bee front-end initialized');
});

/* Nav Bar Links Active State */
document.addEventListener('DOMContentLoaded', () => {
    console.log('this message only');
    const debugMode = true;
    const currentPath = window.location.pathname;
    const homeLink = document.getElementById('home-link');
    const companiesLink = document.getElementById('companies-link');
    const aboutLink = document.getElementById('about-link');
    const helpLink = document.getElementById('help-link');

    if (debugMode) {
        console.log('Current path:', currentPath);
    }

    if (homeLink && companiesLink && aboutLink && helpLink) {
        if (currentPath === '/' || currentPath === '/index.html') {
            homeLink.classList.add('active');
        } else if (currentPath === '/companies.html') {
            companiesLink.classList.add('active');
        } else if (currentPath === '/about.html') {
            aboutLink.classList.add('active');
        } else if (currentPath === '/help.html') {
            helpLink.classList.add('active');
        }
    } else {
        if (debugMode) {
            console.warn('Navbar links not found. Ensure IDs are present in the navbar.');
        }
    }

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            if (debugMode) {
                console.log('Form submitted:', data);
            }
            alert('Form submitted! Check console for data.');
        });
    });
});