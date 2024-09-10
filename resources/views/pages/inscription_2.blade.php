<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
     <!-- plugins:css -->
     <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/inscription.css') }}">
</head>
<body>
    <!-- Cercles -->
    <div class="circle small circle-1" style="background-color: #96e976;"></div>
    <div class="circle medium circle-2" ></div>
    <div class="circle large circle-3" ></div>
    <div class="circle small circle-4" style="background-color: #96e976;"></div>
    <div class="circle medium circle-5" style="background-color: #96e976;"></div>
    <div class="circle large circle-6-2" ></div>
    <div class="circle small circle-6" style="background-color: #96e976;"></div>
    <div class="circle medium circle-7" style="background-color: #96e976;"></div>
    <div class="circle extra-large circle-8" style="background-color: #96e976;"></div>
    <div class="circle extra-large circle-8-2"></div>
    <div class="circle large circle-9" style="background-color: #96e976;"></div>
    <div class="circle medium circle-10" ></div>

 <!-- Conteneur principal -->
 <div class="main-container">
        <!-- Logo -->
        
        <div class="main-container">
            <div class="logo-container">
                <img src="{{ asset('assets/my_artist_logo_3.png') }}" alt="Logo" class="logo">
            </div>
        </div>

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
        <!-- Contenu de la page de connexion -->
        <!-- <div class="container">
            <form action="">
                <h2>Inscription-Information de l'administrateur</h2>
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-account" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" class="custom-input-2" placeholder="Identifiant">
                </div>

                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-account" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" class="custom-input-2" placeholder="Nom et prénom">
                </div>

                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-map-marker" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" class="custom-input-2" placeholder="Adresse">
                </div>
                
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-phone" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" class="custom-input-2" placeholder="Numéro">
                </div>

                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-at" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" class="custom-input-2" placeholder="Email">
                </div>

                <div class="input-lock" style="display: flex; margin-left:16%;  margin-bottom:5%;">
                    <i class="mdi mdi-lock" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" class="custom-input-2" placeholder="Mot de passe">
                </div>

                <div class="input-lock" style="display: flex; margin-left:16%;  margin-bottom:5%;">
                    <i class="mdi mdi-lock" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" class="custom-input-2" placeholder="Resaisissez le mot de passe">
                </div>
                <button type="submit">Suivant</button>
                <div style="display: flex; margin-left:5%; color:#408A7E;">
                    <a href="{{ route('connexion') }}"  style="color:#408A7E;">J'ai déjà un compte</a>
                    
                </div>
            </form>
        </div> -->
        <div style="display: flex;">
    <!-- Section pour l'inscription de l'atelier -->
    

    <!-- Section pour l'inscription de l'administrateur -->
    <form action="{{ route('auth.register') }}" method="POST" style="display: flex;" enctype="multipart/form-data">
        <div class="container" style="margin-right: 5%; height:440px; margin-top: 10%;">
                <h2>Inscription - Information de l'atelier</h2>
                
                <!-- Nom -->
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-account" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="file" id="fileInput" name="profile_photo" class="custom-input-2">
                </div>

                <!-- Nom -->
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-account" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" name="atelier_name" class="custom-input-2" placeholder="Nom" value="{{ old('atelier_name') }}">
                </div>

                <!-- Adresse -->
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-map-marker" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" name="atelier_address" class="custom-input-2" placeholder="Adresse" value="{{ old('atelier_address') }}">
                </div>

                <!-- Numéro -->
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-phone" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="text" name="atelier_phone" class="custom-input-2" placeholder="Numéro" value="{{ old('atelier_phone') }}">
                </div>

                <!-- Email -->
                <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                    <i class="mdi mdi-at" style="font-size: 24px; margin-top:2%;"></i>
                    <input type="email" name="atelier_email" class="custom-input-2" placeholder="Email" value="{{ old('atelier_email') }}">
                </div>
        </div>
        <div class="container" style="margin-top: 3%;">
                    @csrf
                    <h2>Inscription - Information de l'administrateur</h2>

                    <!-- Nom -->
                    <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                        <i class="mdi mdi-account" style="font-size: 24px; margin-top:2%;"></i>
                        <input type="text" name="lastName" class="custom-input-2" placeholder="Nom" value="{{ old('lastName') }}">
                    </div>
                    @error('lastName')
                        <div style="color:red; margin-left:16%;">{{ $message }}</div>
                    @enderror

                    <!-- Prénom -->
                    <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                        <i class="mdi mdi-account" style="font-size: 24px; margin-top:2%;"></i>
                        <input type="text" name="firstName" class="custom-input-2" placeholder="Prénom" value="{{ old('firstName') }}">
                    </div>
                    @error('firstName')
                        <div style="color:red; margin-left:16%;">{{ $message }}</div>
                    @enderror

                    <!-- Adresse -->
                    <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                        <i class="mdi mdi-map-marker" style="font-size: 24px; margin-top:2%;"></i>
                        <input type="text" name="adress" class="custom-input-2" placeholder="Adresse" value="{{ old('adress') }}">
                    </div>
                    @error('adress')
                        <div style="color:red; margin-left:16%;">{{ $message }}</div>
                    @enderror

                    <!-- Numéro de téléphone -->
                    <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                        <i class="mdi mdi-phone" style="font-size: 24px; margin-top:2%;"></i>
                        <input type="text" name="telephone" class="custom-input-2" placeholder="Numéro de téléphone" value="{{ old('telephone') }}">
                    </div>
                    @error('telephone')
                        <div style="color:red; margin-left:16%;">{{ $message }}</div>
                    @enderror

                    <!-- Email -->
                    <div class="input-container" style="display: flex; margin-left:16%; margin-bottom:4%;">
                        <i class="mdi mdi-at" style="font-size: 24px; margin-top:2%;"></i>
                        <input type="email" name="email" class="custom-input-2" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div style="color:red; margin-left:16%;">{{ $message }}</div>
                    @enderror

                    <!-- Mot de passe -->
                    <div class="input-lock" style="display: flex; margin-left:16%; margin-bottom:5%;">
                        <i class="mdi mdi-lock" style="font-size: 24px; margin-top:2%;"></i>
                        <input type="password" name="password" class="custom-input-2" placeholder="Mot de passe">
                    </div>
                    @error('password')
                        <div style="color:red; margin-left:16%;">{{ $message }}</div>
                    @enderror

                    <!-- Confirmation du mot de passe -->
                    <div class="input-lock" style="display: flex; margin-left:16%; margin-bottom:5%;">
                        <i class="mdi mdi-lock" style="font-size: 24px; margin-top:2%;"></i>
                        <input type="password" name="password_confirmation" class="custom-input-2" placeholder="Confirmez le mot de passe">
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="text" name="role" style="display: none;" value="admin">
            </div>
        </div>

        <!-- Lien vers la page de connexion -->
        <div style="display: flex; margin-left:35%; margin-top: 40px; color:#408A7E;">
            <!-- Boutons de soumission et redirection -->
            <a href="{{ route('auth.showLoginForm') }}" style="color:#408A7E; margin-right:10%;">J'ai déjà un compte</a>
            <button type="submit" style="background-color: #408A7E; color: white; border: none; padding: 10px 20px; cursor: pointer; ">S'inscrire</button>
            
        </div>
    </form>

        
 </div>

    
    <!-- Ajoute d'autres cercles ici -->
</body>
</html>

