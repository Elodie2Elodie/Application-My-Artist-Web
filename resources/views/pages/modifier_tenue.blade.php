@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/desktop_23.css') }}">
@endpush

@section('content')
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
      <form id="uploadForm" action="{{ route('tenues.addImages', ['tenueId' => $tenue['id'] ] ) }}" method="POST" enctype="multipart/form-data" style=" margin-left:40%;display:flex; align-items:center;">
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
    @push('scripts')
    <link rel="stylesheet" href="{{ asset('assets/js/myjs.js') }}">
@endpush
@endsection