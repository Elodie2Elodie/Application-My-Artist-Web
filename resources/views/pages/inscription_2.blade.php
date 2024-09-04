<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
     <!-- plugins:css -->
     <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/inscription.css">
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
        
        <div class="main-container" style="margin-top: -20%; margin-bottom:5%;">
            <div class="logo-container">
                <img src="assets/my_artist_logo_3.png" alt="Logo" class="logo">
            </div>
        </div>

        <!-- Contenu de la page de connexion -->
        <div class="container">
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
        </div>
    </div>

    
    <!-- Ajoute d'autres cercles ici -->
</body>
</html>

