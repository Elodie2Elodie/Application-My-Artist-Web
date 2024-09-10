// Assurez-vous d'inclure jQuery ou utilisez Fetch API

$(document).ready(function() {
  $.ajax({
    url: 'http://127.0.0.1:8000/commandes/pieChart',
    method: 'GET',
    success: function(response) {
      // Manipulez les données pour mettre à jour votre graphique
      const data = response; // Adaptez cette partie selon votre structure de données

      updateChart(data);
    },
    error: function(xhr) {
      console.error('Erreur lors de la récupération des données :', xhr.responseText);
    }
  });

  function updateChart(data) {
    // Préparez les données pour le graphique
    // Vérifiez si data est un objet
    if (typeof data !== 'object' || data === null) {
      console.error('Les données reçues ne sont pas un objet:', data);
      return;
    }

  // Extraire les labels et les valeurs des données reçues
    const labels = Object.keys(data);
    const values = [1,1,1];
    // const values = Object.values(data);
    

    new Chart(document.getElementById('traffic-chart'), {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: ['rgba(54, 215, 232, 1)', 'rgba(255, 191, 150, 1)', 'rgba(6, 185, 157, 1)'],
          hoverBackgroundColor: ['rgba(54, 215, 232, 0.7)', 'rgba(255, 191, 150, 0.7)', 'rgba(6, 185, 157, 0.7)']
        }]
      },
      options: {
        cutout: 50,
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: true
          }
        }
      },
      plugins: [{
        id: 'customLegend',
        afterDatasetUpdate: function (chart) {
            const legendId = `${chart.canvas.id}-legend`;
            const ul = document.createElement('ul');
            const { labels } = chart.data;

            // Vérifiez que les labels existent avant d'y accéder
            if (labels && labels.length > 0) {
                for (let i = 0; i < labels.length; i++) {
                    ul.innerHTML += `
                        <li>
                          <span style="background-color: ${chart.data.datasets[0].backgroundColor[i]}"></span>
                          ${labels[i]}
                        </li>
                    `;
                }
            }

            document.getElementById(legendId).innerHTML = ''; // Clear previous legend
            document.getElementById(legendId).appendChild(ul);
        }
    }]
    });
  }
});


$(document).ready(function() {
  // Fonction pour obtenir la couleur de dégradé en fonction du label
  function getGradientColor(label) {
      switch (label) {
          case 'Retard':
              return 'rgba(218, 140, 255, 1)';
          case 'Attente':
              return 'rgba(54, 215, 232, 1)';
          case 'Cours':
              return 'rgba(255, 191, 150, 1)';
          default:
              return 'rgba(0, 0, 0, 0.1)';
      }
  }

  // Fonction pour mettre à jour le graphique
  function updateChart(data) {
      // Vérifiez si data est un tableau d'objets
      if (!Array.isArray(data) || data.length === 0) {
          console.error('Les données reçues ne sont pas un tableau valide:', data);
          return;
      }

      // Extraire les mois (les clés des objets de chaque mois)
      const months = ['JAN', 'FEB', 'MAR', 'AVR', 'MAI', 'JUIN', 'JUIL', 'AUO'];

      // Extraire les labels à partir des clés des objets de données
      const labels = Object.keys(data[0]);

      // Initialiser les données pour chaque série
      const seriesData = labels.map(label => {
          return {
              label: label,
              borderColor: getGradientColor(label),
              backgroundColor: getGradientColor(label),
              hoverBackgroundColor: getGradientColor(label),
              pointRadius: 0,
              fill: false,
              borderWidth: 1,
              data: data.map(monthData => monthData[label]),
              barPercentage: 0.5,
              categoryPercentage: 0.5
          };
      });

      const ctx = document.getElementById('visit-sale-chart').getContext('2d');

      new Chart(ctx, {
          type: 'bar',
          data: {
              labels: months,
              datasets: seriesData
          },
          options: {
              responsive: true,
              maintainAspectRatio: true,
              elements: {
                  line: {
                      tension: 0.4,
                  },
              },
              scales: {
                  y: {
                      display: true,
                      grid: {
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                      },
                  },
                  x: {
                      display: true,
                      grid: {
                          display: false,
                      },
                  }
              },
              plugins: {
                  legend: {
                      display: false,
                  }
              }
          },
          plugins: [{
              id: 'customLegend',
              afterDatasetUpdate: function (chart, args, options) {
                  const chartId = chart.canvas.id;
                  const legendId = `${chartId}-legend`;
                  const ul = document.createElement('ul');
                  chart.data.datasets.forEach((dataset) => {
                      ul.innerHTML += `
                          <li>
                            <span style="background-color: ${dataset.backgroundColor}"></span>
                            ${dataset.label}
                          </li>
                      `;
                  });
                  document.getElementById(legendId).innerHTML = ''; // Nettoyer l'ancienne légende
                  document.getElementById(legendId).appendChild(ul);
              }
          }]
      });
  }

  // Fonction pour récupérer les données de l'API
  function fetchChartData() {
      $.ajax({
          url: 'http://127.0.0.1:8000/commandes/barChart',  // Remplacez par l'URL réelle de votre API
          type: 'GET',
          dataType: 'json',
          success: function (data) {
              updateChart(data);
          },
          error: function (xhr, status, error) {
              console.error('Erreur lors de la récupération des données :', status, error);
          }
      });
  }

  // Appeler la fonction pour récupérer les données et mettre à jour le graphique
  fetchChartData();
})


(function ($) {
  'use strict';
 




  if ($("#inline-datepicker").length) {
    $('#inline-datepicker').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
    });
  }
  if ($.cookie('purple-pro-banner') != "true") {
    document.querySelector('#proBanner').classList.add('d-flex');
    document.querySelector('.navbar').classList.remove('fixed-top');
  } else {
    document.querySelector('#proBanner').classList.add('d-none');
    document.querySelector('.navbar').classList.add('fixed-top');
  }

  if ($(".navbar").hasClass("fixed-top")) {
    document.querySelector('.page-body-wrapper').classList.remove('pt-0');
    document.querySelector('.navbar').classList.remove('pt-5');
  } else {
    document.querySelector('.page-body-wrapper').classList.add('pt-0');
    document.querySelector('.navbar').classList.add('pt-5');
    document.querySelector('.navbar').classList.add('mt-3');

  }
  document.querySelector('#bannerClose').addEventListener('click', function () {
    document.querySelector('#proBanner').classList.add('d-none');
    document.querySelector('#proBanner').classList.remove('d-flex');
    document.querySelector('.navbar').classList.remove('pt-5');
    document.querySelector('.navbar').classList.add('fixed-top');
    document.querySelector('.page-body-wrapper').classList.add('proBanner-padding-top');
    document.querySelector('.navbar').classList.remove('mt-3');
    var date = new Date();
    date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
    $.cookie('purple-pro-banner', "true", {
      expires: date
    });
  });
})(jQuery);