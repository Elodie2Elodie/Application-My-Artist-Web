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
                                    12/06/2024
                                </h4>
                                <h4 class="styl1">
                                    {{ $agent['etat'] }}
                                </h4>
                                <h4 class="styl1">
                                    4
                                </h4>
                                <h4 class="styl1">
                                    {{ $agent['role'] }}
                                </h4>
                                <a href=""><img class="basiluser-block-solid-9" src="../assets/vectors/basiluser_block_solid_7_x2.svg" /></a>
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
    

    <div class="entete-tableau-2">
        <div class="client" style="padding-right: 12%;">
        Nom
        </div>
        <div class="client"style="padding-right: 18%;">
        Numéro
        </div>
        <div class="client"style="padding-right: 12%;">
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
    
@endsection
