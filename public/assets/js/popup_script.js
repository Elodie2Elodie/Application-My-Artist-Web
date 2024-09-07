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


  document.getElementById('createButton').addEventListener('click', function(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('firstName', document.querySelector('input[name="firstName"]').value);
    formData.append('lastName', document.querySelector('input[name="lastName"]').value);
    formData.append('email', document.querySelector('input[name="email"]').value);
    formData.append('adress', document.querySelector('input[name="adress"]').value);
    formData.append('telephone', document.querySelector('input[name="telephone"]').value);
    formData.append('role', document.querySelector('input[name="role"]').value);
    formData.append('firstConnection', document.querySelector('input[name="firstConnection"]').value);

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/auth/registerUser', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken, // Ajout du token CSRF
      },
      body: formData,
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success' && data.closePopup) {
        document.getElementById('myPopup').style.display = 'none';
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
    });
});

 // Fonction qui sera appelée après la création du client
 function handleClientCreated(newClientId, newClientName) {
    // Vider les champs du formulaire
    document.querySelectorAll('.custom-input').forEach(input => {
        input.value = '';
    });

    // Sélectionner automatiquement le nouveau client dans le select
    let clientSelect = document.getElementById('clientSelect');
    // Créer une nouvelle option pour le client
    let newOption = document.createElement('option');
    newOption.value = newClientId;
    newOption.text = newClientName;

    // Ajouter la nouvelle option au select
    clientSelect.appendChild(newOption);
    
    // Sélectionner le nouveau client
    clientSelect.value = newClientId;
}

// Exemple d'utilisation de cette fonction après une soumission réussie
// Appel de la fonction en passant l'ID et le nom du nouveau client
// handleClientCreated('12345', 'John Doe'); // remplacer par les valeurs dynamiques après soumission
