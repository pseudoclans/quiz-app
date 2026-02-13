import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const root = document.documentElement;
    const body = document.body;

    // Page transition
    requestAnimationFrame(() => {
        body.classList.add('is-loaded');
    });

    // Theme toggle
    const storedTheme = localStorage.getItem('theme');
    const prefersLight = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches;
    const initialTheme = storedTheme || (prefersLight ? 'light' : 'dark');
    root.setAttribute('data-theme', initialTheme);

    const themeToggle = document.getElementById('themeToggle');
    const themeLabel = document.getElementById('themeLabel');

    const updateThemeUI = (theme) => {
        if (themeLabel) themeLabel.textContent = theme === 'light' ? 'Light' : 'Dark';
        if (themeToggle) themeToggle.setAttribute('aria-pressed', theme === 'light');
    };

    updateThemeUI(initialTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const nextTheme = root.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            root.setAttribute('data-theme', nextTheme);
            localStorage.setItem('theme', nextTheme);
            updateThemeUI(nextTheme);
        });
    }

    // Reveal animations
    const revealItems = document.querySelectorAll('[data-reveal]');
    revealItems.forEach((item) => {
        const delay = Number(item.getAttribute('data-delay') || 0);
        setTimeout(() => item.classList.add('revealed'), delay);
    });

    // Form validation feedback
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const requiredInputs = form.querySelectorAll('[required]');
            let allFilled = true;
            
            requiredInputs.forEach(input => {
                if (input.type === 'radio') {
                    const name = input.name;
                    const checked = form.querySelector(`input[name="${name}"]:checked`);
                    if (!checked) {
                        allFilled = false;
                    }
                } else if (!input.value.trim()) {
                    allFilled = false;
                }
            });

            if (!allFilled) {
                e.preventDefault();
                alert('Please answer all questions before submitting.');
            }
        });
    }
});
