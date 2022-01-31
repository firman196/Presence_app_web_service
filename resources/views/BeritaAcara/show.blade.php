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


        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">{{ $title }}</h3>
          </div>
          <!-- Light table -->
          <div class="table-responsive">
            <table class="table table-bordered align-items-center text-center">
              <thead class="thead-light">
                <tr>
                  <th rowspan="2">N0</th>
                  <th rowspan="2">Hari/Tanggal</th>
                  <th rowspan="2">Jam</th>
                  <th rowspan="2">Pertemuan Ke</th>
                  <th colspan="3">Jumlah Mahasiswa </th>
                  <th rowspan="2">Materi kuliah yang diberikan</th>
                  <th rowspan="2">Media kuliah yang digunakan</th>
                  <th rowspan="2">Catatan</th>
                  <th rowspan="2">Action</th>
                </tr>
                <tr>
                  <th>Hadir</th>
                  <th>Izin</th>
                  <th>Alpha</th>
                </tr>
              </thead>
              <tbody>
                @foreach($beritaAcaras as $beritaAcara)
                  <tr>
                    <th>{{ $loop->iteration }}</th>
                    @if($beritaAcara->total_mahasiswa_hadir != null)
                      <th>{{ $beritaAcara->hari->nama_hari}} {{ (isset($beritaAcara->tanggal_pertemuan))? ' / '.$beritaAcara->tanggal_pertemuan:'' }}</th>
                      <th>{{ \App\Helpers\GeneralHelper::format_time_2digit($jadwal->jam_mulai).' - '. \App\Helpers\GeneralHelper::format_time_2digit($jadwal->jam_selesai) }} WIB</th>
                      <th>{{ $beritaAcara->pertemuan_ke }}</th>
                    @else
                      <th></th>
                      <th></th>
                      <th></th>
                    @endif
                    <th>{{ $beritaAcara->total_mahasiswa_hadir }}</th>
                    <th>{{ $beritaAcara->total_mahasiswa_izin }}</th>
                    <th>{{ ($beritaAcara->total_mahasiswa_hadir != null) ?$beritaAcara->total_mahasiswa_alpha:'' }}</th>
                    <th>{{ $beritaAcara->materi_perkuliahan }}</th>
                    <th>{{ $beritaAcara->media_perkuliahan }}</th>
                    <th>{{ $beritaAcara->catatan_perkuliahan }}</th>
                    <th>
                      @if($beritaAcara->status == 'aktif')
                        @if($beritaAcara->total_mahasiswa_hadir != null && strtotime($beritaAcara->jam_presensi_dibuka)>= strtotime($time) || strtotime($time)>=strtotime('+'.$beritaAcara->toleransi_keterlambatan.' minutes', strtotime($beritaAcara->jam_presensi_ditutup)))
                          <button id="tambah" class="tambah btn btn-sm btn-icon btn-primary"  type="button" data-id="{{ \Crypt::encrypt($beritaAcara->id) }}" >
                            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                            <span class="btn-inner--text">Tambah</span>
                          </button>
                        @else
                          <button id="tambah" class="tambah btn btn-sm btn-icon btn-primary" type="button" disabled>
                            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                            <span class="btn-inner--text">Tambah</span>
                          </button>
                        @endif
                      @endif
                    </th>
                  </tr>
                @endforeach
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
                  <label for="tanggal_pertemuan" class="form-control-label">Tanggal Pertemuan <span style="color: red">*</span></label>
                  <input type="date" class="form-control" name="tanggal_pertemuan" id="tanggalPertemuan">
                  <span><small class="text-danger tanggal-pertemuan-error" id="tanggal-pertemuan-error"></small></span>
                </div>
               
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="materi_perkuliahan" class="form-control-label">Materi Kuliah Yang Diberikan <span style="color: red">*</span></label>
                  <textarea name="materi_perkuliahan" id="materi_perkuliahan" cols="2" rows="2" class="form-control"></textarea>
                  <span><small class="text-danger materi-perkuliahan-error" id="materi-perkuliahan-error"></small></span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="media_perkuliahan" class="form-control-label">Media Kuliah Yang Digunakan </label>
                  <input type="text" name="media_perkuliahan" id="media_perkuliahan" class="form-control"></input>
                  <span><small class="text-danger media-perkuliahan-error" id="media-perkuliahan-error"></small></span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="catatan_perkuliahan" class="form-control-label">Catatan </label>
                  <textarea name="catatan_perkuliahan" id="catatan_perkuliahan" cols="2" rows="2" class="form-control"></textarea>
                  <span><small class="text-danger catatan-perkuliahan-error" id="catatan-perkuliahan-error"></small></span>
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
                          $('#modal-label').html('Tambah Berita Acara');
                          $('#submit-data').html('Simpan');
                          var id = $(this).data('id');
                          reset_model_value()
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                  type: 'PUT',
                                  data: $("#form-data").serialize(),
                                  url: "{{ url('beritaacara')}}/"+id,
                                  success : function(data){
                                    console.log(data);
                                    if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Berita Acara berhasil ditambahkan","success").then((val)=>{
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



















