@extends('pages.layouts.menu')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/desktop_23.css') }}">
@endpush

@section('content')
        <!-- partial -->
        <div>
            
            <div style="margin-top: 12%; margin-left: 30%" >
                <div class="input-container" >
                    <i class="mdi mdi-account" style="font-size: 24px;"></i>
                    <input type="text" class="custom-input-3" placeholder="Nom et Prenom">
                </div>
            </div>
            <div style="margin-top: 2%; margin-left: 30%" >
                <div class="input-container" >
                    <i class="mdi mdi-at" style="font-size: 24px;"></i>
                    <input type="text" class="custom-input-3" placeholder="Email">
                </div>
            </div>
            <div style="margin-top: 2%; margin-left: 30%" >
                <div class="input-container" >
                    <i class="mdi mdi-phone-outline" style="font-size: 24px;"></i>
                    <input type="text" class="custom-input-3" placeholder="Telephone">
                </div>
            </div>
            <div style="margin-top: 2%; margin-left: 30%" >
                <div class="input-container" >
                    <i class="mdi mdi-home-account" style="font-size: 24px;"></i>
                    <input type="text" class="custom-input-3" placeholder="Adresse">
                </div>
            </div>
            <div style="margin-top: 2%; margin-left: 30%">
                <div class="input-container">
                    <i class="mdi mdi-account" style="font-size: 24px;"></i>
                    <!-- <input type="text" class="custom-input-2" placeholder="Nom"> -->
                    <select name="" id="" class="custom-input-3">
                        <option value="" >Rôle</option>
                        <option value="" >Couturier</option>
                    </select>
                </div>
            </div>
            <div class="container-3" style="display: flex; margin-left:50%; margin-top: 5%; ">    
                <a class="group-bouton" style="text-decoration: none;">
                    <span class="creer" style="margin-top: 2%; ">
                        Modifier
                    </span>
                </a>
            </div>
            
        </div>

        
    
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection