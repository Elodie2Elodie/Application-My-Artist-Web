@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page_boutique.css') }}">
@endpush

@section('content')
        <!-- partial -->
        <div>
            <div class="container-57" style="margin-top: 7.5%; margin-left: 70%;">
                <form action="{{ route('tenues.search') }}" method="GET">
                  <div class="recherche">
                          <div class="container-8">
                            <div class="material-symbolssearch-rounded">
                                <img class="vector-3" src="{{ asset('assets/vectors/vector_208_x2.svg') }}" />
                            </div>
                            <!-- <span class="rechercher">
                            Rechercher
                            </span> -->
                            <input type="text" name="search" placeholder="Rechercher par nom" value="{{ request('search') }}" style="border: none;">
                          </div>
                          <button type="submit" class="container-37">
                            <a class="material-symbolsfilter-list">
                                <img class="vector-2" src="{{ asset('assets/vectors/vector_404_x2.svg') }}" />
                            </a>
                          </button>
                    </div>
                </form>
                
                <div class="container-26">
                    <a class="group-nouvel-commande" style="text-decoration: none;" href=" {{ route( 'tenues.create' ) }}">
                        <div class="icround-plus">
                            <img class="vector-1" src="{{ asset('assets/vectors/vector_82_x2.svg') }}" />
                        </div>
                        <span class="nouvel-commande">
                        Nouvelle tenue
                        </span>
                    </a>
                </div>
            </div>
            <div class="container-1" style="margin-top: 3%; margin-bottom:7%; margin-left:30%;">
              <a class="commandes-termins" style="text-decoration: none;" href="{{ route('tenues.byEtat', ['etat' => 'disponible']) }}">
                <span class="terminer">
                Publier
                </span>
              </a>
              <a class="commandes-en-cours" style="text-decoration: none;" href="{{ route('tenues.byEtat', ['etat' => 'indisponible']) }}">
                <span class="en-cours">
                Non Publier
                </span>
              </a>
              <a class="commandes-annuls" style="text-decoration: none;" href="{{ route('tenues.epuisees') }}">
                <span class="annuler">
                Epuiser
                </span>
              </a>
              
            </div>
            <div class="entete-tableau">
              <div class="image" style="margin-right: 10%; margin-left: 1%;" >
              Image
              </div>
              <div class="nom-1"style="margin-right: 9%;">
              Nom
              </div>
              <div class="prix" style="margin-right: 10%;">
              Prix
              </div>
              <div class="taille" style="margin-right: 5%;">
              Taille
              </div>
              <div class="qte-restante" style="margin-right: 5%;">
              Qte restante
              </div>
              <div class="commande" style="margin-right: 6%;">
              Commande
              </div>
              <div class="statut" style="margin-right: 8%;">
                Statut
                </div>
            </div>

            <div class="frame-47">
              @foreach ($tenues as $tenue)
              @php
                $photoPrincipaleUrl = $tenue['photo_principale'];
                $style = "background: url('$photoPrincipaleUrl') 50% / cover no-repeat, linear-gradient(#FFFFFF, #FFFFFF);";
              @endphp
                  <div class="group-1000004787">
                      <div class="container-23">  
                          <div class="rectangle-346252143" style="background: url('{{ $photoPrincipaleUrl }}') 50% / cover no-repeat, linear-gradient(#FFFFFF, #FFFFFF);">
                          </div>
                          <div class="aicha-sanack-3">
                              {{ $tenue['nom'] }}
                          </div>
                          <div class="fcfa-3" style="margin-right: 5%;">
                              {{ $tenue['prix'] }} F CFA
                          </div>
                          <div class="s-1" style="margin-right: 6%;">
                              {{ $tenue['taille'] }}
                          </div>
                          <div class="s-1" style="margin-right: 8%;">
                              {{ $tenue['quantite'] }}
                          </div>
                          <div class="s-1" style="margin-right: 9%;">
                              4
                          </div>
                          @php
                          if ($tenue['quantite'] > 0) {
                              $etat = $tenue['etat'] === 'disponible' ? 'Disponible' : 'Indisponible';
                          } else{
                              $etat='Epuisé';
                          }
                          @endphp
                          <div class="s-1" style="margin-right: 7%;">
                              {{ $etat }}
                          </div>
                          <!-- Formulaire pour mettre à jour l'état -->
                          <form action="{{ route('tenues.updateState', $tenue['id']) }}" method="POST" style="display: inline;">
                              @csrf
                              @method('PUT')
                              @if($etat != 'Epuisé')
                              <button type="submit" class="{{ $tenue['etat'] === 'disponible' ? 'group-color-rouge' : 'group-color-vert' }}" style="border: none; cursor: pointer;">
                                  <span class="publi-3">
                                      {{ $tenue['etat'] === 'disponible' ? 'Enlever' : 'Publier' }}
                                  </span>
                              </button>
                            @else
                                
                            @endif
                          </form>
                          
                          <a class="material-symbolsedit-outline-4" style="margin-top: 4.3%;" href="{{ route('tenues.show', ['id' => $tenue['id']]) }}">
                              <img class="vector-66" src="{{ asset('assets/vectors/vector_200_x2.svg') }}" />
                          </a>
                      </div>
                  </div>
              @endforeach
          </div>

                  
              </div>
              
              <!-- main-panel ends -->
            </div>
      <!-- page-body-wrapper ends -->
    </div>
    @push('scripts')
    <script rel="stylesheet" src="{{ asset('assets/js/myjs.js') }}"></script>
@endpush
@endsection