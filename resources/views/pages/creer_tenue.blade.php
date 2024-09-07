@extends('pages.layouts.menu')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/desktop_23.css') }}">
@endpush

@section('content')
        <!-- partial -->
        @if ($errors->any())
            <div class="center-flex alert alert-danger" style="margin-bottom:5%; background-color: rgba(255, 0, 0, 0.5);">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif

        @if (session('success'))
            <div class="center-flex alert alert-success" style="margin-bottom:5%; background-color: rgba(64, 138, 126, 0.5);">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="center-flex alert alert-success" style="margin-bottom:5%;  background-color: rgba(255, 0, 0, 0.5);">
                {{ session('error') }}
            </div>
        @endif
        <div>
            
          <form action="/tenues" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="container-3">
                  <!-- Gestion de la photo principale -->
                  <div class="rectangle-34625156" style="background: url('assets/images/rectangle_34625156.png') 50% / cover no-repeat; border:1px solid black; margin-left:15%; margin-right:15%">
                      <div id="uploadIcon" style="width: 40px; height:40px; background-color:#408A7E; margin-top:65%; border-radius:5px; margin-left:90%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                          <i class="mdi mdi-pencil"></i>
                      </div>
                  </div>
                  <input type="file" id="fileInput" style="display: none;"  name="photo_principale" />

                  @if ($errors->has('photo_principale'))
                      <div style="color: red;">
                          {{ $errors->first('photo_principale') }}
                      </div>
                  @endif

                  <!-- Bouton Créer -->
                  <button type="submit" class="group-bouton" style="text-decoration: none; width: 120px; margin-left: 5%;">
                      <span class="creer" style="margin-top: 2%;">Créer</span>
                  </button>
              </div>

              <!-- Champ Nom de la tenue -->
              <div style="margin-top: 2%; margin-left: 30%">
                  <div class="input-container">
                      <i class="mdi mdi-text" style="font-size: 24px;"></i>
                      <input type="text" name="nom" class="custom-input-3" placeholder="Nom de la tenue" required>
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
                      <input type="number" name="prix" class="custom-input-3" placeholder="Prix" step="0.01" required>
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
                          <option value="S">S</option>
                          <option value="M">M</option>
                          <option value="L">L</option>
                          <option value="XL">XL</option>
                          <option value="XXL">XXL</option>
                          <option value="XXXL">XXXL</option>
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
                      <input type="number" name="quantite" class="custom-input-3" placeholder="Quantité" required>
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
                      <input type="text" name="description" class="custom-input-3" placeholder="Description">
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
                      <input type="date" name="date_creation" class="custom-input-3" required>
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
                          <option value="Haut">Hauts</option>
                          <option value="Bas">Bas</option>
                          <option value="Autres">Autres</option>
                      </select>
                  </div>
                  @if ($errors->has('categorie'))
                      <div style="color: red;">
                          {{ $errors->first('categorie') }}
                      </div>
                  @endif
              </div>
          </form>
   
        </div>

        
    
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@push('scripts')
    <script rel="stylesheet" src="{{ asset('assets/js/myjs.js') }}"></script>
@endpush
@endsection