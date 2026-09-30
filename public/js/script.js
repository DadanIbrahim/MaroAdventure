document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById('mainNavbar');
    const backToTop = document.getElementById('backToTop');

    const updateScrollState = () => {
        const scrolled = window.scrollY > 40;

        if (navbar) {
            navbar.classList.toggle('scrolled', scrolled);
        }

        if (backToTop) {
            backToTop.classList.toggle('show', window.scrollY > 400);
        }
    };

    window.addEventListener('scroll', updateScrollState, { passive: true });
    updateScrollState();

    if (backToTop) {
        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    const animatedElements = document.querySelectorAll(
        '.fade-up, .fade-left, .fade-right'
    );

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        animatedElements.forEach((element) => observer.observe(element));
    } else {
        animatedElements.forEach((element) => {
            element.classList.add('visible');
        });
    }

    const navLinks = document.querySelectorAll('#navbarMenu .nav-link');
    const sections = document.querySelectorAll('section[id]');

    if ('IntersectionObserver' in window) {
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                navLinks.forEach((link) => {
                    link.classList.toggle(
                        'active',
                        link.getAttribute('href') === `#${entry.target.id}`
                    );
                });
            });
        }, {
            rootMargin: '-35% 0px -55% 0px',
            threshold: 0
        });

        sections.forEach((section) => sectionObserver.observe(section));
    }
});
