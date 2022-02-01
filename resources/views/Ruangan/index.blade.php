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
                  <th>KODE RUANGAN</th>
                  <th>NAMA RUANGAN</th>
                  <th>KAPASITAS RUANG KULIAH</th>
                  <th>KAPASITAS RUANG UJIAN</th>
                  <th>PRODI</th>
                  <th>GEDUNG</th>
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
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="kode_ruang" class="form-control-label">Kode Ruang <span style="color: red">*</span></label>
                    <input id="kode_ruang" name="kode_ruang" type="text" placeholder="masukkan kode ruang" class="form-control">
                    <span><small class="text-danger kode-ruang-error" id="kode-ruang-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="nama_ruang" class="form-control-label">Nama Ruang <span style="color: red">*</span></label>
                    <input id="nama_ruang" name="nama_ruang" type="text" placeholder="masukkan nama ruang" class="form-control">
                    <span><small class="text-danger nama-ruang-error" id="nama-ruang-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="kapasitas_ruang_kuliah" class="form-control-label">Kapasitas ruang kuliah <span style="color: red">*</span></label>
                    <input id="kapasitas_ruang_kuliah" name="kapasitas_ruang_kuliah" type="number" placeholder="masukkan kapasitas ruang kuliah" class="form-control">
                    <span><small class="text-danger kapasitas-ruang-kuliah-error" id="kapasitas-ruang-kuliah-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="kapasitas_ruang_ujian" class="form-control-label">Kapasitas ruang ujian <span style="color: red">*</span></label>
                    <input id="kapasitas_ruang_ujian" name="kapasitas_ruang_ujian" type="number" placeholder="masukkan kapasitas ruang kuliah" class="form-control">
                    <span><small class="text-danger kapasitas-ruang-ujian-error" id="kapasitas-ruang-ujian-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="kode_prodi" class="form-control-label">Prodi <span style="color: red">*</span></label>
                    <select name="kode_prodi" id="kode_prodi" class="form-control">
                      @foreach($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                      @endforeach
                    </select>
                    <span><small class="text-danger kode-prodi-error" id="kode-prodi-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="nama_gedung" class="form-control-label">Nama Gedung <span style="color: red">*</span></label>
                    <input id="nama_gedung" name="nama_gedung" type="text" placeholder="masukkan nama gedung" class="form-control">
                    <span><small class="text-danger nama-gedung-error" id="nama-gedung-error"></small></span>
                  </div>
                </div>
               
                <div class="text-center">
                    <a href="#"id="submit-data" class="submit-data btn btn-primary w-100">Simpan</a>
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

                      //tambah data ruangan
                      $('#tambah').on('click',function(e){
                          $('#Modal').modal();
                          $('#modal-label').html('Tambah Data Ruangan');
                          $('#submit-data').html('Simpan');
                          reset_model_value()
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                  type: 'POST',
                                  data: $("#form-data").serialize(),
                                  url: "{{ route('ruangan.store') }}",
                                  success : function(data){
                                    if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                            swal.fire("Selesai","Ruangan berhasil ditambahkan","success").then((val)=>{
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
                            })
                        })                               
                      });


                      //edit data ruangan
                      $('#dataTable tbody').on('click', '.edit', function () {
                          $('#Modal').modal();
                          $('#modal-label').html('Edit Data Ruangan');
                          $('#submit-data').html('Update Ruangan');
                          reset_model_value()
                         
                          var id                      = $(this).data('id');
                          var kode_ruang              = $(this).data('kode');
                          var nama_ruang              = $(this).data('nama_ruang');
                          var kapasitas_ruang_kuliah  = $(this).data('kapasitas_ruang_kuliah');
                          var kapasitas_ruang_ujian   = $(this).data('kapasitas_ruang_ujian');
                          var kode_prodi              = $(this).data('kode_prodi');
                          var nama_gedung             = $(this).data('nama_gedung');


                        
                          $('#kode_ruang').val(kode_ruang);
                          $('#nama_ruang').val(nama_ruang);
                          $('#kapasitas_ruang_kuliah').val(kapasitas_ruang_kuliah);
                          $('#kapasitas_ruang_ujian').val(kapasitas_ruang_ujian);
                          $('#kode_prodi  option[value="'+kode_prodi+'"]').prop("selected", true);
                          $('#nama_gedung').val(nama_gedung);
                        
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                type: 'PUT',
                                data: $("#form-data").serialize(),
                                url: "{{ url('ruangan/update') }}/"+id,
                                success : function(data){
                                    if(JSON.parse(data.meta.code) == 200){
                                           $('#Modal').modal('hide');
                                            swal.fire("Selesai","Ruangan berhasil diupdate","success").then((val)=>{
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
                              })
                          })
                      })      

                      $('#dataTable tbody').on('click', '.hapus', function () {
                          var id          = $(this).data('id');
                         
                          $.ajax({
                            url:"{{ url('ruangan/delete') }}/"+id,
                                    data:{
                                      "_token": "{{ csrf_token() }}"
                                    },
                                    type:"DELETE",
                                    success : function(data){
                                      if(JSON.parse(data.meta.code) == 200){
                                           $('#Modal').modal('hide');
                                            swal.fire("Selesai","Ruangan berhasil dihapus","success").then((val)=>{
                                              location.reload();
                                            });
                                        }
                                    },
                                    error: function(xhr, status, err) {
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
                                        data: 'kode_ruang',
                                        "className": "text-center"                                        
                                    },     
                                    {
                                        data: 'nama_ruang',
                                        "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'kapasitas_ruang_kuliah',
                                        "className": "text-center"                                        
                                    },  
                                    {
                                        data: 'kapasitas_ruang_ujian',
                                        "className": "text-center"                                        
                                    },  
                                    {
                                        data: 'prodi',
                                        "className": "text-center"                                        
                                    },   
                                    {
                                        data: 'nama_gedung',
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
                        $( '#kode-ruang-error' ).html('');
                        $( '#nama-ruang-error' ).html('');
                        $( '#kapasitas-ruang-kuliah-error' ).html('');
                        $( '#kapasitas-ruang-ujian-error' ).html('');
                        $( '#kode-prodi-error' ).html('');
                        $( '#nama-gedung-error' ).html('');
                    }

                    function reset_model_value(){
                        $('#kode_ruang').val('');
                        $('#nama_ruang').val('');
                        $('#kapasitas_ruang_kuliah').val(0);
                        $('#kapasitas_ruang_ujian').val(0);
                        $('#nama_gedung').val('');

                      }
                     

                    function error_message(datas){
                       
                        if(datas.nama_kelas){
                            $( '#nama-kelas-error' ).html( datas.nama_kelas[0] );
                        }
                                    
                     }  
            });


                 
    </script>
@endsection



















