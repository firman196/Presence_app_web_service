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
                  <th>DOSEN</th>
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
                  <div class="col-md-4">
                    <label for="kode_jadwal" class="form-control-label">Kode Jadwal <span style="color: red">*</span></label>
                    <input id="kode_jadwal" name="kode_jadwal" type="text" placeholder="masukkan kode jadwal" class="form-control">
                    <span><small class="text-danger kode-jadwal-error" id="kode-jadwal-error"></small></span>
                  </div>
                  <div class="col-md-8">
                    <label for="kode_matakuliah" class="form-control-label">Matakuliah<span style="color: red">*</span></label>
                    <select name="kode_matakuliah" id="kode_matakuliah" class="form-control">
                      @foreach($matakuliahs as $matakuliah)
                        <option value="{{ $matakuliah->kode_matakuliah }}">{{ $matakuliah->nama_matakuliah }}</option>
                      @endforeach
                    </select>
                    <span><small class="text-danger kode-matakuliah-error" id="kode-matakuliah-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="hari" class="form-control-label">Hari <span style="color: red">*</span></label>
                    <select name="hari_id" id="hari" class="form-control">
                      @foreach ($haris as $hari)
                        <option value="{{ $hari->id }}">{{ $hari->nama_hari }}</option>
                      @endforeach
                    </select>
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
                  <div class="col-md-6">
                    <label for="kelas_id" class="form-control-label">Kelas <span style="color: red">*</span></label>
                    <select name="kelas_id" id="kelas_id" class="form-control">
                      @foreach($kelass as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                      @endforeach
                    </select>
                    <span><small class="text-danger kelas-id-error" id="kelas-id-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="dosen" class="form-control-label">Dosen <span style="color: red">*</span></label>
                    <select name="dosen" id="dosen" class="form-control">
                      @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->nik }}">{{ $dosen->gelar_depan.$dosen->nama.$dosen->gelar_belakang }}</option>
                      @endforeach
                    </select>
                    <span><small class="text-danger dosen-error" id="dosen-error"></small></span>
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


                      $('#tambah').on('click',function(e){
                          $('#Modal').modal();
                          $('#modal-label').html('Tambah Data Jadwal');
                          $('#submit-data').html('Simpan');
                          reset_model_value()
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                  type: 'POST',
                                  data: $("#form-data").serialize(),
                                  url: "{{ route('jadwal.store') }}",
                                  success : function(data){
                                    if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Matakuliah berhasil ditambahkan","success").then((val)=>{
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
                          $('#modal-label').html('Edit Data Matakuliah');
                          $('#submit-data').html('Update Matakuliah');
                          reset_model_value()
                         
                          var id                      = $(this).data('id');
                          var kode_jadwal             = $(this).data('kode_jadwal');
                          var kode_matakuliah         = $(this).data('kode_matakuliah');
                          var hari                    = $(this).data('hari_id');
                          var jam_mulai               = $(this).data('jam_mulai');
                          var jam_selesai             = $(this).data('jam_selesai');
                          var kode_ruang              = $(this).data('kode_ruang');
                          var kelas_id                = $(this).data('kelas_id');
                          var dosen                   = $(this).data('dosen');

                        
                          $('#kode_jadwal').val(kode_jadwal);
                          $('#jam_mulai').val(jam_mulai);
                          $('#jam_selesai').val(jam_selesai);
                          $('#kode_matakuliah  option[value="'+kode_matakuliah+'"]').prop("selected", true);
                          $('#kode_ruang  option[value="'+kode_ruang+'"]').prop("selected", true);
                          $('#kelas_id  option[value="'+kelas_id+'"]').prop("selected", true);
                          $('#dosen  option[value="'+dosen+'"]').prop("selected", true);
                                      
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                type: 'PUT',
                                data: $("#form-data").serialize(),
                                url: "{{ url('jadwal/update') }}/"+id,
                                success : function(data){
                                    if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Matakuliah berhasil diupdate","success").then((val)=>{
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
                                    url:"{{ url('jadwal/delete') }}/"+id,
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
                        $( '#kode-jadwal-error' ).html('');
                        $( '#kode-matakuliah-error' ).html('');
                        $( '#dosen-error' ).html('');
                        $( '#jam-mulai-error' ).html('');
                        $( '#jam-selesai-error' ).html('');
                        $( '#kelas-id-error' ).html('');
                        $( '#kode-ruang-error' ).html('');
                        $( '#hari-id-error' ).html('');
                    }

                    function reset_model_value(){
                        $('#kode_jadwal').val('');
                        $('#jam_mulai').val('');
                        $('#jam_selesai').val('');

                      }
                     

                    function error_message(datas){
                       
                        if(datas.kode_matakuliah){
                            $( '#kode-matakuliah-error' ).html( datas.kode_matakuliah[0] );
                        }
                        if(datas.kode_jadwal){
                            $( '#kode-jadwal-error' ).html( datas.kode_jadwal[0] );
                        }
                        if(datas.dosen){
                            $( '#dosen-error' ).html( datas.dosen[0] );
                        }
                        if(datas.jam_mulai){
                            $( '#jam-mulai-error' ).html( datas.jam_mulai[0] );
                        }
                        if(datas.jam_selesai){
                            $( '#jam-selesai-error' ).html( datas.jam_selesai[0] );
                        }
                        if(datas.kelas_id){
                            $( '#kelas-id-error' ).html( datas.kelas_id[0] );
                        }
                        if(datas.kode_ruang){
                            $( '#kode-ruang-error' ).html( datas.kode_ruang[0] );
                        }
                        if(datas.hari_id){
                            $( '#hari-id-error' ).html( datas.hari_id[0] );
                        }
                                    
                     }  
            });


                 
    </script>
@endsection



















