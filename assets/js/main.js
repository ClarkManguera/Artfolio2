// assets/js/main.js

document.addEventListener('DOMContentLoaded', () => {

  // Close mobile nav on outside click
  document.addEventListener('click', (e) => {
    if (document.body.classList.contains('nav-open')) {
      if (!e.target.closest('.mobile-toggle') && !e.target.closest('.mobile-nav')) {
        document.body.classList.remove('nav-open');
      }
    }
  });

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // Subtle parallax on hero
  const hero = document.querySelector('.hero');
  if (hero) {
    window.addEventListener('scroll', () => {
      const y = window.scrollY;
      if (y < 600) {
        hero.style.transform = `translateY(${y * 0.1}px)`;
        hero.style.opacity = 1 - (y / 500);
      }
    }, { passive: true });
  }

});