@extends('pages.layouts.menu')

@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                  <div class="card-body">
                    <h4 class="card-title">Commandes du 23/08/2024</h4>
                    <div class="d-flex">
                    <div class="table-responsive">
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
                            <tr onclick="location.href='#';" style="cursor:pointer;">
                                <td>
                                <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/05/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
                            </td>
                            <td> Comm004 </td>
                            <td> Aliou Sama </td>
                            <td> 22/05/2024</td>
                            <td> 22/05/2024</td>
                            <td>
                              <label class="badge badge-gradient-success">Bonne progression</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
                              <img src="assets/images/faces/profil-1.jpg" class="me-2" alt="image"> Modou Diouf
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
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
           
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
@endsection