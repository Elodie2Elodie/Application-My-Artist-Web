<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/page_commandes.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
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
                  <img src="assets/images/faces/profil-1.jpg" alt="image">
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
                    <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
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
            <img src="assets\images\my_artist_logo_1.png" alt="" style="margin-left: 25%;">
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
                <img class="taille-icone" src="assets/vectors/group_24_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Agents</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('Calendrier') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                <img class="taille-icone" class="taille-icone" src="assets/vectors/claritycalendar_line_28_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Calendrier</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('commandes') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="assets/vectors/product_5_x2.svg" alt="">
                <span class="menu-title">Commandes</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('avis') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="assets/vectors/guarantee_13_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Notes et Avis</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('recus') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="assets/vectors/bill_12_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Reçus</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('clients') }}">
                  <!-- <i class="mdi mdi-home menu-icon"></i> -->
                  <img class="taille-icone" src="assets/vectors/document_318_x2.svg" alt="">
                  <span class="menu-title" style="color: black;">Clients</span>   
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('boutique') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="assets/vectors/vector_405_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Boutique</span>
                
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div>
            <div class="container-57" style="margin-top: 7.5%; margin-left: 65%;">
                <div class="recherche">
                    <div class="container-8">
                    <div class="material-symbolssearch-rounded">
                        <img class="vector-3" src="../assets/vectors/vector_208_x2.svg" />
                    </div>
                    <span class="rechercher">
                    Rechercher
                    </span>
                    </div>
                    <div class="container-37">
                    <div class="material-symbolsfilter-list">
                        <img class="vector-2" src="../assets/vectors/vector_404_x2.svg" />
                    </div>
                    </div>
                </div>
                <div class="container-26">
                    <a class="exporter-704" style="text-decoration: none;">
                      <span class="exporter">
                      Exporter
                      </span>
                      <div class="pajamasimport">
                          <img class="vector" src="../assets/vectors/vector_577_x2.svg" />
                      </div>
                    </a>
                    <a class="group-nouvel-commande" style="text-decoration: none;" href="{{ route('creation_commande') }}">
                      <div class="icround-plus">
                          <img class="vector-1" src="../assets/vectors/vector_82_x2.svg" />
                      </div>
                      <span class="nouvel-commande" style="text-decoration: none;" >
                      Nouvel commande
                      </span>
                    </a>
                </div>
            </div>
            <div class="container-1" style="margin-top: 8%; margin-bottom:8%; margin-left:50%;">
              <button class="commandes-termins">
                <span class="terminer">
                Terminer
                </span>
              </button>
              <button class="commandes-en-cours">
                <span class="en-cours">
                En cours
                </span>
              </button>
              <button class="commandes-annuls">
                <span class="annuler">
                Annuler
                </span>
              </button>
              <button class="commandes-en-attentes">
                <span class="en-attente">
                En Attente
                </span>
              </button>
            </div>
            <div class="entete-tableau">
                <span class="commandes">
                Commandes
                </span>
            </div>
            <div class="frame-liste-commande" style="margin-left: 28%; margin-top:15%">
              <a class="group-commandes-4" style="text-decoration: none;" href="{{ route('modifier_commande') }}">
                <div class="container-29">
                <img src="assets/images/tenues/rectangle_346251561.png" class="rectangle-346251564" />
                  <div class="container-31">
                    <div class="container-24">
                      <span class="chef-couturier-4">
                      Chef couturier: 
                      </span>
                      <span class="amadou-4">
                      Amadou
                      </span>
                    </div>
                    <div class="container-47">
                      <span class="commande-4">
                      Commande :
                      </span>
                      <span class="c-0005">
                      C0 005
                      </span>
                    </div>
                    <div class="couturier-4">
                    Couturier:
                    </div>
                    <div class="container-62">
                      <span class="modou-4">
                      Modou
                      </span>
                    </div>
                    <div class="container-35">
                      <span class="progression-4">
                      Progression:
                      </span>
                      <h4 class="container-4">
                      33,33  %
                      </h4>
                    </div>
                  </div>
                  <div class="container-25">
                    <div class="tches-4">
                    Tâches :
                    </div>
                    <div class="frame-71">
                      <div class="container-60">
                        <div class="group-tche-24">
                          <span class="coupure-4">
                          Coupure
                          </span>
                          <div class="dashiconsyes-8">
                            <img class="vector-13" src="../assets/vectors/vector_298_x2.svg" />
                          </div>
                        </div>
                        <div class="group-tche-24">
                          <span class="coupure-4">
                          Confection haut
                          </span>
                          <div class="dashiconsyes-8">
                            <img class="vector-13" src="../assets/vectors/vector_298_x2.svg" />
                          </div>
                        </div>
                      </div>
                      <div class="container-58">
                        <div class="group-tche-26">
                          <span class="coupure-du-bas-4">
                          Coupure du bas
                          </span>
                        </div>
                        <div class="group-tche-27">
                          <span class="premier-assemblage-4">
                          Premier assemblage
                          </span>
                        </div>
                      </div>
                      <div class="container-38">
                        <div class="group-tche-28">
                          <span class="assemblage-finale-4">
                          Assemblage finale
                          </span>
                        </div>
                        <div class="group-tche-29">
                          <span class="pofinage-4">
                          Pofinage
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="container-45">
                      <span class="client-4">
                      Client :
                      </span>
                      <span class="aline-4">
                      Aline
                      </span>
                    </div>
                  </div>
                </div>
                <div class="vector-674">
                </div>
              </a>
              <div class="group-commandes-4">
                <div class="container-29">
                  <img src="assets/images/tenues/rectangle_346251561.png" class="rectangle-346251564" />
                  <div class="container-31">
                    <div class="container-24">
                      <span class="chef-couturier-4">
                      Chef couturier: 
                      </span>
                      <span class="amadou-4">
                      Amadou
                      </span>
                    </div>
                    <div class="container-47">
                      <span class="commande-4">
                      Commande :
                      </span>
                      <span class="c-0005">
                      C0 005
                      </span>
                    </div>
                    <div class="couturier-4">
                    Couturier:
                    </div>
                    <div class="container-62">
                      <span class="modou-4">
                      Modou
                      </span>
                    </div>
                    <div class="container-35">
                      <span class="progression-4">
                      Progression :
                      </span>
                      <h4 class="container-4">
                      33,33  %
                      </h4>
                    </div>
                  </div>
                  <div class="container-25">
                    <div class="tches-4">
                    Tâches :
                    </div>
                    <div class="frame-71">
                      <div class="container-60">
                        <div class="group-tche-24">
                          <span class="coupure-4">
                          Coupure
                          </span>
                          <div class="dashiconsyes-8">
                            <img class="vector-13" src="../assets/vectors/vector_298_x2.svg" />
                          </div>
                        </div>
                        <div class="group-tche-24">
                          <span class="coupure-4">
                          Confection haut
                          </span>
                          <div class="dashiconsyes-8">
                            <img class="vector-13" src="../assets/vectors/vector_298_x2.svg" />
                          </div>
                        </div>
                      </div>
                      <div class="container-58">
                        <div class="group-tche-26">
                          <span class="coupure-du-bas-4">
                          Coupure du bas
                          </span>
                        </div>
                        <div class="group-tche-27">
                          <span class="premier-assemblage-4">
                          Premier assemblage
                          </span>
                        </div>
                      </div>
                      <div class="container-38">
                        <div class="group-tche-28">
                          <span class="assemblage-finale-4">
                          Assemblage finale
                          </span>
                        </div>
                        <div class="group-tche-29">
                          <span class="pofinage-4">
                          Pofinage
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="container-45">
                      <span class="client-4">
                      Client :
                      </span>
                      <span class="aline-4">
                      Aline
                      </span>
                    </div>
                  </div>
                </div>
                <div class="vector-674">
                </div>
              </div>
            
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>