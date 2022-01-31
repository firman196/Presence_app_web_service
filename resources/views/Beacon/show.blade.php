@extends('Master.master-dashboard')
@section('page-content')
 
 <!-- Header -->
  <div class="header bg-primary ">
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
        <div class="card bg-gradient-default">
          <div class="card-body">
            <div class="row">
              <div class="col-md-2 col-sm-11">
                <h5 class="card-title text-white">Nama Ruang</h5>
              </div>
              <div class="col-md-1 col-sm-1">
                <h5 class="card-title text-white">:</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                <h5 class="card-title text-white">{{ $ruang->nama_ruang }}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-11">
                <h5 class="card-title text-white">Nama Gedung</h5>
              </div>
              <div class="col-md-1 col-sm-1">
                <h5 class="card-title text-white">:</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                <h5 class="card-title text-white">{{ $ruang->nama_gedung }}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-11">
                <h5 class="card-title text-white">Prodi</h5>
              </div>
              <div class="col-md-1 col-sm-1">
                <h5 class="card-title text-white">:</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                <h5 class="card-title text-white">{{ $ruang->prodi->nama_prodi }}</h5>
              </div>
            </div>
                   
          </div>
        </div>


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
                  <th>KODE BEACON</th>
                  <th>UUID</th>
                  <th>MAJOR</th>
                  <th>MINOR</th>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
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
               <input type="hidden" id="kode_ruang" name="kode_ruang" value="{{ $ruang->kode_ruang }}">   
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="kode_beacon" class="form-control-label">Kode Beacon <span style="color: red">*</span></label>
                    <input id="kode_beacon" name="kode_beacon" type="text" placeholder="masukkan kode beacon" class="form-control">
                    <span><small class="text-danger kode-beacon-error" id="kode-beacon-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="uuid" class="form-control-label">UUID Beacon <span style="color: red">*</span></label>
                    <input id="uuid" name="uuid" type="text" placeholder="masukkan uuid beacon" class="form-control">
                    <span><small class="text-danger uuid-error" id="uuid-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="major" class="form-control-label">Major <span style="color: red">*</span></label>
                    <input id="major" name="major" type="number" placeholder="masukkan major" class="form-control">
                    <span><small class="text-danger major-error" id="major-error"></small></span>
                  </div>
                  <div class="col-md-6">
                    <label for="minor" class="form-control-label">Minor <span style="color: red">*</span></label>
                    <input id="minor" name="minor" type="number" placeholder="masukkan minor" class="form-control">
                    <span><small class="text-danger minor-error" id="minor-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="jarak_maksimal" class="form-control-label">Jarak Maksimal <span style="color: red">*</span></label>
                    <input id="jarak_maksimal" name="jarak_maksimal" type="number" placeholder="masukkan jarak maksimal beacon" class="form-control">
                    <span><small class="text-danger jarak-maksimal-error" id="jarak-maksimal-error"></small></span>
                  </div>
                </div>
                                               
                <div class="text-right">
                    <a href="#"id="submit-data" class="submit-data btn btn-primary">Simpan</a>
                </div>
            </form>
          </div>
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


                      $('#tambah').on('click',function(e){
                          $('#Modal').modal();
                          $('#modal-label').html('Tambah Data Beacon');
                          $('#submit-data').html('Simpan');
                          reset_model_value()
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                  type: 'POST',
                                  data: $("#form-data").serialize(),
                                  url: "{{ route('beacon.store') }}",
                                  success : function(data){
                                    if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Beacon berhasil ditambahkan","success").then((val)=>{
                                          location.reload();
                                        });
                                    }
                                  },
                                  error: function(xhr, status, err) {
                                      var response = JSON.parse(xhr.responseText)
                                      if(response.meta.code == 401){
                                          error_message(response.data.error);
                                      }
                                      if(response.meta.code == 500){
                                          toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                                      }
                                  }
                            });
                        })                               
                      });

                      $('#dataTable tbody').on('click', '.edit', function () {
                          $('#Modal').modal();
                          $('#modal-label').html('Edit Data Beacon');
                          $('#submit-data').html('Simpan');
                          reset_model_value()
                         
                          var id                      = $(this).data('id');
                          var kode_beacon             = $(this).data('kode_beacon');
                          var uuid                    = $(this).data('uuid');
                          var major                   = $(this).data('major');
                          var minor                   = $(this).data('minor');
                          var jarak_maksimal          = $(this).data('jarak_maksimal');
                     
                          $('#kode_beacon').val(kode_beacon);
                          $('#uuid').val(uuid);
                          $('#major').val(major);
                          $('#minor').val(minor);
                          $('#jarak_maksimal').val(jarak_maksimal);
                                      
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                type: 'PUT',
                                data: $("#form-data").serialize(),
                                url: "{{ url('beacon/update') }}/"+id,
                                success : function(data){
                                  if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Beacon berhasil diupdate","success").then((val)=>{
                                          location.reload();
                                        });
                                    }
                                },
                                error: function(xhr, status, err) {
                                      var response = JSON.parse(xhr.responseText)
                                      if(response.meta.code == 401){
                                          error_message(response.data.error);
                                      }
                                      if(response.meta.code == 500){
                                          toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                                      }
                                }  
                            });
                          })
                      });       

                      $('#dataTable tbody').on('click', '.hapus', function () {
                          var id          = $(this).data('id');
                         
                          $.ajax({
                                    url:"{{ url('beacon/delete') }}/"+id,
                                    data:{
                                      "_token": "{{ csrf_token() }}"
                                    },
                                    type:"DELETE",
                                    success : function(data){
                                      if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Matakuliah berhasil dihapus","success").then((val)=>{
                                          location.reload();
                                        });
                                      }
                                    },
                                    error:function(XMLHttpRequest){
                                      toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                                    }
                                });
                      });


                     
                      //fetch data method
                      function fetch_data(){   
                        var id            = $('#kode_ruang').val();
                                     
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
                                    url:"{{url('data/beacon')}}/"+id,
                                    type: "GET"
                                },
                                
                                columns: [
                                    { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'kode_beacon',
                                        "className": "text-center"                                        
                                    },     
                                    {
                                        data: 'uuid',
                                        "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'major',
                                        "className": "text-center"                                        
                                    }, 
                                    {
                                        data: 'minor',
                                        "className": "text-center"                                        
                                    },                             
                                    {
                                        data: 'action',
                                        "className": "text-center",
                                        orderable: false, 
                                        searchable: false    
                                    },
                                ]
                            });
                         
                        }



                    function reset_error(){
                        $( '#kode-beacon-error' ).html('');
                        $( '#uuid-error' ).html('');
                        $( '#major-error' ).html('');
                        $( '#minor-error' ).html('');
                        $( '#jarak-maksimal-error' ).html('');
                     
                    }

                    function reset_model_value(){
                        $('#kode_beacon').val('');
                        $('#uuid').val('');
                        $('#major').val('');
                        $('#minor').val('');
                        $('#jarak_maksimal').val('');

                      }
                     

                    function error_message(datas){
                       
                        if(datas.kode_beacon){
                            $( '#kode-beacon-error' ).html( datas.kode_beacon[0] );
                        }
                        if(datas.uuid){
                            $( '#uuid-error' ).html( datas.uuid[0] );
                        }
                        if(datas.major){
                            $( '#major-error' ).html( datas.major[0] );
                        }
                        if(datas.minor){
                            $( '#minor-error' ).html( datas.minor[0] );
                        }

                        if(datas.jarak_maksimal){
                            $( '#jarak-maksimal-error' ).html( datas.jarak_maksimal[0] );
                        }
                       
                                    
                     }  
            });


                 
    </script>
@endsection



















