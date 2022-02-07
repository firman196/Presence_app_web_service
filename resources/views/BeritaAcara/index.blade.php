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
                                    url:"{{(Auth::guard('dosen')->check())? route('dosen.data.jadwal'):route('data.jadwal')}}",
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
                                    {
                                        data: 'action3',
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
                                  url: "{{(Auth::guard('dosen')->check())? url('dosen/generate/presensi'):url('generate/presensi')}}/"+id,
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
                                  url: "{{(Auth::guard('dosen')->check())? url('dosen/presensi'):url('presensi') }}/"+id,
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



















