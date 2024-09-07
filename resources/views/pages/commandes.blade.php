@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page_commandes.css') }}">
@endpush

@section('content')
        <!-- partial -->
        <div>
            <div class="container-57" style="margin-top: 7.5%; margin-left: 65%;">
                <div class="recherche">
                    <div class="container-8">
                    <div class="material-symbolssearch-rounded">
                        <img class="vector-3" src="{{ asset('../assets/vectors/vector_208_x2.svg') }}" />
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
                    <a class="group-nouvel-commande" style="text-decoration: none;" href="{{ route('commandes.showFornulaireCommande') }}">
                      <div class="icround-plus">
                          <img class="vector-1" src="../assets/vectors/vector_82_x2.svg" />
                      </div>
                      <span class="nouvel-commande" style="text-decoration: none;" >
                      Nouvel commande
                      </span>
                    </a>
                </div>
            </div>
            @if ($errors->any())
            <div class="center-flex alert alert-danger" style="margin-bottom:5%; background-color: rgba(255, 0, 0, 0.5); height:20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
            @endif

            @if (session('success'))
                <div class="center-flex alert alert-success" style="margin-bottom:5%; background-color: rgba(64, 138, 126, 0.5); height:20px;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="center-flex alert alert-success" style="margin-bottom:5%;  background-color: rgba(255, 0, 0, 0.5); height:20px;">
                    {{ session('error') }}
                </div>
            @endif
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
              @foreach($commandes as $commande)
              <a class="group-commandes-4" style="text-decoration: none;" href="#">
                <div class="container-29">
                <img src="{{ $commande['photoCommande'] }}" class="rectangle-346251564" />
                  <div class="container-31">
                    <div class="container-24">
                      <span class="chef-couturier-4">
                      Chef couturier: 
                      </span>
                      <span class="amadou-4">
                      {{ $commande['nomCouturier'] }}
                      </span>
                    </div>
                    <div class="container-47">
                      <span class="commande-4">
                      Commande :
                      </span>
                      <span class="c-0005">
                      {{ $commande['nomCommande']}}
                      </span>
                    </div>
                    <div class="couturier-4">
                    Date de fin:
                    </div>
                    <div class="container-62">
                      <span class="modou-4">
                      {{ $commande['dateFin']}}
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
              @endforeach
              
              
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection