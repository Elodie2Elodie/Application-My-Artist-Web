@extends('pages.layouts.menu')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/desktop_23.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/test_popup.css') }}"> -->
@endpush

@section('content')
        <!-- partial -->
         
        <div>
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
        
            <div class="container-3">
              <form action="" enctype="multipart/form-data" style="display: contents;" method="POST">
                
                <div class="rectangle-34625156" style="background: url('assets/images/rectangle_34625156.png') 50% / cover no-repeat; border: 1px solid #408A7E">
                    <div id="uploadIcon" style="width: 40px; height:40px; background-color:#408A7E; margin-top:80%; border-radius:5px; margin-left:90%; display: flex; align-items: center; justify-content: center;" >
                    <i class="mdi mdi-pencil"></i>
                    </div>
                </div>
                <input type="file" id="fileInput" style="display: none;"  name="photo_commande" />
                @error('photo_commande')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="container-8">
                  <div style="margin-top: 2%;">
                    <div class="input-container">
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <select name="clientId" id="clientSelect" class="custom-input" >
                            <option value="" >Choisir un client</option>
                            @foreach ($clients as $client)
                            <option value="{{ $client['uid'] }}" >{{ $client['nom'] }}</option>
                            @endforeach
                        </select>  
                        
                        @error('clientId')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>
                  
                                       
                    <a  class="group-1000004778" style="text-decoration: none; display: flex; margin-bottom:-10%; cursor:pointer; width: 150px;" id="openPopupBtn" >
                        <span class="creer-un-client" style="margin-left: 8%; ">
                        Creer un client
                        </span>
                    </a>
                </div>
                    <button id="submit-tasks" class="group-bouton" style="text-decoration: none; margin-right:5%;">
                        <span class="creer" style="margin-top: 2%;">
                            Creer
                        </span>
                    </button>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-account" style="margin-left: 20%;font-size: 24px;"></i>
                    <!-- <input type="text" class="custom-input-2" placeholder="Nom"> -->
                    <select name="couturierId" id="" class="custom-input-2">
                        <option value="" >Choisir le couturier</option>
                        @foreach ($couturiers as $couturier)
                        <option value="{{ $couturier['uid'] }}" >{{ $couturier['nom'] }}</option>
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
                    <input type="date" name="dateDebut" id="dateDebut" class="custom-input-2" placeholder="Date de debut">
                    @error('dateDebut')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-calendar" style="margin-left: 20%; font-size: 24px;"></i>
                    <input type="date" name="dateFin" id="dateFin" class="custom-input-2" placeholder="Date de fin">
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
                        <option value="" >La commande est elle payée ? </option>
                        <option value="payer" >payer</option>
                        <option value="non payer" >non payer</option>
                        @error('paiement')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </select>
                </div>
            </div>
            <div id="modePaiementContainer" style="margin-top: 2%;" hidden >
                <div class="input-container">
                    <i class="mdi mdi-account" style="margin-left: 20%;font-size: 24px;"></i>
                    <!-- <input type="text" class="custom-input-2" placeholder="Nom"> -->
                    <select name="modePaiement" id="modePaiementSelect" class="custom-input-2">
                        <option value="" >Quel est le mode de paiement?</option>
                        <option value="Orange" >Orange</option>
                        <option value="Wave" >Wave</option>
                        <option value="Espèces" >Espèces</option>
                        @error('modePaiement')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </select>
                </div>
            </div>
            </form>
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
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                        
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <form method="POST" action="{{ route('auth.registerUser') }}" id="clientForm">
            @csrf <!-- Laravel CSRF token -->

            <div id="myPopup" class="popup">
                <div class="group-1000004708 popup-content">
                    <div class="mingcuteclose-fill close">
                        <img class="vector-97" src="../assets/vectors/vector_72_x2.svg" />
                    </div>
                    <div>
                        <div style="margin-top: 2%;">
                            <div class="input-container">
                                <i class="mdi mdi-account" style="font-size: 24px;"></i>
                                <input type="text" name="firstName" class="custom-input-3" placeholder="Prénom" value="{{ old('firstName') }}">
                                @error('firstName')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-top: 2%;">
                            <div class="input-container">
                                <i class="mdi mdi-account" style="font-size: 24px;"></i>
                                <input type="text" name="lastName" class="custom-input-3" placeholder="Nom" value="{{ old('lastName') }}">
                                @error('lastName')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-top: 2%;">
                            <div class="input-container">
                                <i class="mdi mdi-email" style="font-size: 24px;"></i>
                                <input type="text" name="email" class="custom-input-3" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-top: 2%;">
                            <div class="input-container">
                                <i class="mdi mdi-home" style="font-size: 24px;"></i>
                                <input type="text" name="adress" class="custom-input-3" placeholder="Adresse" value="{{ old('adress') }}">
                                @error('adress')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-top: 2%;">
                            <div class="input-container">
                                <i class="mdi mdi-phone" style="font-size: 24px;"></i>
                                <input type="text" name="telephone" class="custom-input-3" placeholder="Numéro de téléphone" value="{{ old('telephone') }}">
                                @error('telephone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Input caché pour le rôle -->
                    <input type="hidden" name="role" class="custom-input-3" value="client">
                    <input type="hidden" name="firstConnection" class="custom-input-3" value="0">

                    <div class="group-bouton-2">
                        <button type="submit" class="creer" style="background: none; border:0;"  id="createButton">
                            Créer
                        </button>
                    </div>
                </div>
            </div>
        </form>

    
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @push('scripts')
    <script src="{{ asset('assets/js/popup_script.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('assets/js/myjs.js') }}"></script>
  @endpush

@endsection