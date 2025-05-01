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
  utterance.rate = 0.9;

  // Pick a Hindi-English voice if available
  const voices = speechSynthesis.getVoices();
  const voice = voices.find(v => 
    v.lang.toLowerCase().includes('hi') || 
    v.name.toLowerCase().includes('india')
  ) || voices[0];

  utterance.voice = voice;

  utterance.onend = () => {
    callback();
  };

  speechSynthesis.speak(utterance);
}

function showNextLine() {
  if (currentLine >= lines.length) return;

  const el = lines[currentLine];
  const text = el.getAttribute('data-text');

  typeLine(el, text, () => {
    speakText(text, () => {
      currentLine++;
      setTimeout(showNextLine, 500);
    });
  });
}

// Ensure voices are loaded before starting
function startWithVoicesReady() {
  if (speechSynthesis.getVoices().length !== 0) {
    showNextLine();
  } else {
    speechSynthesis.onvoiceschanged = () => {
      showNextLine();
    };
  }
}

window.addEventListener('DOMContentLoaded', () => {
  startWithVoicesReady();
});
