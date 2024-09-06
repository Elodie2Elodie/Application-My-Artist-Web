@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/inscription copy.css') }}">
@endpush

@section('content')
 <!-- Conteneur principal -->
 <div class="main-containery">
        <!-- Logo -->
        
        
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-left:70%; width:640px;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif

        @if (session('success'))
            <div class="alert alert-success " style="margin-left:16%; color: green; margin-left:70%; width:640px;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="center-flex alert alert-success " style="margin-bottom:5%;  background-color: rgba(255, 0, 0, 0.5); margin-left:70%; width:640px;">
                {{ session('error') }}
            </div>
        @endif
        <!-- Contenu de la page de connexion -->
        <div class="containery" style="margin-left:80%; margin-top:40%;">
            <form action="{{ route('auth.changePassword') }}" method="POST">
                @csrf
                <!-- Ancien mot de passe -->
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:10%;">
                    <i class="mdi mdi-lock" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="password" name="current_password" class="custome-input-2" placeholder="Saisissez l'ancien mot de passe">
                </div>
                @if ($errors->has('current_password'))
                    <div class="error-message" style="color: red; margin-left: 16%;">{{ $errors->first('current_password') }}</div>
                @endif

                <!-- Nouveau mot de passe -->
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:10%;">
                    <i class="mdi mdi-lock" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="password" name="new_password" class="custome-input-2" placeholder="Saisissez le nouveau mot de passe">
                </div>
                @if ($errors->has('new_password'))
                    <div class="error-message" style="color: red; margin-left: 16%;">{{ $errors->first('new_password') }}</div>
                @endif

                <!-- Confirmation du nouveau mot de passe -->
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:10%;">
                    <i class="mdi mdi-lock" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="password" name="new_password_confirmation" class="custome-input-2" placeholder="Ressaisissez le nouveau mot de passe">
                </div>
                @if ($errors->has('new_password_confirmation'))
                    <div class="error-message" style="color: red; margin-left: 16%;">{{ $errors->first('new_password_confirmation') }}</div>
                @endif

                <button type="submit">Modifier</button>
            </form>

        </div>
    </div>

@endsection

