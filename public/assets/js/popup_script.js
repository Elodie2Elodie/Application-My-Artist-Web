// Sélectionne les éléments nécessaires
var popup = document.getElementById("myPopup");
var btn = document.getElementById("openPopupBtn");
var span = document.getElementsByClassName("close")[0];

// Lorsque l'utilisateur clique sur le bouton, le popup s'affiche
btn.onclick = function() {
    popup.style.display = "block";
}

// Lorsque l'utilisateur clique sur <span> (x), le popup se ferme
span.onclick = function() {
    popup.style.display = "none";
}

// Lorsque l'utilisateur clique n'importe où en dehors du popup, il se ferme
window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
}
