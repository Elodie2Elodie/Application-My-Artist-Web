@extends('pages.layouts.menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/desktop_23.css') }}">
@endpush

@section('content')
            <div>
        <!-- partial -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif

        @if (session('success'))
            <div class="alert alert-success" style="margin-left:16%; color: green;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="center-flex alert alert-success" style="margin-bottom:5%;  background-color: rgba(255, 0, 0, 0.5);">
                {{ session('error') }}
            </div>
        @endif
        <div>
            
            <form action="{{ route('auth.registerUser') }}" method="POST">
                @csrf

                <div style="margin-top: 12%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <input type="text" name="firstName" class="custom-input-3" placeholder="Prénom" value="{{ old('firstName') }}" required>
                    </div>
                    @error('firstName')
                        <div style="color: red; margin-left: 30%; margin-top: 5%;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="margin-top: 2%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <input type="text" name="lastName" class="custom-input-3" placeholder="Nom" value="{{ old('lastName') }}" required>
                    </div>
                    @error('lastName')
                        <div style="color: red; margin-left: 30%; margin-top: 5%;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="margin-top: 2%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-at" style="font-size: 24px;"></i>
                        <input type="email" name="email" class="custom-input-3" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div style="color: red; margin-left: 30%; margin-top: 5%;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="margin-top: 2%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-phone-outline" style="font-size: 24px;"></i>
                        <input type="text" name="telephone" class="custom-input-3" placeholder="Téléphone" value="{{ old('telephone') }}" required>
                    </div>
                    @error('telephone')
                        <div style="color: red; margin-left: 30%; margin-top: 5%;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="margin-top: 2%; margin-left: 30%">
                    <div class="input-container">
                        <i class="mdi mdi-home-account" style="font-size: 24px;"></i>
                        <input type="text" name="adress" class="custom-input-3" placeholder="Adresse" value="{{ old('adress') }}" required>
                    </div>
                    @error('adress')
                        <div style="color: red; margin-left: 30%; margin-top: 5%;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="margin-top: 2%; margin-left: 30%">
                    <div class="input-container">
                        
                        <input type="text" name="role" class="custom-input-3" value="couturier" style="display: none;">
                    </div>
                </div>

                <div class="container-3" style="display: flex; margin-left: 50%; margin-top: 5%;">
                    <button type="submit" class="group-bouton" style="text-decoration: none;">
                        <span class="creer" style="margin-top: 2%; margin-left: 15%">
                            Créer
                        </span>
                    </button>
                </div>
            </form>

            
        </div>

        
    
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection