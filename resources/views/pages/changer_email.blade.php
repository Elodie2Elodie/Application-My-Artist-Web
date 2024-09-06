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
            <form action="{{ route('auth.changeEmail') }}" method="POST">
                    @csrf
                    <h2>Changer l'adresse e-mail</h2>

                    <!-- Champ pour le mot de passe actuel -->
                    <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:6%;">
                        <i class="mdi mdi-lock" style="font-size: 24px; margin-top:2%;"></i>
                        <input type="password" name="current_password" class="custome-input-2" placeholder="Entrer votre mot de passe actuel" required>
                    </div>
                    @if ($errors->has('current_password'))
                        <div style="color: red; margin-left:16%; margin-bottom:2%;">
                            {{ $errors->first('current_password') }}
                        </div>
                    @endif

                    <!-- Champ pour la nouvelle adresse e-mail -->
                    <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:6%;">
                        <i class="mdi mdi-email" style="font-size: 24px; margin-top:2%;"></i>
                        <input type="email" name="new_email" class="custome-input-2" placeholder="Entrer votre nouvelle adresse e-mail" required>
                    </div>
                    @if ($errors->has('new_email'))
                        <div style="color: red; margin-left:16%; margin-bottom:2%;">
                            {{ $errors->first('new_email') }}
                        </div>
                    @endif

                    <!-- Bouton pour soumettre -->
                    <button type="submit">Changer l'adresse e-mail</button>

                    <!-- Lien de retour -->
                    <div style="display: flex; margin-left:5%; color:#408A7E;">
                        <a href="{{ route('auth.showLoginForm') }}" style="color:#408A7E;">Retour</a>
                    </div>
            </form>

        </div>
    </div>

@endsection



