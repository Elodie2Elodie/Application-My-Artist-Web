@extends('pages.layouts.menu')

@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-green card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Commandes <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5"> {{ $sommeMois }} F CFA</h2>
                    <h6 class="card-text">{{ $nombreCommandesMois }}</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-orange card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Commandes <i class="mdi mdi-package mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $countEnCours}}</h2>
                    <h6 class="card-text">En cours</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-purple card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Commandes <i class="mdi mdi-package mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $countAttente}}</h2>
                    <h6 class="card-text">En Attente</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-yellow card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Commandes <i class="mdi mdi-package mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $countRetard}}</h2>
                    <h6 class="card-text">En retards</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-start">Statistiques des ventes</h4>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-end"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Commandes</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                      <canvas id="traffic-chart"></canvas>
                    </div>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Couturiers </h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Nom</th>
                            <th> Commandes</th>
                            <th> Retard</th>
                            <th> Taches </th>
                            <th> Messages en attente </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                            <td> 0 </td>
                            <td> 22 </td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="route-fetch-commandes" data-url="{{ route('commandes.getCommandesByDate', ['date' => '2024-09-22']) }}" style="display: none;"></div>
            <div class="row">
              <div class="col-lg-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body p-0 d-flex">
                    <div id="inline-datepicker" class="datepicker datepicker-custom"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                        <h4 class="card-title">Commandes du <span id="selected-date">23/08/2024</span></h4>
                        <div class="d-flex">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Commandes</th>
                                            <th>Date de début</th>
                                            <th>Date de remise</th>
                                            <th>Etat</th>
                                            <th>Progression</th>
                                        </tr>
                                    </thead>
                                    <tbody id="commandes-table-body">
                                      
                                        <!-- Les lignes de commandes seront insérées ici par JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-dark">Tâches à faire</h4>
                    
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                        
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
           
          <!-- partial -->
        </div>
        </div>
      <!-- page-body-wrapper ends -->
    </div>
    
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/myjscalendrier.js') }}"></script>
    @endpush
@endsection