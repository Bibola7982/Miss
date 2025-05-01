const lines = document.querySelectorAll('.line');

let currentLine = 0;

function typeLine(lineElement, text, callback) {
  let index = 0;
  lineElement.textContent = '';

  const interval = setInterval(() => {
    if (index < text.length) {
      lineElement.textContent += text.charAt(index);
      index++;
    } else {
      clearInterval(interval);
      callback();
    }
  }, 50); // typing speed
}

function speakText(text, callback) {
  const utterance = new SpeechSynthesisUtterance(text);
  utterance.lang = 'hi-IN'; // Use 'en-US' for English
  utterance.rate = 0.9;

  utterance.onend = () => {
    callback();
  };

  window.speechSynthesis.speak(utterance);
}

function showNextLine() {
  if (currentLine >= lines.length) return;

  const el = lines[currentLine];
  const text = el.getAttribute('data-text');

  typeLine(el, text, () => {
    speakText(text, () => {
      currentLine++;
      setTimeout(showNextLine, 500); // small pause between lines
    });
  });
}

// Start animation and voice after page loads
window.addEventListener('DOMContentLoaded', () => {
  showNextLine();
});
