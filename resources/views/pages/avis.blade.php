@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page_note_et_avis.css') }}">
@endpush

@section('content')
        <!-- partial -->
        <div class="container-21" style="margin-left: 14%; margin-top: 6%">
            <div class="container-8">
              <div class="groupe-score">
                <div class="icround-star-3" style=" left: 55%;">
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                </div>
                <span class="container" style="margin-left: 35%; margin-top: 10%;">
                  {{ $compteur1Etoile }}
                </span>
              </div>
              <div class="groupe-score">
                <div class="icround-star-3" style="left: 45%;">
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                </div>
                <span class="container" style="margin-left: 35%; margin-top: 10%;">
                {{ $compteur2Etoiles }}
                </span>
              </div>
              <div class="groupe-score">
                <div class="icround-star-3" style="left: 32%;">
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                </div>
                <span class="container" style="margin-left: 35%; margin-top: 10%;">
                  {{ $compteur3Etoiles }}
                </span>
              </div>
              <div class="groupe-score">
                <div class="icround-star-3" style="left: 22%;">
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                  <img class="vector-6" src="../assets/vectors/vector_209_x2.svg" />
                </div>
                <span class="container" style="margin-left: 35%; margin-top: 10%;">
                  {{ $compteur4Etoiles }}
                </span>
              </div>
            </div>
            <div class="group-note-globale">
              <span class="note">
              Note :
              </span>
              @for ($i = 0; $i < floor($noteGlobale); $i++)
                  <i class="mdi mdi-star" style="font-size: 34px; color: #408A7E;"></i> <!-- Étoile pleine -->
              @endfor
            </div>
            <div class="entete-tableau">
              <span class="avis" style="margin-left: 50%;">
              Avis
              </span>
            </div>
            <div class="frame-10">
            @foreach ($avis as $Unavis)
              <div class="group-1000004757">
                <div class="container-10">
                    <div>
                        <i class="mdi mdi-account-circle" style="font-size: 50px; color: #408A7E;"></i>
                        <div class="awa-diop">
                            {{ $Unavis['nomClient']}}
                        </div>
                    </div>
                    
                    <div class="group-1000004756">
                      @for ($i = 0; $i < $Unavis['note']; $i++)
                          <i class="mdi mdi-star" style="font-size: 28px; color: #408A7E;"></i> <!-- Étoile pleine -->
                      @endfor
                  </div>
                </div>
                <div class="awa-diop" style="display: block; margin-left:-65%; margin-top:0%; margin-bottom:0%;">
                    {{ $Unavis['commentaire']}}
                </div>
                <div class="vector-70">
                </div>
              </div>
              
            @endforeach  
            </div>
          </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection