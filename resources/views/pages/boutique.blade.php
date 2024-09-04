<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/page_boutique.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background-color:#408A7E;">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu" style="color: white;"></span>
          </button>
          
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-white">David Greymaax</p>
                  <p class="mb-1 text-black">Administrateur</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-account me-2 text-success"></i> Administrateur</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Déconnexion </a>
              </div>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline" style="color: white;"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{ asset('assets/images/faces/face2.jpg') }}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{ asset('assets/images/faces/face3.jpg') }}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('messagerie') }}" class="p-3 mb-0 text-center">4 Nouveaux Messages</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline" style="color: white;"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-cog"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('notifications') }}" class="p-3 mb-0 text-center">Voir toutes les notifications</a>
              </div>
            </li>
            
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper" >
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar" >
            <img src="{{ asset('assets\images\my_artist_logo_1.png') }}" alt="" style="margin-left: 25%;">
          <ul class="nav" style="margin-top: 20px;">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('index') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title" style="color: black;">Tableau de bord</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('agents') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                <img class="taille-icone" src="{{ asset('assets/vectors/group_24_x2.svg') }}" alt="">
                <span class="menu-title" style="color: black;">Agents</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('Calendrier') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                <img class="taille-icone" class="taille-icone" src="{{ asset('assets/vectors/claritycalendar_line_28_x2.svg') }}" alt="">
                <span class="menu-title" style="color: black;">Calendrier</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('commandes') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="{{ asset('assets/vectors/product_5_x2.svg') }}" alt="">
                <span class="menu-title" style="color: black;">Commandes</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('avis') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="{{ asset('assets/vectors/guarantee_13_x2.svg') }}" alt="">
                <span class="menu-title" style="color: black;">Notes et Avis</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('recus') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="{{ asset('assets/vectors/bill_12_x2.svg') }}" alt="">
                <span class="menu-title" style="color: black;">Reçus</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('clients') }}">
                  <!-- <i class="mdi mdi-home menu-icon"></i> -->
                  <img class="taille-icone" src="{{ asset('assets/vectors/document_318_x2.svg') }}" alt="">
                  <span class="menu-title" style="color: black;">Clients</span>   
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('boutique') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="{{ asset('assets/vectors/vector_405_x2.svg') }}" alt="">
                <span class="menu-title" >Boutique</span>
                
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div>
            <div class="container-57" style="margin-top: 7.5%; margin-left: 70%;">
                <form action="{{ route('tenues.search') }}" method="GET">
                  <div class="recherche">
                          <div class="container-8">
                            <div class="material-symbolssearch-rounded">
                                <img class="vector-3" src="{{ asset('assets/vectors/vector_208_x2.svg') }}" />
                            </div>
                            <!-- <span class="rechercher">
                            Rechercher
                            </span> -->
                            <input type="text" name="search" placeholder="Rechercher par nom" value="{{ request('search') }}" style="border: none;">
                          </div>
                          <button type="submit" class="container-37">
                            <a class="material-symbolsfilter-list">
                                <img class="vector-2" src="{{ asset('assets/vectors/vector_404_x2.svg') }}" />
                            </a>
                          </button>
                    </div>
                </form>
                
                <div class="container-26">
                    <a class="group-nouvel-commande" style="text-decoration: none;" href=" {{ route( 'creer_tenue' ) }}">
                        <div class="icround-plus">
                            <img class="vector-1" src="{{ asset('assets/vectors/vector_82_x2.svg') }}" />
                        </div>
                        <span class="nouvel-commande">
                        Nouvelle tenue
                        </span>
                    </a>
                </div>
            </div>
            <div class="container-1" style="margin-top: 3%; margin-bottom:7%; margin-left:30%;">
              <a class="commandes-termins" style="text-decoration: none;" href="{{ route('tenues.byEtat', ['etat' => 'disponible']) }}">
                <span class="terminer">
                Publier
                </span>
              </a>
              <a class="commandes-en-cours" style="text-decoration: none;" href="{{ route('tenues.byEtat', ['etat' => 'indisponible']) }}">
                <span class="en-cours">
                Non Publier
                </span>
              </a>
              <a class="commandes-annuls" style="text-decoration: none;" href="{{ route('tenues.epuisees') }}">
                <span class="annuler">
                Epuiser
                </span>
              </a>
              
            </div>
            <div class="entete-tableau">
              <div class="image" style="margin-right: 10%; margin-left: 1%;" >
              Image
              </div>
              <div class="nom-1"style="margin-right: 9%;">
              Nom
              </div>
              <div class="prix" style="margin-right: 10%;">
              Prix
              </div>
              <div class="taille" style="margin-right: 5%;">
              Taille
              </div>
              <div class="qte-restante" style="margin-right: 5%;">
              Qte restante
              </div>
              <div class="commande" style="margin-right: 6%;">
              Commande
              </div>
              <div class="statut" style="margin-right: 8%;">
                Statut
                </div>
            </div>

            <div class="frame-47">
              @foreach ($tenues as $tenue)
              @php
                $photoPrincipaleUrl = $tenue['photo_principale'];
                $style = "background: url('$photoPrincipaleUrl') 50% / cover no-repeat, linear-gradient(#FFFFFF, #FFFFFF);";
              @endphp
                  <div class="group-1000004787">
                      <div class="container-23">  
                          <div class="rectangle-346252143" style="background: url('{{ $photoPrincipaleUrl }}') 50% / cover no-repeat, linear-gradient(#FFFFFF, #FFFFFF);">
                          </div>
                          <div class="aicha-sanack-3">
                              {{ $tenue['nom'] }}
                          </div>
                          <div class="fcfa-3" style="margin-right: 5%;">
                              {{ $tenue['prix'] }} F CFA
                          </div>
                          <div class="s-1" style="margin-right: 6%;">
                              {{ $tenue['taille'] }}
                          </div>
                          <div class="s-1" style="margin-right: 8%;">
                              {{ $tenue['quantite'] }}
                          </div>
                          <div class="s-1" style="margin-right: 9%;">
                              4
                          </div>
                          @php
                          if ($tenue['quantite'] > 0) {
                              $etat = $tenue['etat'] === 'disponible' ? 'Disponible' : 'Indisponible';
                          } else{
                              $etat='Epuisé';
                          }
                          @endphp
                          <div class="s-1" style="margin-right: 7%;">
                              {{ $etat }}
                          </div>
                          <!-- Formulaire pour mettre à jour l'état -->
                          <form action="{{ route('tenues.updateState', $tenue['id']) }}" method="POST" style="display: inline;">
                              @csrf
                              @method('PUT')
                              @if($etat != 'Epuisé')
                              <button type="submit" class="{{ $tenue['etat'] === 'disponible' ? 'group-color-rouge' : 'group-color-vert' }}" style="border: none; cursor: pointer;">
                                  <span class="publi-3">
                                      {{ $tenue['etat'] === 'disponible' ? 'Enlever' : 'Publier' }}
                                  </span>
                              </button>
                            @else
                                
                            @endif
                          </form>
                          
                          <a class="material-symbolsedit-outline-4" style="margin-top: 4.3%;" href="{{ route('modifier_tenue', ['id' => $tenue['id']]) }}">
                              <img class="vector-66" src="{{ asset('assets/vectors/vector_200_x2.svg') }}" />
                          </a>
                      </div>
                  </div>
              @endforeach
          </div>

                  
              </div>
              
              <!-- main-panel ends -->
            </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
        <!-- End custom js for this page -->
  </body>
</html>