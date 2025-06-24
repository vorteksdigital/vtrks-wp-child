document.addEventListener("DOMContentLoaded", () => {
  // Remove sidebar widgets
  document.querySelectorAll('.widget, .ads, .related-posts').forEach(el => el.remove());

  // Remove empty divs or unnecessary wrappers
  document.querySelectorAll('div:empty, section:empty').forEach(el => el.remove());

  // Remove comments section
  const comments = document.getElementById('comments');
  if (comments) comments.remove();
});

document.addEventListener("DOMContentLoaded", () => {
  const lazySections = document.querySelectorAll('[data-lazy]');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const section = entry.target;
        section.innerHTML = section.dataset.lazy; // Replace placeholder
        observer.unobserve(section);
      }
    });
  });

  lazySections.forEach(section => observer.observe(section));
});

document.addEventListener("DOMContentLoaded", () => {
  const menus = document.querySelectorAll('.footer-menu, .mobile-menu');
  menus.forEach(menu => {
    menu.innerHTML = ''; // Or keep a "Load Menu" button
  });
});

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll('svg, .icon').forEach(icon => {
    icon.remove(); // or replace with a span if necessary
  });
});

console.log("Total nodes:", document.getElementsByTagName('*').length);
