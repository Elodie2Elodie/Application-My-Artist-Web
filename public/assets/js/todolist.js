(function($) {
  'use strict';
  $(function() {
    var todoListItem = $('.todo-list');
    var todoListInput = $('.todo-list-input');
    $('.todo-list-add-btn').on("click", function(event) {
      event.preventDefault();

      var item = $(this).prevAll('.todo-list-input').val();

      if (item) {
        todoListItem.append("<li><div class='form-check'><label class='form-check-label'><input class='checkbox' type='checkbox'/>" + item + "<i class='input-helper'></i></label></div><i class='remove mdi mdi-close-circle-outline'></i></li>");
        todoListInput.val("");
      }

    });

    todoListItem.on('change', '.checkbox', function() {
      if ($(this).attr('checked')) {
        $(this).removeAttr('checked');
      } else {
        $(this).attr('checked', 'checked');
      }

      $(this).closest("li").toggleClass('completed');

    });

    todoListItem.on('click', '.remove', function() {
      $(this).parent().remove();
    });

    
     
  });
})(jQuery);

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('submit-tasks').addEventListener('click', function(e) {
    e.preventDefault();

    // Récupérer les valeurs des inputs
    const clientId = document.getElementById('clientSelect').value;
    const couturierId = document.querySelector('select[name="couturierId"]').value;
    const paiement = document.querySelector('select[name="paiement"]').value;
    const modePaiement = document.querySelector('select[name="modePaiement"]').value;
    const dateDebut = document.querySelector('input[name="dateDebut"]').value;
    const dateFin = document.querySelector('input[name="dateFin"]').value;
    const prix = document.querySelector('input[name="prix"]').value;
    const role = document.querySelector('input[name="role"]').value;
    const firstConnection = document.querySelector('input[name="firstConnection"]').value;

    // Créer un objet FormData
    const formData = new FormData();
    formData.append('clientId', clientId);
    formData.append('couturierId', couturierId);
    formData.append('dateDebut', dateDebut);
    formData.append('dateFin', dateFin);
    formData.append('prix', prix);
    formData.append('role', role);
    formData.append('firstConnection', firstConnection);
    formData.append('paiement', paiement);
    formData.append('modePaiement', modePaiement);
    formData.append('taches', JSON.stringify(getTasks()));
    console.log(JSON.stringify(getTasks()));

    // Ajouter le fichier photo_commande au FormData
    const fileInput = document.getElementById('fileInput');
    if (fileInput.files.length > 0) {
      formData.append('photo_commande', fileInput.files[0]);
    }
    // Afficher formData pour vérifier son contenu
    for (var pair of formData.entries()) {
      console.log(pair[0]+ ': ' + pair[1]);
   }

    console.log(formData);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(csrfToken);
    
    fetch('/commandes/createCommande', {
      method: 'POST',
      headers: {
          'X-CSRF-TOKEN': csrfToken,
      },
      body: formData,
  })
  .then(response => {
      if (!response.ok) {
          // throw new Error('Erreur réseau',);
          return response.text().then(text => { throw new Error(text); });
      }
      // Vous pouvez choisir de ne rien faire après l'envoi
      console.log('Commande envoyée avec succès');
      window.location.href = '/commandes/showListeCommande'
  })
  .catch(error => {
      console.error('Erreur:', error);
  });
});

    
});

//Modification

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('modifierCommande').addEventListener('click', function(e) {
    e.preventDefault();

    // Récupérer les valeurs des inputs
    const couturierId = document.querySelector('select[name="couturierId"]').value;
    const commandeId = document.querySelector('input[name="commandeId"]').value;
    const dateDebut = document.querySelector('input[name="dateDebut"]').value;
    const dateFin = document.querySelector('input[name="dateFin"]').value;
    const prix = document.querySelector('input[name="prix"]').value;
    const paiement = document.querySelector('select[name="paiement"]').value;
    const modePaiement = document.querySelector('select[name="modePaiement"]').value;

    // Créer un objet FormData
    const formData = new FormData();
    formData.append('couturierId', couturierId);
    formData.append('commandeId', commandeId);
    formData.append('dateDebut', dateDebut);
    formData.append('dateFin', dateFin);
    formData.append('prix', prix);
    formData.append('paiement', paiement);
    formData.append('modePaiement', modePaiement);
    formData.append('taches', JSON.stringify(getTasks()));
    console.log(JSON.stringify(getTasks()));

    // Ajouter le fichier photo_commande au FormData
    const fileInput = document.getElementById('fileInput');
    if (fileInput.files.length > 0) {
      formData.append('photo_commande', fileInput.files[0]);
    }
    // Afficher formData pour vérifier son contenu
    for (var pair of formData.entries()) {
      console.log(pair[0]+ ': ' + pair[1]);
   }

    console.log(formData);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(csrfToken);
    
    fetch('/commandes/updateCommande', {
      method: 'POST',
      headers: {
          'X-CSRF-TOKEN': csrfToken,
      },
      body: formData,
  })
  .then(response => {
      if (!response.ok) {
          // throw new Error('Erreur réseau',);
          return response.text().then(text => { throw new Error(text); });
      }
      // Vous pouvez choisir de ne rien faire après l'envoi
      console.log('Commande envoyée avec succès');
      window.location.href = '/commandes/showListeCommande'
  })
  .catch(error => {
      console.error('Erreur:', error);
  });
});

    
});

