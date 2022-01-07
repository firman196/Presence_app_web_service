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
        <div class="card bg-gradient-default">
          <div class="card-body">
            <div class="row">
              <div class="col-md-2 col-sm-12">
                <h5 class="card-title text-white">Nama Matakuliah</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                <h5 class="card-title text-white">{{ $jadwal->matakuliah->nama_matakuliah }}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-11">
                <h5 class="card-title text-white">Hari</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                <h5 class="card-title text-white">{{ $jadwal->hari->nama_hari }}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-11">
                <h5 class="card-title text-white">Jam Perkuliahan</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                <h5 class="card-title text-white">{{ \App\Helpers\GeneralHelper::format_time_2digit($jadwal->jam_mulai).' - '. \App\Helpers\GeneralHelper::format_time_2digit($jadwal->jam_selesai) }} WIB</h5>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2 col-sm-11">
                <h5 class="card-title text-white">Jam Presensi</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                @if(isset($jadwal->jam_presensi_dibuka) || isset($jadwal->jam_presensi_ditutup))
                  <h5 class="card-title text-white">{{ \App\Helpers\GeneralHelper::format_time_2digit($jadwal->jam_presensi_dibuka).' - '.\App\Helpers\GeneralHelper::format_time_2digit($jadwal->jam_presensi_ditutup) }} WIB</h5>
                @else
                  <span class="badge badge-pill badge-warning">Belum Disetting</span>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-11">
                <h5 class="card-title text-white">Toleransi Presensi</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                @if(isset($jadwal->toleransi))
                  <h5 class="card-title text-white">{{ \App\Helpers\GeneralHelper::format_time_2digit($jadwal->toleransi) }} WIB</h5>
                @else
                  <span class="badge badge-pill badge-warning">Belum Disetting</span>
                @endif
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
                  <th>NIM</th>
                  <th>NAMA MAHASISWA</th>
                  <th>HADIR</th>
                  <th>IZIN</th>
                  <th>ALFA</th>
                  <th>TANGGAL PRESENSI</th>
                  <th>JAM PRESENSI</th>
                  <th>KODE BEACON</th>
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
                     
                          $('#kode_beacon').val(kode_beacon);
                          $('#uuid').val(uuid);
                          $('#major').val(major);
                          $('#minor').val(minor);
                                      
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
                     
                    }

                    function reset_model_value(){
                        $('#kode_beacon').val('');
                        $('#uuid').val('');
                        $('#major').val('');
                        $('#minor').val('');

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
                       
                                    
                     }  
            });


                 
    </script>
@endsection



















