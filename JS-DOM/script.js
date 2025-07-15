const actionBtn = document.getElementById("actionBtn");
const resetBtn = document.getElementById("resetBtn");
const text = document.getElementById("text");
const emojiList = document.getElementsByClassName("emoji");

const semuaTombol = document.querySelectorAll('button'); 
semuaTombol.forEach((btn, index) => {
    btn.style.backgroundColor = index % 2 === 0 ? '#f06292' : '#64b5f6'; 
});

let count = 0;

const messages = [
  "Hallo DOM Warrior!",
  "Kamu luar biasa!",
  "Jangan berhenti belajar 💪",
  "Klik terus ajaa 😆",
  "Wowww udah berapa kali nih?",
  "Keep going, coder cilik 🌞"
];

function getRandomColor() {
  const r = Math.floor(Math.random() * 256);
  const g = Math.floor(Math.random() * 256);
  const b = Math.floor(Math.random() * 256);
  return `rgb(${r}, ${g}, ${b})`;
}

function getRandomMessage() {
  return messages[Math.floor(Math.random() * messages.length)];
}

actionBtn.addEventListener("click", () => {
  count++;
  document.body.style.backgroundColor = getRandomColor();
  text.textContent = `${getRandomMessage()} (klik ke-${count})`;
  text.classList.add("bounce");
  setTimeout(() => text.classList.remove("bounce"), 500);

  for (let i = 0; i < emojiList.length; i++) {
    emojiList[i].style.color = getRandomColor();
    emojiList[i].style.fontSize = "2rem";
  }
});

resetBtn.addEventListener("click", () => {
  document.body.style.backgroundColor = "#ffffff";
  count = 0;
  text.textContent = "Click the Button for funny!";

  for (let i = 0; i < emojiList.length; i++) {
    emojiList[i].style.color = "#000";
    emojiList[i].style.fontSize = "1.5rem";
  }
});
