document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById('mainNavbar');
    const backToTop = document.getElementById('backToTop');

    // ── Navbar scroll state ──────────────────────────────────────────
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
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ── Scroll-reveal animations ──────────────────────────────────────
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
        animatedElements.forEach((element) => element.classList.add('visible'));
    }

    // ── Active nav link on scroll ──────────────────────────────────────
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

    // ── Animated counter for hero stats ──────────────────────────────
    const counters = document.querySelectorAll('.stat-number[data-target]');

    if (counters.length && 'IntersectionObserver' in window) {
        const animateCounter = (el) => {
            const target = parseInt(el.dataset.target, 10);
            const suffix = el.dataset.suffix || '';
            const duration = 1800;
            const start = performance.now();

            const step = (now) => {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                // Ease-out cubic
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(eased * target);
                el.textContent = current + suffix;

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    el.textContent = target + suffix;
                }
            };

            requestAnimationFrame(step);
        };

        const counterObserver = new IntersectionObserver((entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach((counter) => counterObserver.observe(counter));
    }

    // ── Auto-collapse mobile navbar on link click ──────────────────────
    const navbarCollapse = document.getElementById('navbarMenu');
    if (navbarCollapse) {
        const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: false });
        const allMenuLinks = navbarCollapse.querySelectorAll('.nav-link:not(.dropdown-toggle), .dropdown-item');
        allMenuLinks.forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                    bsCollapse.hide();
                }
            });
        });
    }
});
