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
                  <th>MATAKULIAH</th>
                  <th>HARI</th>
                  <th>JAM</th>
                  <th>KELAS</th>
                  <th>RUANGAN</th>
               <!--   <th>JAM PRESENSI DIBUKA</th>
                  <th>JAM PRESENSI DITUTUP</th>
                  <th>TOLERANSI KETERLAMBATAN</th>-->
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
                <div class="card bg-gradient-default">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4 col-sm-12">
                        <h5 class="card-title text-white">Kode Matakuliah</h5>
                      </div>
                      <div class="col-md-8 col-sm-12">
                        <h5 class="kode-matakuliah card-title text-white"></h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-12">
                        <h5 class="card-title text-white">Nama Matakuliah</h5>
                      </div>
                      <div class="col-md-8 col-sm-12">
                        <h5 class="nama-matakuliah card-title text-white"></h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-12">
                        <h5 class="card-title text-white">Kelas</h5>
                      </div>
                      <div class="col-md-8 col-sm-12">
                        <h5 class="kelas card-title text-white"></h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-12">
                        <h5 class="card-title text-white">Ruangan</h5>
                      </div>
                      <div class="col-md-8 col-sm-12">
                        <h5 class="ruangan card-title text-white"></h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-12">
                        <h5 class="card-title text-white">Dosen</h5>
                      </div>
                      <div class="col-md-8 col-sm-12">
                        <h5 class="dosen card-title text-white"></h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-11">
                        <h5 class="card-title text-white">Hari</h5>
                      </div>
                      <div class="col-md-8 col-sm-12">
                        <h5 class="hari card-title text-white"></h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-11">
                        <h5 class="card-title text-white">Jam Perkuliahan</h5>
                      </div>
                      <div class="col-md-8 col-sm-12">
                        <h5 class="jam card-title text-white"></h5>
                      </div>
                    </div>
                  
                  </div>
                </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="hari" class="form-control-label">Tanggal Presensi Dibuka <span style="color: red">*</span></label>
                  <input type="date" class="form-control" name="tanggal_presensi_dibuka">
                  <span><small class="text-danger tanggal-presensi-dibuka-error" id="tanggal-presensi-dibuka-error"></small></span>
                </div>
               
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="jam_presensi_dibuka" class="form-control-label">Jam Presensi Dibuka <span style="color: red">*</span></label>
                  <input id="jam_presensi_dibuka" name="jam_presensi_dibuka" type="time" placeholder="masukkan jam mulai" class="form-control">
                  <span><small class="text-danger jam-presensi-dibuka-error" id="jam-presensi-dibuka-error"></small></span>
                </div>
                <div class="col-md-6">
                  <label for="jam_presensi_ditutup" class="form-control-label">Jam Presensi Ditutup <span style="color: red">*</span></label>
                  <input id="jam_presensi_ditutup" name="jam_presensi_ditutup" type="time" placeholder="masukkan jam selesai" class="form-control">
                  <span><small class="text-danger jam-presensi-ditutup-error" id="jam-presensi-ditutup-error"></small></span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="toleransi_keterlambatan" class="form-control-label">Toleransi Keterlambatan <span style="color: red">*</span></label>
                  <div class="input-group">
                    <input id="toleransi_keterlambatan" name="toleransi_keterlambatan" type="number" placeholder="masukkan toleransi keterlambatan" class="form-control">
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon2">menit</span>
                    </div>
                  </div>
                  <span><small class="text-danger toleransi-keterlambatan-error" id="toleransi-keterlambatan-error"></small></span>
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
                                    url:"{{route('data.jadwal')}}",
                                    type: "GET"
                                },
                                
                                columns: [
                                    { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'matakuliah',
                                        "className": "text-center"                                        
                                    },     
                                    {
                                        data: 'hari',
                                        "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'jam',
                                        "className": "text-center"                                        
                                    },   
                                    {
                                        data: 'kelas',
                                        "className": "text-center"                                        
                                    }, 
                                    {
                                        data: 'ruang',
                                        "className": "text-center"                                        
                                    },  
                                 /*   {
                                        data: 'jam_presensi_dibuka',
                                        "className": "text-center"                                        
                                    },  
                                    {
                                        data: 'jam_presensi_ditutup',
                                        "className": "text-center"                                        
                                    },   
                                    {
                                        data: 'toleransi',
                                        "className": "text-center"                                        
                                    },  */ 
                                                                                                        
                                    {
                                        data: 'action2',
                                        "className": "text-center",
                                        orderable: false, 
                                        searchable: false    
                                    },
                                ]
                            });
                         
                        }


                        $('#dataTable tbody').on('click', '.generate-pertemuan', function () {
                                                    
                            var id                      = $(this).data('id');
                            var kode_jadwal             = $(this).data('kode_jadwal');
                            var hari_id                 = $(this).data('hari_id');
                            var jam_mulai               = $(this).data('jam_mulai');
                          
                           
                            $.ajax({
                                  type: 'PUT',
                                  data: {
                                    "_token": "{{ csrf_token() }}",
                                    kode_jadwal : kode_jadwal,
                                    hari_id     : hari_id,
                                    jam_mulai   : jam_mulai
                                  },
                                  url: "{{ url('generate/presensi') }}/"+id,
                                  success : function(data){
                                    console.log(data)
                                      if(JSON.parse(data.meta.code) == 200){
                                          swal.fire("Selesai","Presensi berhasil diupdate","success").then((val)=>{
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
                        });    


                        $('#dataTable tbody').on('click', '.edit', function () {
                            $('#Modal').modal();
                            $('#modal-label').html('Setting Presensi');
                            $('#submit-data').html('Simpan');
                            reset_model_value()
                          
                            var id                      = $(this).data('id');
                            var kode_jadwal             = $(this).data('kode_jadwal');
                            var kode_matakuliah         = $(this).data('kode_matakuliah');
                            var matakuliah              = $(this).data('matakuliah')
                            var hari                    = $(this).data('hari');
                            var jam_mulai               = $(this).data('jam_mulai');
                            var jam_selesai             = $(this).data('jam_selesai');
                            var ruangan                 = $(this).data('ruangan');
                            var kelas                   = $(this).data('kelas');
                            var dosen                   = $(this).data('dosen');

                          
                            $('.nama-matakuliah').html(matakuliah);
                            $('.kode-matakuliah').html(kode_matakuliah);
                            $('.kelas').html(kelas);
                            $('.ruangan').html(ruangan);
                            $('.dosen').html(dosen);
                            $('.hari').html(hari);
                            $('.jam').html(jam_mulai+' - '+jam_selesai+' WIB');
                           
                            $('#submit-data').on('click',function(e){
                              reset_error()
                              $.ajax({
                                  type: 'PUT',
                                  data: $("#form-data").serialize(),
                                  url: "{{ url('presensi') }}/"+id,
                                  success : function(data){
                                    console.log(data)
                                      if(JSON.parse(data.meta.code) == 200){
                                          $('#Modal').modal('hide');
                                          swal.fire("Selesai","Presensi berhasil diupdate","success").then((val)=>{
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


                        function reset_error(){
                            $( '#tanggal-presensi-dibuka-error' ).html('');
                            $( '#jam-presensi-dibuka-error' ).html('');
                            $( '#jam-presensi-ditutup-error' ).html('');
                            $( '#toleransi-keterlambatan-error' ).html('');
                           
                        }

                        function reset_model_value(){
                            $('#tanggal_presensi_dibuka').val('');
                            $('#jam_presensi_dibuka').val('');
                            $('#jam_presensi_ditutup').val('');
                            $('#toleransi_keterlambatan').val('');

                        }
                      

                      function error_message(datas){
                          if(datas.tanggal_presensi_dibuka){
                              $( '#tanggal-presensi-dibuka-error' ).html( datas.tanggal_presensi_dibuka[0] );
                          }
                          if(datas.jam_presensi_dibuka){
                              $( '#jam-presensi-dibuka-error' ).html( datas.jam_presensi_dibuka[0] );
                          }
                          if(datas.jam_presensi_ditutup){
                              $( '#jam-presensi-ditutup-error' ).html( datas.jam_presensi_ditutup[0] );
                          }
                          if(datas.toleransi_keterlambatan){
                              $( '#toleransi-keterlambatan-error' ).html( datas.toleransi_keterlambatan[0] );
                          }
                         
                      }  
    
            });


                 
    </script>
@endsection


