// Fonction pour récupérer les tâches et leur état
function getTasks() {
  const tasks = [];
  document.querySelectorAll('.todo-list li').forEach(function(li) {
    const taskText = li.querySelector('.form-check-label').textContent.trim();
    const isCompleted = li.classList.contains('completed');
    tasks.push({
      text: taskText,
      completed: isCompleted ? 'fait' : 'non fait'
    });
  });
  return tasks;
}

document.addEventListener('DOMContentLoaded', function() {
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('dateDebut').setAttribute('min', today);
  document.getElementById('dateFin').setAttribute('min', today);
});



function toggleModePaiement() {
  var paiementValue = document.getElementById('paiementSelect').value;
  var modePaiementContainer = document.getElementById('modePaiementContainer');
  var modePaiementSelect = document.getElementById('modePaiementSelect');

  if (paiementValue === 'payer') {
    modePaiementContainer.removeAttribute('hidden');
  } else {
    modePaiementSelect.value = '';
    modePaiementContainer.setAttribute('hidden', 'true');
  }
}


// Vérifie au chargement de la page si le paiement est déjà "payer"
document.addEventListener('DOMContentLoaded', function() {
  toggleModePaiement();

  // Ajoute un écouteur d'événements pour détecter les changements de valeur
  document.getElementById('paiementSelect').addEventListener('change', toggleModePaiement);
});


  var clientId = "{{ $commande['client_id'] }}";  // Si l'ID est disponible

    console.log("ID du client : " + clientId);

  //   document.getElementById('openPopupButton').addEventListener('click', function() {
  //     openPopup(clientId);
  // });

  function openPopup(clientId) {
    // Afficher le popup
    document.getElementById('myPopup').style.display = 'block';

    // Récupérer les mensurations du client via une requête Ajax
    fetch(`commandes/mensurations/${clientId}`)
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          alert('Erreur: ' + data.error);
        } else {
          // Charger les mensurations dans les champs du formulaire
          document.querySelector("input[placeholder='Tour de taille (cm)']").value = data.tour_de_taille || '';
          document.querySelector("input[placeholder='Tour de poitrine (cm)']").value = data.tour_de_poitrine || '';
          document.querySelector("input[placeholder='Tour de hanches (cm)']").value = data.tour_de_hanches || '';
          document.querySelector("input[placeholder='Longueur de bras (cm)']").value = data.longueur_de_bras || '';
          document.querySelector("input[placeholder='Longueur de jambes (cm)']").value = data.longueur_de_jambes || '';
          document.querySelector("input[placeholder='Largeur des épaules (cm)']").value = data.largeur_des_epaules || '';
          document.querySelector("input[placeholder='Tour de cou (cm)']").value = data.tour_de_cou || '';
          document.querySelector("input[placeholder='Tour de bras (cm)']").value = data.tour_de_bras || '';
          document.querySelector("input[placeholder='Tour de cuisse (cm)']").value = data.tour_de_cuisse || '';
          document.querySelector("input[placeholder='Tour de mollet (cm)']").value = data.tour_de_mollet || '';
          document.querySelector("input[placeholder='Hauteur du buste (cm)']").value = data.hauteur_du_buste || '';
          document.querySelector("input[placeholder='Longueur totale (cm)']").value = data.longueur_totale || '';
        }
      })
      .catch(error => {
        console.error('Erreur lors du chargement des mensurations:', error);
      });
  }

  // Fermer le popup
  function closePopup() {
    document.getElementById('myPopup').style.display = 'none';
  }



