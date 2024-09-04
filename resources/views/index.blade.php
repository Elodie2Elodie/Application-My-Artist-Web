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
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="{{ route('messagerie') }}" data-bs-toggle="dropdown" aria-expanded="false">
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
                <span class="menu-title" style="color: #408A7E;">Tableau de bord</span>
                
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
                <span class="menu-title" style="color: black;">Commandes</span>
                
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
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-green card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Commandes <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">$ 15,0000</h2>
                    <h6 class="card-text">22</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-orange card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Tenues <i class="mdi mdi-package mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">45</h2>
                    <h6 class="card-text">En cours</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-purple card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Tenues <i class="mdi mdi-package mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">20</h2>
                    <h6 class="card-text">En Attente</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-yellow card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Tenues <i class="mdi mdi-package mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">20</h2>
                    <h6 class="card-text">En retards</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-start">Statistiques des ventes</h4>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-end"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Commandes</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                      <canvas id="traffic-chart"></canvas>
                    </div>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Couturiers </h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Nom</th>
                            <th> Commandes</th>
                            <th> Retard</th>
                            <th> Taches </th>
                            <th> Messages en attente </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                            <td> 0 </td>
                            <td> 22 </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Latif Kaline
                            </td>
                            <td> 5 </td>
                            <td>
                              <label class="badge badge-gradient-warning">En retard</label>
                            </td>
                            <td> 1 </td>
                            <td> 20 </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> 6 </td>
                            <td>
                              <label class="badge badge-gradient-danger">En retard</label>
                            </td>
                            <td> 3 </td>
                            <td> 42 </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                            <td> 0 </td>
                            <td> 22 </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body p-0 d-flex">
                    <div id="inline-datepicker" class="datepicker datepicker-custom"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 grid-margin stretch-card">
                <div class="card">
                  <!-- <div class="card-body">
                    <h4 class="card-title">Commandes</h4>
                    <div class="d-flex">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Client</th>
                            <th> Commandes</th>
                            <th> Couturier</th>
                            <th>  Date de prise</th>
                            <th> Date de remise </th>
                            <th> Taches</th>
                            <th>progression</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div> -->
                  <div class="card-body" >
                    <h4 class="card-title">Tâches du 23/08/2024</h4>
                    <div class="d-flex">
                    <div class="table-responsive" >
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Client</th>
                            <th> Commandes</th>
                            <th>  Date de prise</th>
                            <th> Date de remise </th>
                            <th> Taches</th>
                            <th>progression</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tenues Avancement</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Due Date </th>
                            <th> Progress </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> Herman Beck </td>
                            <td> May 15, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 2 </td>
                            <td> Messsy Adam </td>
                            <td> Jul 01, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 3 </td>
                            <td> John Richards </td>
                            <td> Apr 12, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 4 </td>
                            <td> Peter Meggik </td>
                            <td> May 15, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 5 </td>
                            <td> Edward </td>
                            <td> May 03, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 5 </td>
                            <td> Ronald </td>
                            <td> Jun 05, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-dark">Tâches à faire</h4>
                    <div class="add-items d-flex">
                      <input type="text" class="form-control todo-list-input" placeholder="Avez vous une nouvelle tâches à ajouter?">
                      <button class="add btn bg-gradient-green font-weight-bold todo-list-add-btn" id="add-task">Ajouter</button>
                    </div>
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Découpage</label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked> Assemblage du haut</label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Assemblage du bas</label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox">Couture premier niveau</label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked>Deuxieme couture </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Surfilage </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
           
          <!-- partial -->
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