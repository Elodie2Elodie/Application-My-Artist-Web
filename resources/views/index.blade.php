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
                    <h2 class="mb-5">$ 15,0000</h2>
                    <h6 class="card-text">22</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-orange card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Tenues <i class="mdi mdi-package mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">45</h2>
                    <h6 class="card-text">En cours</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-purple card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Tenues <i class="mdi mdi-package mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">20</h2>
                    <h6 class="card-text">En Attente</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-yellow card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Tenues <i class="mdi mdi-package mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">20</h2>
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
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Latif Kaline
                            </td>
                            <td> 5 </td>
                            <td>
                              <label class="badge badge-gradient-warning">En retard</label>
                            </td>
                            <td> 1 </td>
                            <td> 20 </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> 6 </td>
                            <td>
                              <label class="badge badge-gradient-danger">En retard</label>
                            </td>
                            <td> 3 </td>
                            <td> 42 </td>
                          </tr>
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
                  <!-- <div class="card-body">
                    <h4 class="card-title">Commandes</h4>
                    <div class="d-flex">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Client</th>
                            <th> Commandes</th>
                            <th> Couturier</th>
                            <th>  Date de prise</th>
                            <th> Date de remise </th>
                            <th> Taches</th>
                            <th>progression</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td> 4 </td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div> -->
                  <div class="card-body" >
                    <h4 class="card-title">Tâches du 23/08/2024</h4>
                    <div class="d-flex">
                    <div class="table-responsive" >
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Client</th>
                            <th> Commandes</th>
                            <th>  Date de prise</th>
                            <th> Date de remise </th>
                            <th> Taches</th>
                            <th>progression</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/faces/profil-1.jpg') }}" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/06/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tenues Avancement</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Due Date </th>
                            <th> Progress </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> Herman Beck </td>
                            <td> May 15, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 2 </td>
                            <td> Messsy Adam </td>
                            <td> Jul 01, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 3 </td>
                            <td> John Richards </td>
                            <td> Apr 12, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 4 </td>
                            <td> Peter Meggik </td>
                            <td> May 15, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 5 </td>
                            <td> Edward </td>
                            <td> May 03, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 5 </td>
                            <td> Ronald </td>
                            <td> Jun 05, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
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
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
           
          <!-- partial -->
        </div>
        </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   
    <!-- @push('scripts') -->
    <!-- Page-specific scripts -->
    <!-- <script src="{{ asset('assets/js/dashboard-specific.js') }}"></script>
    
    @endpush -->
@endsection