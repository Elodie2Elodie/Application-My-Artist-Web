@extends('pages.layouts.menu')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/desktop_23.css') }}">
@endpush

@section('content')
        <!-- partial -->
         
        <div>
            
            <div class="container-3">
                <div class="rectangle-34625156" style="background: url('assets/images/rectangle_34625156.png') 50% / cover no-repeat;">
                    <div style="width: 40px; height:40px; background-color:#408A7E; margin-top:80%; border-radius:5px; margin-left:90%; display: flex; align-items: center; justify-content: center;" >
                    <i class="mdi mdi-pencil"></i>
                    </div>
                </div>
                <div class="container-8">
                  <div style="margin-top: 2%;">
                    <div class="input-container">
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <select name="" id="" class="custom-input">
                            <option value="" >Choisir un client</option>
                        </select>  
                    </div>
                  </div>
                                       
                    <a class="group-1000004778" style="text-decoration: none; display: flex; margin-bottom:-10%;" id="openPopupBtn" >
                        <span class="creer-un-client" style="margin-left: 8%; ">
                        Creer un client
                        </span>
                    </a>
                </div>
                    <a class="group-bouton" style="text-decoration: none; margin-right:5%;">
                        <span class="creer" style="margin-top: 2%;">
                            Creer
                        </span>
                    </a>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-text" style="margin-left: 20%;font-size: 24px;"></i>
                    <input type="text" class="custom-input-2" placeholder="Nom de la tenue">
                </div>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-account" style="margin-left: 20%;font-size: 24px;"></i>
                    <!-- <input type="text" class="custom-input-2" placeholder="Nom"> -->
                    <select name="" id="" class="custom-input-2">
                        <option value="" >Choisir le couturier</option>
                    </select>
                </div>
            </div>
            <div style="margin-top: 2%;">
                <div class="input-container">
                    <i class="mdi mdi-calendar" style="margin-left: 20%; font-size: 24px;"></i>
                    <input type="text" class="custom-input-2" placeholder="Date de finition">
                </div>
            </div>
            <div style="height:80px; width:1150px; background-color:#408A7E; margin-top:5%; margin-left:3%; padding-top:1.5%;">
                <h1 style="margin-left:45%; ">Tâches</h1>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-dark">Tâches à faire</h4>
                    <div class="add-items d-flex">
                      <input type="text" class="form-control todo-list-input" placeholder="Avez vous une nouvelle tâches à ajouter?">
                      <button class="add btn bg-gradient-green font-weight-bold todo-list-add-btn" id="add-task">Ajouter</button>
                    </div>
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Découpage</label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked> Assemblage du haut</label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Assemblage du bas</label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox">Couture premier niveau</label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked>Deuxieme couture </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Surfilage </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div  id="myPopup" class="popup">
          <div class="group-1000004708 popup-content">
              <div class="mingcuteclose-fill close">
                <img class="vector-97" src="../assets/vectors/vector_72_x2.svg" />
              </div>
              <div>
                <div style="margin-top: 2%; " >
                  <div class="input-container" >
                      <i class="mdi mdi-account" style="font-size: 24px;"></i>
                      <input type="text" class="custom-input-3" placeholder="Identifiant">
                  </div>
                </div>
                <div style="margin-top: 2%;" >
                    <div class="input-container" >
                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        <input type="text" class="custom-input-3" placeholder="Nom et Prénom">
                    </div>
                </div>
                <div style="margin-top: 2%;" >
                    <div class="input-container" >
                        <i class="mdi mdi-phone" style="font-size: 24px;"></i>
                        <input type="text" class="custom-input-3" placeholder="Numéro">
                    </div>
                </div>
                <div style="margin-top: 2%;" >
                    <div class="input-container" >
                        <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                        <input type="text" class="custom-input-3" placeholder="Mot De Passe">
                    </div>
                </div>
                <div style="margin-top: 2%; margin-bottom: 5%;" >
                    <div class="input-container" >
                        <i class="mdi mdi-lock" style="font-size: 24px;"></i>
                        <input type="text" class="custom-input-3" placeholder="Resaissez le mot de passe">
                    </div>
                </div>
              </div>
              <div class="group-bouton-2">
                <span class="creer">
                  Creer
                </span>
              </div>
          </div>
        </div>
    
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection