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
            <div id="route-fetch-commandes" data-url="{{ route('commandes.getCommandesByDate', ['date' => '2024-09-22']) }}" style="display: none;"></div>
            <a href="{{ route('commandes.getCommandesByDate', ['date' => '2024-09-22']) }}" style="display: none;">Test</a>
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
        <!-- main-panel ends -->
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/myjscalendrier.js') }}"></script>
  @endpush
@endsection