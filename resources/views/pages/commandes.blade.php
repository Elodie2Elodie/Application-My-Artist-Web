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
            <!-- @if ($errors->any())
            <div class="center-flex alert alert-danger" style="margin-bottom:5%; background-color: rgba(255, 0, 0, 0.5); height:20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
            @endif -->

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
              <a href="{{ route('commandes.getCommandesByStatus', ['etat' => 'Terminer']) }}" class="commandes-termins">
                <span class="terminer">
                Terminer
                </span>
              </a>
              <a href="{{ route('commandes.getCommandesByStatus', ['etat' => 'En cours']) }}" class="commandes-en-cours">
                <span class="en-cours">
                En cours
                </span>
              </a>
              <a href="{{ route('commandes.getCommandesByStatus', ['etat' => 'Annuler']) }}" class="commandes-annuls">
                <span class="annuler">
                Annuler
                </span>
              </a>
              <a href="{{ route('commandes.getCommandesByStatus', ['etat' => 'En Attente']) }}" class="commandes-en-attentes">
                <span class="en-attente">
                En Attente
                </span>
              </a>
            </div>
            
            <div class="entete-tableau">
                <span class="commandes">
                Commandes
                </span>
            </div>
            
            <div class="frame-liste-commande" style="margin-left: 28%; margin-top:15%">
              @foreach($commandes as $commande)
              <a class="group-commandes-4" style="text-decoration: none;" href="{{ route('commandes.showModifyCommande', ['id' => $commande['commandeId']]) }}">
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
                    <div class="container-47">
                      <span class="commande-4">
                      Date de fin :
                      </span>
                      <span class="c-0005">
                      {{ $commande['dateFin']}}
                      </span>
                    </div>
                    <div class="container-47">
                      <span class="commande-4">
                      paiement :
                      </span>
                      <span class="c-0005">
                      {{ $commande['paiement'] }} {{  $commande['paiement'] == '' ? '' : 'par '. $commande['modePaiement'] }}
                      </span>
                    </div>
                    <div class="container-35">
                      <span class="progression-4">
                      Progression:
                      </span>
                      <h4 class="container-4">
                      {{ $commande['progression'] . ' %' }} 
                      </h4>
                    </div>
                    <div class="container-35">
                      <span class="progression-4">
                      Statut:
                      </span>
                      <h4 class="container-4" {{ $commande['status'] == 'Bonne progression' ? '' : 'color-red' }} >
                      {{ $commande['status'] }} 
                      </h4>
                    </div>
                    <div class="container-35">
                      <span class="progression-4">
                      Etat:
                      </span>
                      <h4 class="container-4">
                      {{ $commande['etat'] }} 
                      </h4>
                    </div>
                  </div>
                  <div class="container-25">
                    <div class="tches-4">
                    Tâches :
                    </div>
                    <div class="frame-71">
                    @if(isset($commande['taches']) && $commande['taches'] != "")
                    @php
                        $taches = json_decode($commande['taches'], true);  // Décodage du JSON
                        $tachesCount = count($taches);  // Calcul du nombre d'éléments
                    @endphp
                    @for($i = 0; $i < $tachesCount; $i += 2)  <!-- Incrémentation de 2 -->
                      <div class="container-60">
                        
                        <div class="group-tche-24">
                          <span class="coupure-4">
                          {{ $taches[$i]['text'] }}
                          </span>
                          @if( $taches[$i]['completed'] == 'fait')
                          <div class="dashiconsyes-8">
                            <img class="vector-13" src="../assets/vectors/vector_298_x2.svg" />
                          </div>
                          @endif
                        </div>
                        @if($i+1 < $tachesCount)
                        <div class="group-tche-24">
                          <span class="coupure-4">
                          {{ $taches[$i+1]['text'] }}
                          </span>
                          @if( $taches[$i+1]['completed'] == 'fait')
                          <div class="dashiconsyes-8">
                            <img class="vector-13" src="../assets/vectors/vector_298_x2.svg" />
                          </div>
                          @endif
                        </div>
                        @endif
                        
                      </div>
                      @endfor
                        @endif
                      
                    </div>
                    <div class="container-45" style="margin-top: -15%;">
                      <span class="client-4">
                      Client :
                      </span>
                      <span class="aline-4">
                      {{ $commande['nomClient'] }}
                      </span>
                    </div>
                 
                  </div>
                </div>
                <div class="vector-674">
                </div>
              </a>
              @if($commande['etat'] == 'En attente')
              <div class="container-icones">
                <!-- Bouton pour accepter la commande -->
                <a href="{{ route('commandes.showModifyCommande', ['id' => $commande['commandeId']]) }}" class="btn-accepter" style="text-decoration: none;">
                  <i class="mdi mdi-check-circle" style="margin-right: 5px;"></i>
                  Accepter
                </a>

                <!-- Bouton pour refuser la commande -->
                <a href="#" class="btn-refuser" style="text-decoration: none;">
                  <i class="mdi mdi-cancel" style="margin-right: 5px;"></i>
                  Refuser
                </a>
              </div>
              @endif
              @endforeach
              
              
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection