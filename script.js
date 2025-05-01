document.querySelectorAll('.line').forEach((line, i) => {
  const text = line.getAttribute('data-text');
  line.innerHTML = '';
  text.split('').forEach((char, index) => {
    const span = document.createElement('span');
    span.textContent = char;
    span.style.opacity = '0';
    span.style.transition = `opacity 0.1s ease ${index * 50}ms`;
    line.appendChild(span);
  });

  setTimeout(() => {
    line.querySelectorAll('span').forEach(span => span.style.opacity = '1');
  }, 1000 + i * 2000); // Stagger each line
});
