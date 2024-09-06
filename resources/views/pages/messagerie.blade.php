@extends('pages.layouts.menu')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page_message.css') }}">
@endpush

@section('content')
        <!-- partial -->
        <div class="group-1000004775" >
          <div class="messagerie" style="margin-left: 8%;">
          Messagerie
          </div>
          <a href="#" class="mingcuteadd-fill"style="margin-right: 5%;">
            <img class="vector" src="../assets/vectors/vector_167_x2.svg"/>
          </a>
          <div class="frame-13">  
            <div class="container-18">
              <div class="group-unite-message-5">
                <div class="container-2">
                  <img class="group-10000047775" src="../assets/vectors/group_10000047779_x2.svg" />
                  <div class="container-11">
                    <div class="awa-diop-6">
                    Awa Diop
                    </div>
                    <span class="lorem-ipsum-is-simply-dummy-5">
                    Lorem Ipsum is simply dummy 
                    </span>
                  </div>
                </div>
                <div class="group-10000044395" style="margin-right: 5%;">
                  <span class="container-5">
                  2
                  </span>
                </div>
              </div> 
              
          </div>
          
        </div>
        
        
        <!-- main-panel ends -->
      </div>
      <div class="group-partie-ecriture"style="width: 1020px;">
            <div class="container-3">
              <div class="container-27">
                <img class="ellipse-1823" src="../assets/vectors/ellipse_18231_x2.svg" />
                <div class="awa-diop">
                Awa Diop
                </div>
              </div>
              <div class="riuser-fill">
                <img class="vector-4" src="../assets/vectors/vector_476_x2.svg" />
              </div>
              <span class="cliente">
              Cliente
              </span>
            </div>
            <div class="message-input-section">
              <i class="mdi mdi-emoticon-happy-outline icon"></i>
              <i class="mdi mdi-paperclip icon"></i>
              <input type="text" class="message-input" placeholder="Tapez un message...">
              <button class="send-button">
                  <i class="mdi mdi-send"></i>
              </button>
            </div>
          </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection