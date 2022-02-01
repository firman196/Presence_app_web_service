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
                <h5 class="card-title text-white">Kelas</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                <h5 class="card-title text-white">{{ $jadwal->kelas->nama_kelas }}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-11">
                <h5 class="card-title text-white">Ruangan</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                  <h5 class="card-title text-white">{{ $jadwal->ruangan->nama_ruang }}</h5>
              </div>
            </div>   
          </div>
        </div>

        <div class="accordion" id="accordionExample">
          @foreach ($jadwal->presensi as $presensi)
          <div class="card" >
            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapse{{ $presensi->pertemuan_ke }}" aria-expanded="true" aria-controls="collapseOne" data-id="{{ $presensi->id }}">
              <div class="row">
                <div class="col-md-10 col-xs-12">
                  <h4 class="mb-0">
                    Pertemuan Ke - {{ $presensi->pertemuan_ke }}
                  </h4>
                </div>
               <div class="col-md-2 col-xs-12">
               
               </div>
               
              </div>
            </div>
            <div id="collapse{{ $presensi->pertemuan_ke }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                    <a href="#" id="generate-pertemuan" class="ml-auto mb-4 generate-pertemuan btn btn-icon btn-default" data-id="{{ \Crypt::encrypt($presensi->id) }}" data-hari_id="{{ $presensi->hari_id}}" data-jam_presensi_dibuka="{{ $presensi->jam_presensi_dibuka}}" data-jam_presensi_ditutup="{{ $presensi->jam_presensi_ditutup }}" data-toleransi_keterlambatan="{{ $presensi->toleransi_keterlambatan }}">
                      <span class="btn-inner--icon"><i class="fas fa-sync-alt"></i></span>
                      <span class="btn-inner--text">Edit Settingan</span>
                    </a>
                </div>
                <div class="table-responsive">
                  <input type="hidden" id="presensi-id" value="{{ \Crypt::encrypt($presensi->id) }}">
                  <table class="dataTable table table-flush" id="dataTable">
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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                 </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    

    <!-- modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-label"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         
          <form id="form-status" action="#" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden"  name="kode_jadwal" value="{{ $jadwal->kode_jadwal }}">
            <div class="modal-body">
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="status" class="form-control-label">Status Kehadiran <span style="color: red">*</span></label>
                  <select name="status" id="status" class="form-control">
                    @foreach ($status as $statuss)
                    <option value="{{ $statuss->kode }}">{{ $statuss->kode }}</option> 
                    @endforeach
                  </select>
                  <span><small class="text-danger status-error" id="status-error"></small></span>
                </div>
               
              </div>
                                       
              <div class="text-right">
                  <a href="#"id="submit-data" class="submit-data btn btn-primary">Aktifkan</a>
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


                        $('.collapse').on('shown.bs.collapse', function (e) {
                           var id = $(this).parent().find('#presensi-id').val();
                           var dataTable = $(this).parent().find('#dataTable');
                           fetch_data(id, dataTable);

                           $(this).parent().find('.generate-pertemuan').on('click',function(){
                             $('#Modal').modal();
                             $('.modal-title').html('Aktifkan Presensi')
                             var id = $(this).data('id');
                             var hari = $(this).data('hari_id');
                             var jam_dibuka = $(this).data('jam_presensi_dibuka');
                             var jam_ditutup = $(this).data('jam_presensi_ditutup');
                             var toleransi   = $(this).data('toleransi_keterlambatan');
                           
                             $('#hari option[value="'+hari+'"]').prop("selected", true);
                             $('#jam_presensi_dibuka').val(jam_dibuka);
                             $('#jam_presensi_ditutup').val(jam_ditutup);
                             $('#toleransi_keterlambatan').val(toleransi)
                             $('#submit-data').on('click',function(e){
                                $.ajax({
                                  type: 'PUT',
                                  data: $("#form-data").serialize(),
                                  url: "{{ url('presensi') }}/"+id,
                                  success : function(data){
                                      if(JSON.parse(data.meta.code) == 200){
                                          $('#Modal').modal('hide');
                                          swal.fire("Selesai","Presensi berhasil diaktifkan","success").then((val)=>{
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
                      });
                      

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
                          $('#modal-label').html('Edit Status Presensi Mahasiswa');
                          $('#submit-data').html('Simpan');
                          reset_model_value()
                         
                          var id                      = $(this).data('id');
                          var status                  = $(this).data('kode_status_presensi');
                     
                          $('#status option[value="'+status+'"]').prop("selected", true);
                                      
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                type: 'PUT',
                                data: $("#form-status").serialize(),
                                url: "{{ url('status/presensi') }}/"+id,
                                success : function(data){
                                  if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Status Kehadiran berhasil diupdate","success").then((val)=>{
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
                      function fetch_data(id,dataTable){   
                        dataTable.DataTable({
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
                                    url:"{{url('data/rekap-kehadiran')}}",
                                    type: "GET",
                                    data:{
                                      presensi_id : id
                                    }
                                },
                                
                                columns: [
                                    { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'nim',
                                     //   "className": "text-center"                                        
                                    },     
                                    {
                                        data: 'nama',
                                       // "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'hadir',
                                        "className": "text-center"                                        
                                    }, 
                                    {
                                        data: 'izin',
                                        "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'alfa',
                                        "className": "text-center"                                        
                                    },       
                                    {
                                        data: 'tanggal_presensi',
                                        "className": "text-center"                                        
                                    },   
                                    {
                                        data: 'jam_presensi',
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



















