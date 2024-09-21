@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page_recus.css') }}">
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
                
                    <div class="container-8">
                        
                        <div class="group-1000004758" >
                        @foreach($ventes as $vente)
                            <div class="container-25" style="margin-bottom: 1%;">
                            <h4 class="styl1">
                                ven0001
                            </h4>
                            <h4 class="styl1" >
                               {{ $vente['nomClient'] }}
                            </h4>
                            <h4 class="styl1">
                                {{ $vente['telephone'] }}
                            </h4>
                            <h4 class="styl1">
                                {{ $vente['date'] }}
                            </h4>
                            <h4 class="styl1" {{ $vente['is_livrer'] == 'non' ? "style=color:red" : "style=color:green" }} >
                                {{ $vente['is_livrer'] == 'non' ? 'Non livrer' : 'livrer' }}
                            </h4>
                            
                            <a href="">
                                <div class="carbonoverflow-menu-vertical-7">
                                <img class="vector-33" src="../assets/vectors/vector_382_x2.svg" />
                                <img class="vector-34" src="../assets/vectors/vector_222_x2.svg" />
                                <img class="vector-35" src="../assets/vectors/vector_474_x2.svg" />
                                </div>
                            </a>
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
    

    <div class="entete-tableau4">
        <div class="client" style="padding-right: 15%;">
        Numéro
        </div>
        <div class="client"style="padding-right: 20%;">
        Client
        </div>
        <div class="client"style="padding-right: 15%;">
        Numero
        </div>
        <div class="client" style="padding-right: 20%;">
        Fait le
        </div>
        <div class="client" style="padding-right: 14%;">
        Etat
        </div>
    </div>
    
@endsection