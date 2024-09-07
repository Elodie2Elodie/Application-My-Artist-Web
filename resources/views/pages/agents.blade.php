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
                    <div class="container-26"> 
                      <a class="group-nouvel-commande" href=" {{ route('creation_agent') }}" style="text-decoration: none; width: 200px; height: 50px; background-color:#408A7E; margin-left: 50%;" >
                        <div class="icround-plus" style="display: flex; ">
                            <img class="vector-1" src="../assets/vectors/vector_82_x2.svg" style="margin-left:5%;" />
                            <span style="color: white; margin-top:8%; ">
                              Nouvel Agent
                            </span>
                        </div>
                        
                      </a>
                    </div>
                </div>

                <div class="frame-liste-recus" style="margin-top: 17%; margin-left:24%;">
                    <h4 style="margin-top: -150px;" class="reus"> 22 Agents</h4>
                    <div class="container-8">
                        <div class="group-1000004758" >
                            @foreach ($agents as $agent)
                            <div class="container-25" style="margin-bottom: 1%;">
                                <h4 class="styl1">
                                    {{ $agent['nom'] }}
                                </h4>
                                <h4 class="styl1" >
                                    +(221) {{ $agent['telephone'] }}
                                </h4>
                                <h4 class="styl1">
                                    {{ $agent['dateCrea'] }}
                                </h4>
                                <h4 class="styl1 {{ $agent['etat'] === 'bloqué' ? 'etat-bloque' : 'etat-actif' }}">
                                    {{ $agent['etat'] }}
                                </h4>
                                <h4 class="styl1">
                                    4
                                </h4>
                                <h4 class="styl1">
                                    {{ $agent['role'] }}
                                </h4>
                                <a href="{{ $agent['etat'] === 'bloqué' ? route('utilisateurs.deblock', ['id' => $agent['uid']]) : route('utilisateurs.block', ['id' => $agent['uid']]) }}" >
                                <i class="mdi {{ $agent['etat'] === 'bloqué' ? 'mdi-lock' : 'mdi-lock-open' }} {{ $agent['etat'] === 'bloqué' ? 'etat-bloque' : 'etat-actif' }}" ></i>
                                </a>
                                <a class="info-agent open-popup" data-agent-id="{{ $agent['uid'] }}">
                                    <div class="carbonoverflow-menu-vertical-7">
                                    <img class="vector-33" src="../assets/vectors/vector_382_x2.svg" />
                                    <img class="vector-34" src="../assets/vectors/vector_222_x2.svg" />
                                    <img class="vector-35" src="../assets/vectors/vector_474_x2.svg" />
                                    </div>
                                </a>
                                 <!-- Modal -->
                                    <div id="popup-{{ $agent['uid'] }}" class="popup" style="display: none;">
                                        <div class="popup-content group-1000004708">
                                            <!-- Icone de fermeture en croix rouge -->
                                            <div class="close" data-popup-id="{{ $agent['uid'] }}" style=" margin-left:90%">
                                                <i class="mdi mdi-close" style="color: red; font-size: 24px; cursor: pointer;"></i>
                                            </div>
                                            <div style="height:40px; width:600px; background-color:#408A7E;margin-left:2%; padding-top:1%;">
                                                <h3 style="margin-left:25%; color:white">informations Agent</h3>
                                            </div>
                                            <div style="margin-top: 2%;">
                                                <!-- Identifiant -->
                                                <div class="input-container">
                                                    <i class="mdi mdi-account" style="font-size: 24px;"></i>
                                                    <input type="text" class="custom-input-3" placeholder="{{ $agent['nom'] }}" value="{{ $agent['nom'] }}" disabled/>

                                                </div>
                                            </div>

                                            <!-- Nom et Prénom -->
                                            <div style="margin-top: 2%;">
                                                <div class="input-container">
                                                    <i class="mdi mdi-account" style="font-size: 24px;"></i>
                                                    <input type="text" class="custom-input-3" placeholder="{{ $agent['prenom'] }}" value="{{ $agent['prenom'] }}"  disabled>
                                                </div>
                                            </div>

                                            <!-- Numéro de téléphone -->
                                            <div style="margin-top: 2%;">
                                                <div class="input-container">
                                                    <i class="mdi mdi-phone" style="font-size: 24px;"></i>
                                                    <input type="text" class="custom-input-3" placeholder="{{ $agent['telephone'] }}" value="{{ $agent['telephone'] }}"  disabled>
                                                </div>
                                            </div>

                                            <!-- date de creation-->
                                            <div style="margin-top: 2%;">
                                                <div class="input-container">
                                                    <i class="mdi mdi-calendar" style="font-size: 24px;"></i>
                                                    <input type="text" class="custom-input-3" placeholder="{{ $agent['dateCrea'] }}" value="{{ $agent['dateCrea'] }}"  disabled>
                                                </div>
                                            </div>

                                            <!-- Etat -->
                                            <div style="margin-top: 2%;">
                                                <div class="input-container">
                                                    <i class="mdi mdi-text" style="font-size: 24px;"></i>
                                                    <input type="text" class="custom-input-3 {{ $agent['etat'] === 'bloqué' ? 'etat-bloque' : 'etat-actif' }}" placeholder="{{ $agent['etat'] }}" value="{{ $agent['etat'] }}"  disabled>
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
    

    <div class="entete-tableau-2">
        <div class="client" style="padding-right: 12%;">
        Nom
        </div>
        <div class="client"style="padding-right: 18%;">
        Numéro
        </div>
        <div class="client"style="padding-right: 20%;">
        Creer le
        </div>
        <div class="client" style="padding-right: 9%;">
        Etat
        </div>
        <div class="client" style="padding-right: 7%;">
        Tenue
        </div>
        <div class="client" style="padding-right: 14%;">
        Rôle
        </div>
    </div>
    @push('scripts')
    <script rel="stylesheet" src="{{ asset('assets/js/popup.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    @endpush
@endsection
