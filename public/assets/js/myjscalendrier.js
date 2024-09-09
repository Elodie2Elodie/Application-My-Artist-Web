$(document).ready(function() {
    // Initialisation du datepicker
    $('#inline-datepicker').datepicker({
        format: 'dd/mm/yyyy', // Format de la date
        autoclose: true // Fermer automatiquement après sélection
    }).on('changeDate', function(e) {
        // Récupérer la date sélectionnée
        var selectedDate = e.format('yyyy-mm-dd'); // Récupérer la date au format 'yyyy-mm-dd'
        console.log('Date sélectionnée :', selectedDate);
        
        // Appeler une fonction pour récupérer les commandes en fonction de la date
        fetchCommandes(selectedDate);
        // Mettre à jour la date sélectionnée affichée
        $('#selected-date').text(selectedDate);

        
    });

    // Obtenir la date du jour au format 'yyyy-mm-dd'
    var today = new Date();
    var day = ("0" + today.getDate()).slice(-2);
    var month = ("0" + (today.getMonth() + 1)).slice(-2);
    var todayFormatted = today.getFullYear() + '-' + month + '-' + day;

    console.log('Date du jour :', todayFormatted);

    // Récupérer les commandes du jour par défaut
    fetchCommandes(todayFormatted);

    // Mettre à jour la date sélectionnée affichée par défaut
    $('#selected-date').text(todayFormatted);
});


function fetchCommandes(date) {
    var formattedDate = date.split('/').reverse().join('-'); // Convertir 'dd/mm/yyyy' à 'yyyy-mm-dd'
    var url = $('#route-fetch-commandes').data('url').replace('2024-09-22', formattedDate);
    
    $.ajax({
        url: url,
        method: 'GET',
        data: { date: date },
        success: function(response) {
            updateCommandesTable(response);
        },
        error: function(xhr) {
            console.error('Erreur lors de la récupération des commandes : ', xhr.responseText);
        }
    });
}


function updateCommandesTable(data) {
    var tableBody = $('#commandes-table-body');
    tableBody.empty(); // Vider le tableau existant

    // Assumer que 'data' est un tableau d'objets commandes
    data.forEach(function(commande) {
        // Créer la ligne de tableau en tant qu'objet jQuery
        var row = $("<tr  id='" + commande['commandeId'] + "'>" +
            "<td >" + commande['nomClient'] + '</td>' +
            '<td>' + commande['nomCommande'] + '</td>' +
            '<td>' + commande['dateDebut'] + '</td>' +
            '<td>' + commande['dateFin'] + '</td>' +
            "<td> <label class='badge badge-gradient-success'>" + commande['status'] + '</label></td>' +
            '<td>' + commande['progression'] + '</td>' +
            '</tr>');

        // Ajouter l'événement de clic pour chaque ligne
        row.on('click', function() {
            // Retirer la classe 'selected-row' de toutes les autres lignes
            tableBody.find('tr').removeClass('selected-row');
            console.log("Ligne sélectionnée : ", commande['nomCommande']);
            // Ajouter la classe 'selected-row' à la ligne cliquée
            $(this).addClass('selected-row');

            // Mettre à jour les tâches affichées
            updateTaskList(commande['taches']);
        });

        // Ajouter la ligne au tableau
        tableBody.append(row);
    });
}

function updateTaskList(taches) {
    console.log(taches);
    var taskList = $('.todo-list');
    taskList.empty(); // Vider les tâches existantes

    // Si 'taches' est une chaîne, la convertir en tableau
    if (typeof taches === 'string') {
        try {
            taches = JSON.parse(taches); // Convertir la chaîne JSON en tableau
        } catch (e) {
            console.error("Erreur lors de la conversion des tâches en JSON : ", e);
            return;
        }
    }

    if (Array.isArray(taches)) {
        taches.forEach(function(tache) {
            var completed = (tache['completed'] === "fait"); // Vérifier si la tâche est complétée
            var taskItem = $('<li>' +
                '<div class="form-check">' +
                '<label class="form-check-label">' +
                '<input class="checkbox" type="checkbox" ' + (completed ? 'checked' : '') + '> ' + tache['text'] + 
                '</label>' +
                '</div>' +
                '</li>');
                

            taskList.append(taskItem);
        });
    } else {
        console.error('Les tâches ne sont pas sous forme de tableau', taches);
    }
}

