document.addEventListener('DOMContentLoaded', function() {
    // Ouvrir le popup
    document.querySelectorAll('.open-popup').forEach(function(button) {
        button.addEventListener('click', function() {
            const agentId = this.dataset.agentId;
            document.getElementById('popup-' + agentId).style.display = 'flex';
        });
    });

    // Fermer le popup
    document.querySelectorAll('.close-popup').forEach(function(button) {
        button.addEventListener('click', function() {
            const agentId = this.dataset.agentId;
            document.getElementById('popup-' + agentId).style.display = 'none';
        });
    });

    // Fermer le popup en cliquant à l'extérieur du contenu
    document.querySelectorAll('.popup').forEach(function(popup) {
        popup.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    });

    // Fonction pour masquer le popup
    function hidePopup(id) {
        var popup = document.getElementById('popup-' + id);
        if (popup) {
            popup.style.display = 'none';
        }
    }

    // Ajouter des écouteurs d'événements aux icônes de fermeture
    var closeButtons = document.querySelectorAll('.close');
    closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var popupId = this.getAttribute('data-popup-id');
            hidePopup(popupId);
        });
    });

});



