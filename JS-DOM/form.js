const form = document.getElementById('formHobi');
const hasil = document.getElementById('hasil');

const formNode = form.childNodes;
console.log("Semua node dalam form:");
formNode.forEach(node => {
    console.log("Tipe node:", node.nodeType, "Isi:", node.nodeName);
});

console.log("FORM parent node:", form.parentNode); 
console.log("FORM children:", form.children);   
console.log("FORM first input:", form.firstElementChild);

form.addEventListener('submit', function(e) {
    e.preventDefault();

    const nama = document.getElementById('nama').value;
    const hobi = document.getElementById('hobi').value;

    const inputHobi = document.getElementById('hobi');
    const labelHobi = inputHobi.parentElement; 
    const sibling = labelHobi.nextElementSibling; 

    console.log("Sibling setelah label Hobi:", sibling);

    hasil.textContent = `Halo ${nama}, kamu suka ${hobi}! 🌟`;
});
