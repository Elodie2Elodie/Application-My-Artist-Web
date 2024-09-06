@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/desktop_23.css') }}">
@endpush

@section('content')
            <div>
        <!-- partial -->
        <form action="{{ route('auth.updateUser') }}" method="POST">
            @csrf
            @method('PUT') <!-- Utilisé pour les mises à jour en Laravel -->
            <div>
                <!-- Champ Nom -->
                <div style="margin-top: 12%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <input type="text" name="firstName" class="custom-input-3" placeholder="Nom"  value="{{ $user[0]['firstName'] }} ">
                        @if ($errors->has('firstName'))
                            <span class="text-danger">{{ $errors->first('firstName') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Champ Prénom -->
                <div style="margin-top: 2%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <input type="text" name="lastName" class="custom-input-3" placeholder="Prenom" value="{{ $user[0]['lastName'] }} ">
                        @if ($errors->has('lastName'))
                            <span class="text-danger">{{ $errors->first('lastName') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Champ Email -->
                <div style="margin-top: 2%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-at" style="font-size: 24px;"></i>
                        <input type="email" name="email" class="custom-input-3" placeholder="Email" value="{{ session('user.email') }}" disabled>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Champ Téléphone -->
                <div style="margin-top: 2%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-phone-outline" style="font-size: 24px;"></i>
                        <input type="text" name="telephone" class="custom-input-3" placeholder="Téléphone" value="{{ $user[0]['telephone'] }}">
                        @if ($errors->has('telephone'))
                            <span class="text-danger">{{ $errors->first('telephone') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Champ Adresse -->
                <div style="margin-top: 2%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-home-account" style="font-size: 24px;"></i>
                        <input type="text" name="adress" class="custom-input-3" placeholder="Adresse" value="{{ $user[0]['addresse'] }} ">
                        @if ($errors->has('adress'))
                            <span class="text-danger">{{ $errors->first('adress') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Bouton Modifier -->
                <div class="container-3" style="display: flex; margin-left:50%; margin-top: 5%;">
                    <button type="submit" class="group-bouton" style="text-decoration: none;">
                        <span class="creer" style="margin-top: 2%;">
                            Modifier
                        </span>
                    </button>
                </div>
            </div>
        </form>

        
    
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection