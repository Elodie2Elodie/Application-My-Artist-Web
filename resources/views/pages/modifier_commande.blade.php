@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/desktop_23.css') }}">
@endpush

@section('content')
        <!-- partial -->
        @php
        $photoCommande = $commande['photoCommande'] ?? '';
        @endphp
        <div>
            <div class="container-3">
                <div class="rectangle-34625156"  style="background: url('{{ $photoCommande }}') 50% / cover no-repeat; border: 1px solid #408A7E;" >
                    <div style="width: 40px; height:40px; background-color:#408A7E; margin-top:95%; border-radius:5px; margin-left:90%;  display: flex; align-items: center; justify-content: center;" >
                    <i class="mdi mdi-pencil"></i>
                    </div>
                </div>
                <input type="file" id="fileInput" style="display: none;"  name="photo_commande" />
                <input type="text" style="display: none;" name="commandeId" id="commandeId" class="custom-input-2" placeholder="{{ old('commandeId',$commande['commandeId'] ?? '') }}" value="{{ old('commandeId',$commande['commandeId'] ?? '') }}"> 
                @error('photo_commande')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="container-8">
                <div style="margin-top: 2%;">
                    <div class="input-container">
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <input type="text" disabled name="clientId" id="clientId" class="custom-input-2" placeholder="{{ old('nomClient',$commande['nomClient'] ?? '') }}" value="{{ old('nomClient',$commande['nomClient'] ?? '') }}"> 
                    </div>
                </div>
                                       
                    <div>
                        <a class="group-1000004778" href="#" style="text-decoration: none;">
                            <span class="creer-un-client" style="margin-left: 10%;">
                            Envoyer un message
                            </span>
                        </a>
                        <a class="group-1000004778" href="#" style="text-decoration: none;" id="openPopupBtn">
                            <span class="creer-un-client" style="margin-left: 8%;">
                            Voir les mensurations
                            </span>
                        </a>
                    </div>

                </div>
                    <a class="group-bouton" id="modifierCommande" style="text-decoration: none;  margin-right:10%; cursor: pointer;">
                        <span class="creer" style="margin-top: 2%;">
                            Modifier
                        </span>
                    </a>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-text" style="margin-left: 20%;font-size: 24px;"></i>
                    <input type="text" class="custom-input-2" placeholder="{{ old('nomCommande',$commande['nomCommande'] ?? '') }}" value="{{ old('nomCommande',$commande['nomCommande'] ?? '') }}">
                </div>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-account" style="margin-left: 20%;font-size: 24px;"></i>
                    <!-- <input type="text" class="custom-input-2" placeholder="Nom"> -->
                    <select name="couturierId" id="" class="custom-input-2">
                        <option value="" >Choisir le couturier</option>
                        @foreach ($couturiers as $couturier)
                        <option value="{{ $couturier['uid'] }}" {{ old("couturierId", $commande['couturierId'] ?? '') == $couturier['uid'] ? 'selected' : '' }} >{{ $couturier['nom'] }}</option>
                        @endforeach
                        @error('couturierId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </select>
                </div>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-calendar" style="margin-left: 20%; font-size: 24px;"></i>
                    <input type="date" name="dateDebut" id="dateDebut" class="custom-input-2"  placeholder="{{ old('dateDebut',$commande['dateDebut'] ?? '') }}" value="{{ old('dateDebut',$commande['dateDebut'] ?? '') }}">

                    @error('dateDebut')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-calendar" style="margin-left: 20%; font-size: 24px;"></i>
                    <input type="date" name="dateFin" id="dateFin" class="custom-input-2" placeholder="{{ old('dateFin',$commande['dateFin'] ?? '') }}" value="{{ old('dateFin',$commande['dateFin'] ?? '') }}">

                    @error('dateFin')
                      span class="date-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-account" style="margin-left: 20%;font-size: 24px;"></i>
                    <!-- <input type="text" class="custom-input-2" placeholder="Nom"> -->
                    <select name="paiement"  id="paiementSelect" class="custom-input-2">
                        <option value="" >La commande est elle payée</option>
                        <option value="payer" {{ old("paiement", $commande['paiement'] ?? '') == 'payer' ? 'selected' : '' }} >payer</option>
                        <option value="non payer" {{ old("paiement", $commande['paiement'] ?? '') == 'non payer' ? 'selected' : '' }} >non payer</option>
                        @error('paiement')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </select>
                </div>
            </div>
            <div style="margin-top: 2%;" id="modePaiementContainer" hidden>
                <div class="input-container">
                    <i class="mdi mdi-account" style="margin-left: 20%;font-size: 24px;"></i>
                    <!-- <input type="text" class="custom-input-2" placeholder="Nom"> -->
                    <select name="modePaiement" id="modePaiementSelect" class="custom-input-2">
                        <option value="Orange" {{ old("modePaiement", $commande['modePaiement'] ?? '') == 'Orange' ? 'selected' : '' }} >Orange</option>
                        <option value="Wave" {{ old("modePaiement", $commande['modePaiement'] ?? '') == 'Wave' ? 'selected' : '' }} >Wave</option>
                        <option value="Espèces" {{ old("modePaiement", $commande['modePaiement'] ?? '') == 'Espèces' ? 'selected' : '' }} >Espèces</option>
                        @error('modePaiement')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </select>
                </div>
            </div>
            <div style="height:80px; width:1150px; background-color:#408A7E; margin-top:5%; margin-left:3%; padding-top:1.5%;">
                <h1 style="margin-left:45%; ">Tâches</h1>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-dark">Tâches à faire</h4>
                    <div class="add-items d-flex">
                      <input type="text" class="form-control todo-list-input" placeholder="Avez vous une nouvelle tâches à ajouter?">
                      <button class="add btn bg-gradient-green font-weight-bold todo-list-add-btn" id="add-task">Ajouter</button>
                    </div>
                    @php
                    $taches = json_decode($commande['taches'], true);
                    @endphp
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                      @foreach ($taches as $tache)
                        <li class="{{ $tache['completed'] === 'fait' ? 'completed' : '' }}">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" {{ $tache['completed'] === 'fait' ? 'checked' : '' }}>
                              {{ $tache['text'] }}
                            </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                      @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div  id="myPopup" class="popup">
          <div class="group-1000004708 popup-content" style="width: 900px; height: 670px; margin-bottom: 5%">
              <div class="mingcuteclose-fill close">
                <img class="vector-97" src="{{ asset('assets/vectors/vector_72_x2.svg') }}" />
              </div>
              <div style="display: flex; flex-direction: row;">
                <div style="display: flex; flex-direction: column; margin-right:5%;">
                  <div style="margin-top: 0.5%; " >
                    <div class="input-container" >
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <input type="text" class="custom-input-4" placeholder="Identifiant">
                    </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-account" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Nom et Prénom">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-phone" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Numéro">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Mot De Passe">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%; margin-bottom: 5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Resaissez le mot de passe">
                      </div>
                  </div>
                </div>
                <div style="display: flex; flex-direction: column; margin-right:5%;">
                  <div style="margin-top: 0.5%; " >
                    <div class="input-container" >
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <input type="text" class="custom-input-4" placeholder="Identifiant">
                    </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-account" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Nom et Prénom">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-phone" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Numéro">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Mot De Passe">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%; margin-bottom: 5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Resaissez le mot de passe">
                      </div>
                  </div>
                </div>
                <div style="display: flex; flex-direction: column;">
                  <div style="margin-top: 0.5%; " >
                    <div class="input-container" >
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <input type="text" class="custom-input-4" placeholder="Identifiant">
                    </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-account" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Nom et Prénom">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-phone" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Numéro">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Mot De Passe">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%; margin-bottom: 5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Resaissez le mot de passe">
                      </div>
                  </div>
                </div>
              </div>
              <div style="display: flex; flex-direction: row; margin-top:5%;">
                
                <div style="display: flex; flex-direction: column; margin-right:5%;">
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-phone" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Numéro">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Mot De Passe">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%; margin-bottom: 5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Resaissez le mot de passe">
                      </div>
                  </div>
                </div>
                <div style="display: flex; flex-direction: column;">
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-phone" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Numéro">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Mot De Passe">
                      </div>
                  </div>
                  <div style="margin-top: 0.5%; margin-bottom: 7%;" >
                      <div class="input-container" >
                          <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                          <input type="text" class="custom-input-4" placeholder="Resaissez le mot de passe">
                      </div>
                  </div>
                </div>
              </div>
              
              <div class="group-bouton-2">
                <span class="creer">
                  Modifier
                </span>
              </div>
          </div>
        </div>
    
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
  @push('scripts')
    <script src="{{ asset('assets/js/popup_script.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('assets/js/myjs.js') }}"></script>
  @endpush
@endsection