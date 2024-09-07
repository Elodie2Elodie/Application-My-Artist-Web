@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page_recus.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/popup.css') }}">
@endpush

@section('content')
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
                  
                </div>

                <div class="frame-liste-recus" style="margin-top: 17%; margin-left:24%;">
                    <h4 style="margin-top: -150px;" class="reus"> 22 Clients</h4>
                    <div class="container-8">
                        <div class="group-1000004758" >
                            @foreach ($clients as $client)
                            <div class="container-25" style="margin-bottom: 1%;">
                                <h4 class="styl1">
                                    {{ $client['nom'] }}
                                </h4>
                                <h4 class="styl1" >
                                    +(221) {{ $client['telephone'] }}
                                </h4>
                                <h4 class="styl1">
                                    {{ $client['dateCrea'] }}
                                </h4>
                                <h4 class="styl1 {{ $client['etat'] === 'bloqué' ? 'etat-bloque' : 'etat-actif' }}">
                                    {{ $client['etat'] }}
                                </h4>
                                <a href="{{ $client['etat'] === 'bloqué' ? route('utilisateurs.deblock', ['id' => $client['uid']]) : route('utilisateurs.block', ['id' => $client['uid']]) }}" >
                                <i class="mdi {{ $client['etat'] === 'bloqué' ? 'mdi-lock' : 'mdi-lock-open' }} {{ $client['etat'] === 'bloqué' ? 'etat-bloque' : 'etat-actif' }}" ></i>
                                </a>
                                
                                <a href="#" class="info-client open-popup" data-agent-id="{{ $client['uid'] }}">
                                    <div class="carbonoverflow-menu-vertical-7">
                                    <img class="vector-33" src="../assets/vectors/vector_382_x2.svg" />
                                    <img class="vector-34" src="../assets/vectors/vector_222_x2.svg" />
                                    <img class="vector-35" src="../assets/vectors/vector_474_x2.svg" />
                                    </div>
                                </a>

                                <!-- Modal -->
                                <div id="popup-{{ $client['uid'] }}" class="popup" style="display: none;">
                                    <div class="popup-content group-1000004708">
                                        <!-- Icone de fermeture en croix rouge -->
                                        <div class="close" data-popup-id="{{ $client['uid'] }}" style=" margin-left:90%">
                                            <i class="mdi mdi-close" style="color: red; font-size: 24px; cursor: pointer;"></i>
                                        </div>
                                        <div style="height:40px; width:600px; background-color:#408A7E;margin-left:2%; padding-top:1%;">
                                            <h3 style="margin-left:25%; color:white">Informations Client</h3>
                                        </div>
                                        <div style="margin-top: 2%;">
                                            <!-- Identifiant -->
                                            <div class="input-container">
                                                <i class="mdi mdi-account" style="font-size: 24px;"></i>
                                                <input type="text" class="custom-input-3" placeholder="{{ $client['nom'] }}" value="{{ $client['nom'] }}" disabled/>

                                            </div>
                                        </div>

                                        <!-- Nom et Prénom -->
                                        <div style="margin-top: 2%;">
                                            <div class="input-container">
                                                <i class="mdi mdi-account" style="font-size: 24px;"></i>
                                                <input type="text" class="custom-input-3" placeholder="{{ $client['prenom'] }}" value="{{ $client['prenom'] }}">
                                            </div>
                                        </div>

                                        <!-- Numéro de téléphone -->
                                        <div style="margin-top: 2%;">
                                                <div class="input-container">
                                                    <i class="mdi mdi-phone" style="font-size: 24px;"></i>
                                                    <input type="text" class="custom-input-3" placeholder="{{ $client['telephone'] }}" value="{{ $client['telephone'] }}"  disabled>
                                                </div>
                                            </div>

                                            <!-- date de creation-->
                                            <div style="margin-top: 2%;">
                                                <div class="input-container">
                                                    <i class="mdi mdi-calendar" style="font-size: 24px;"></i>
                                                    <input type="text" class="custom-input-3" placeholder="{{ $client['dateCrea'] }}" value="{{ $client['dateCrea'] }}"  disabled>
                                                </div>
                                            </div>

                                            <!-- Etat -->
                                            <div style="margin-top: 2%;">
                                                <div class="input-container">
                                                    <i class="mdi mdi-text {{ $client['etat'] === 'bloqué' ? 'etat-bloque' : 'etat-actif' }}" style="font-size: 24px;"></i>
                                                    <input type="text" class="custom-input-3" placeholder="{{ $client['etat'] }}" value="{{ $client['etat'] }}"  disabled>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                        
                    </div>
                  
              
              </div>
            </div>
          
            
        </div>
        <!-- partial -->
        <!-- <div>
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
                    <btn class="exporter-704">
                        <span class="exporter">
                        Exporter
                        </span>
                        <div class="pajamasimport">
                            <img class="vector" src="../assets/vectors/vector_577_x2.svg" />
                        </div>
                    </btn>
                    <btn class="group-nouvel-commande">
                        <div class="icround-plus">
                            <img class="vector-1" src="../assets/vectors/vector_82_x2.svg" style="margin-left: 50%;" />
                        </div>
                        <span class="nouvel-commande" style="margin-left: 10%;">
                        Nouvel Agent
                        </span>
                    </btn>
                </div>
            </div>

        </div> -->

         
        <!-- main-panel ends -->
      
      <!-- page-body-wrapper ends -->
    </div>
    

    <div class="entete-tableau-3">
        <div class="client" style="padding-right: 15%;">
        Nom
        </div>
        <div class="client"style="padding-right: 25%;">
        Numéro
        </div>
        <div class="client"style="padding-right: 27%;">
        Creer le
        </div>
        <div class="client" style="padding-right: 9%;">
        Etat
        </div>
        
    </div>
    @push('scripts')
    <script rel="stylesheet" src="{{ asset('assets/js/popup.js') }}"></script>
    @endpush
    
@endsection    