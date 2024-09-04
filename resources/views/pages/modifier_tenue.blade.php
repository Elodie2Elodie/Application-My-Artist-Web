<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/desktop_23.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
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
                  <img src="../assets/images/faces/profil-1.jpg" alt="image">
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
                    <img src="../assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../assets/images/faces/face3.jpg" alt="image" class="profile-pic">
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
            <img src="../assets\images\my_artist_logo_1.png" alt="" style="margin-left: 25%;">
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
                <img class="taille-icone" src="../assets/vectors/group_24_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Agents</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('Calendrier') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                <img class="taille-icone" class="taille-icone" src="../assets/vectors/claritycalendar_line_28_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Calendrier</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('commandes') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="../assets/vectors/product_5_x2.svg" alt="">
                <span class="menu-title">Commandes</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('avis') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="../assets/vectors/guarantee_13_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Notes et Avis</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('recus') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="../assets/vectors/bill_12_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Reçus</span>
                
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('clients') }}">
                  <!-- <i class="mdi mdi-home menu-icon"></i> -->
                  <img class="taille-icone" src="../assets/vectors/document_318_x2.svg" alt="">
                  <span class="menu-title" style="color: black;">Clients</span>   
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('boutique') }}">
                <!-- <i class="mdi mdi-home menu-icon"></i> -->
                 <img class="taille-icone" src="../assets/vectors/vector_405_x2.svg" alt="">
                <span class="menu-title" style="color: black;">Boutique</span>
                
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        @php
        $dateCreation = $tenue['date_creation'] ?? null;

        // Convertir le Timestamp en DateTime
        if ($dateCreation) {
            $dateTime = $dateCreation->get();
            $formattedDate = $dateTime->format('Y-m-d'); // Format souhaité
        } else {
            $formattedDate = ''; // Valeur par défaut si pas de date
        }
          $photoPrincipaleUrl = $tenue['photo_principale'] ?? '';
          $style = "background: url('$photoPrincipaleUrl') 50% / cover no-repeat, linear-gradient(#FFFFFF, #FFFFFF);";
        @endphp

      <form action="{{ route('tenues.update', $tenue['id']) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Gestion de la photo principale -->
          <div class="container-3">
              <div class="rectangle-34625156" style="background: url('{{ $photoPrincipaleUrl }}') 50% / cover no-repeat; margin-left:15%; margin-right:15%">
                  <div id="uploadIcon" style="width: 40px; height:40px; background-color:#408A7E; margin-top:65%; border-radius:5px; margin-left:90%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                      <i class="mdi mdi-pencil"></i>
                  </div>
              </div>
              <input type="file" id="fileInput"  style="display: none;" name="photo_principale" />
              @if ($errors->has('photo_principale'))
                  <div style="color: red;">
                      {{ $errors->first('photo_principale') }}
                  </div>
              @endif

              <!-- Bouton Modifier -->
              <button type="submit" class="group-bouton" style="text-decoration: none; width: 160px; margin-left: 5%;">
                  <span class="creer" style="margin-top: 2%;">Modifier</span>
              </button>
          </div>

          <!-- Champ Nom de la tenue -->
          <div style="margin-top: 2%; margin-left: 30%">
              <div class="input-container">
                  <i class="mdi mdi-text" style="font-size: 24px;"></i>
                  <input type="text" name="nom" class="custom-input-3" placeholder="Nom de la tenue" value="{{ old('nom', $tenue['nom'] ?? '') }}" required>
              </div>
              @if ($errors->has('nom'))
                  <div style="color: red;">
                      {{ $errors->first('nom') }}
                  </div>
              @endif
          </div>

          <!-- Champ Prix -->
          <div style="margin-top: 2%; margin-left: 30%">
              <div class="input-container">
                  <i class="mdi mdi-cash" style="font-size: 24px;"></i>
                  <input type="number" name="prix" class="custom-input-3" placeholder="Prix" step="0.01" value="{{ old('prix', $tenue['prix'] ?? '') }}" required>
              </div>
              @if ($errors->has('prix'))
                  <div style="color: red;">
                      {{ $errors->first('prix') }}
                  </div>
              @endif
          </div>

          <!-- Champ Taille -->
          <div style="margin-top: 2%; margin-left: 30%">
              <div class="input-container">
                  <i class="mdi mdi-ruler" style="font-size: 24px;"></i>
                  <select name="taille" class="custom-input-3" required>
                      <option value="">Sélectionner la taille</option>
                      <option value="S" {{ old("taille", $tenue['taille'] ?? '') == 'S' ? 'selected' : '' }}>S</option>
                      <option value="M" {{ old('taille', $tenue['taille'] ?? '') == 'M' ? 'selected' : '' }}>M</option>
                      <option value="L" {{ old('taille', $tenue['taille'] ?? '') == 'L' ? 'selected' : '' }}>L</option>
                      <option value="XL" {{ old('taille', $tenue['taille'] ?? '') == 'XL' ? 'selected' : '' }}>XL</option>
                      <option value="XXL" {{ old('taille', $tenue['taille'] ?? '') == 'XXL' ? 'selected' : '' }}>XXL</option>
                      <option value="XXXL" {{ old('taille', $tenue['taille'] ?? '') == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                  </select>
              </div>
              @if ($errors->has('taille'))
                  <div style="color: red;">
                      {{ $errors->first('taille') }}
                  </div>
              @endif
          </div>

          <!-- Champ Quantité -->
          <div style="margin-top: 2%; margin-left: 30%">
              <div class="input-container">
                  <i class="mdi mdi-archive-outline" style="font-size: 24px;"></i>
                  <input type="number" name="quantite" class="custom-input-3" placeholder="Quantité" value="{{ old('quantite', $tenue['quantite'] ?? '') }}" required>
              </div>
              @if ($errors->has('quantite'))
                  <div style="color: red;">
                      {{ $errors->first('quantite') }}
                  </div>
              @endif
          </div>

          <!-- Champ Description -->
          <div style="margin-top: 2%; margin-left: 30%">
              <div class="input-container">
                  <i class="mdi mdi-text" style="font-size: 24px;"></i>
                  <input type="text" name="description" class="custom-input-3" placeholder="Description" value="{{ old('description', $tenue['description'] ?? '') }}">
              </div>
              @if ($errors->has('description'))
                  <div style="color: red;">
                      {{ $errors->first('description') }}
                  </div>
              @endif
          </div>

          <!-- Champ Date de création -->
          <div style="margin-top: 2%; margin-left: 30%">
              <div class="input-container">
                  <i class="mdi mdi-calendar" style="font-size: 24px;"></i>
                  <input type="date" name="date_creation" class="custom-input-3" value="{{ $formattedDate}}" required>
              </div>
              @if ($errors->has('date_creation'))
                  <div style="color: red;">
                      {{ $errors->first('date_creation') }}
                  </div>
              @endif
          </div>

          <!-- Champ Catégorie -->
          <div style="margin-top: 2%; margin-left: 30%">
              <div class="input-container">
                  <i class="mdi mdi-check-circle" style="font-size: 24px;"></i>
                  <select name="categorie" class="custom-input-3" required>
                      <option value="">Choisissez une catégorie</option>
                      <option value="Haut" {{ old('categorie', $tenue['categorie'] ?? '') == 'Haut' ? 'selected' : '' }}>Hauts</option>
                      <option value="Bas" {{ old('categorie', $tenue['categorie'] ?? '') == 'Bas' ? 'selected' : '' }}>Bas</option>
                      <option value="Autres" {{ old('categorie', $tenue['categorie'] ?? '') == 'Autres' ? 'selected' : '' }}>Autres</option>
                  </select>
              </div>
              @if ($errors->has('categorie'))
                  <div style="color: red;">
                      {{ $errors->first('categorie') }}
                  </div>
              @endif
          </div>
      </form>
        <!-- main-panel ends -->
      </div>
      <div style="height:80px; width:1200px; background-color:#408A7E; margin-top:5%; margin-bottom:2%; margin-left:15%; padding-top:1.5%; display:flex;">
          <h1 style="margin-left:45%; ">Images</h1>
      </div>
      <!-- Formulaire pour télécharger les images -->
      <form id="uploadForm" action="{{ route('tenue.addImages', ['tenueId' => $tenue['id'] ] ) }}" method="POST" enctype="multipart/form-data" style=" margin-left:40%;display:flex; align-items:center;">
        @csrf
        <div style="margin-right:5%;" >
            <label for="images" style="cursor:pointer; padding:10px 20px; background-color:#408A7E; color:#fff; border-radius:5px; text-align:center;">Télécharger des images</label>
            <input type="file" id="images" name="images[]" multiple accept="image/*" onchange="previewImages()" style="display: none;">
        </div>
        <div id="preview" style="display: flex; gap: 10px; margin-top: 20px;"></div>
        <button type="submit" style="padding:10px 20px; background-color:#408A7E; color:#fff; border:none; border-radius:5px; cursor:pointer;">Ajouter</button>
      </form>


      <!-- Galerie d'images -->
      <div style="width:1200px; margin-left:15%; display:flex; flex-wrap:wrap; gap:20px; margin-top:20px;  margin-bottom:2%;">
          <div style="display:flex; flex-wrap:wrap; gap:15px; justify-content:center;">
              <!-- Exemple d'une image -->
              @foreach($tenue['photos'] as $image)
              <div style="width:200px; height:150px; background-color:#408A7E; border-radius:10%; display:flex; align-items:center; justify-content:center;">
                  <img src="{{ $image }}" alt="Image secondaire 1" style="max-width:100%; max-height:100%;">
              </div>
              @endforeach
              
              <!-- Ajoutez plus d'images ici -->
          </div>
      </div>

      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/myjs.js"></script>
    <script src="{{ asset('/assets/js/myjs.js') }}"></script>

    <!-- End custom js for this page -->
  </body>
</html>