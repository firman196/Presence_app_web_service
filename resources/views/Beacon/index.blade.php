@extends('Master.master-dashboard')
@section('page-content')
 
 <!-- Header -->
  <div class="header bg-default ">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ $url }}">{{ $breadcrumb }}</a></li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
            <a href="#" id="tambah" class="btn btn-sm btn-neutral">Tambah</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">{{ $title }}</h3>
          </div>
          <!-- Light table -->
          <div class="table-responsive">
            <table class="table table-flush" id="dataTable">
              <thead class="thead-light">
                <tr>
                  <th>N0</th>
                  <th>Ruangan</th>
                  <th>Gedung</th>
                  <th>Jumlah Beacon</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
           </div>
          <!-- Card footer -->
        </div>
      </div>
    </div>
    

    <!-- modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-label"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-data" action="#" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="modal-body">
               
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="hari" class="form-control-label">Hari <span style="color: red">*</span></label>
                    <input id="hari" name="hari" type="text" placeholder="masukkan hari" class="form-control">
                    <span><small class="text-danger hari-error" id="hari-error"></small></span>
                  </div>
                  <div class="col-md-3">
                    <label for="jam_mulai" class="form-control-label">Jam Mulai <span style="color: red">*</span></label>
                    <input id="jam_mulai" name="jam_mulai" type="time" placeholder="masukkan jam mulai" class="form-control">
                    <span><small class="text-danger jam-mulai-error" id="jam-mulai-error"></small></span>
                  </div>
                  <div class="col-md-3">
                    <label for="jam_selesai" class="form-control-label">Jam Selesai <span style="color: red">*</span></label>
                    <input id="jam_selesai" name="jam_selesai" type="time" placeholder="masukkan jam selesai" class="form-control">
                    <span><small class="text-danger jam-selesai-error" id="jam-selesai-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="kode_ruang" class="form-control-label">Ruangan <span style="color: red">*</span></label>
                    <select name="kode_ruang" id="kode_ruang" class="form-control">
                      @foreach ($ruangs as $ruang)
                        <option value="{{ $ruang->kode_ruang }}">{{ $ruang->nama_ruang }}</option>
                      @endforeach
                    </select>
                    <span><small class="text-danger kode-ruang-error" id="kode-ruang-error"></small></span>
                  </div>
                 
                </div>
                
                <div class="text-right">
                    <a href="#"id="submit-data" class="submit-data btn btn-primary">Simpan</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    <!-- Modal -->
    @endsection

    @section('page-script')
                <script>
                      $(document).ready(function(){
                        toastr.options = {
                          "debug": false,
                          "positionClass": "toast-bottom-full-width",
                          "onclick": null,
                          "fadeIn": 300,
                          "fadeOut": 1000,
                          "timeOut": 5000,
                          "extendedTimeOut": 1000
                        }
                      
                      //get data table
                      fetch_data();

                      //fetch data method
                      function fetch_data(){                    
                            $('#dataTable').DataTable({
                                pageLength: 10,
                                lengthChange: true,
                                bFilter: true,
                                destroy: true,
                                processing: true,
                                serverSide: true,
                                oLanguage: {
                                    sZeroRecords: "Tidak Ada Data",
                                    sSearch: "Pencarian _INPUT_",
                                    sLengthMenu: "_MENU_",
                                    sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                                    sInfoEmpty: "0 data",
                                    oPaginate: {
                                        sNext: "<i class='fa fa-angle-right'></i>",
                                        sPrevious: "<i class='fa fa-angle-left'></i>"
                                    }
                                },
                                ajax: {
                                    url:"{{route('ruangan.datatable')}}",
                                    type: "GET"
                                },
                                
                                columns: [
                                    { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'nama_ruang',
                                        "className": "text-center"                                        
                                    },     
                                    {
                                        data: 'nama_gedung',
                                        "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'jumlah_beacon',
                                        "className": "text-center"                                        
                                    }, 
                                                                    
                                    {
                                        data: 'action2',
                                        "className": "text-center",
                                        orderable: false, 
                                        searchable: false    
                                    },
                                ]
                            });
                         
                        }


            });


                 
    </script>
@endsection



















