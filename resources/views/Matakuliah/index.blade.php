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
                  <th>KODE MATAKULIAH</th>
                  <th>NAMA MATAKULIAH</th>
                  <th>SIFAT MATAKULIAH</th>
                  <th>JENIS MATAKULIAH</th>
                  <th>SKS</th>
                  <th>PRODI</th>
                  <th>SEMESTER</th>
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
              <input type="hidden" name="id" id="id">
              <div class="modal-body">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="kode_matakuliah" class="form-control-label">Kode Matakuliah<span style="color: red">*</span></label>
                    <input id="kode_matakuliah" name="kode_matakuliah" type="text" placeholder="masukkan kode matakuliah" class="form-control">
                    <span><small class="text-danger kode-matakuliah-error" id="kode-matakuliah-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="nama_matakuliah" class="form-control-label">Nama Matakuliah <span style="color: red">*</span></label>
                    <input id="nama_matakuliah" name="nama_matakuliah" type="text" placeholder="masukkan nama matakuliah" class="form-control">
                    <span><small class="text-danger nama-matakuliah-error" id="nama-matakuliah-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="sifat_matakuliah" class="form-control-label">Sifat Matakuliah <span style="color: red">*</span></label>
                    <select name="sifat_matakuliah" id="sifat_matakuliah" class="form-control">
                      <option value="W">Wajib</option>
                      <option value="P">Pilihan</option>
                    </select>
                    <span><small class="text-danger sifat-matakuliah-error" id="sifat-matakuliah-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="jenis_matakuliah" class="form-control-label">Jenis Matakuliah <span style="color: red">*</span></label>
                    <select name="jenis_matakuliah" id="jenis_matakuliah" class="form-control">
                      <option value="T">Teori</option>
                      <option value="P">Praktikum</option>
                    </select>
                    <span><small class="text-danger jenis-matakuliah-error" id="jenis-matakuliah-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="sks" class="form-control-label">SKS <span style="color: red">*</span></label>
                    <input id="sks" name="sks" type="text" placeholder="masukkan sks matakuliah" class="form-control">
                    <span><small class="text-danger sks-error" id="sks-error"></small></span>
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
                    <label for="semester" class="form-control-label">Semester <span style="color: red">*</span></label>
                    <input id="semester" name="semester" type="text" placeholder="masukkan semester" class="form-control">
                    <span><small class="text-danger semester-error" id="semester-error"></small></span>
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


                      $('#tambah').on('click',function(e){
                          $('#Modal').modal();
                          $('#modal-label').html('Tambah Data Matakuliah');
                          $('#submit-data').html('Simpan');
                          reset_model_value()
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                  type: 'POST',
                                  data: $("#form-data").serialize(),
                                  url: "{{ route('matakuliah.store') }}",
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
                          var kode                    = $(this).data('kode');
                          var nama_matakuliah         = $(this).data('nama_matakuliah');
                          var sifat_matakuliah        = $(this).data('sifat_matakuliah');
                          var jenis_matakuliah        = $(this).data('jenis_matakuliah');
                          var sks                     = $(this).data('sks');
                          var kode_prodi              = $(this).data('kode_prodi');
                          var semester                = $(this).data('semester');


                        
                          $('#id').val(id);
                          $('#kode_matakuliah').val(kode);
                          $('#nama_matakuliah').val(nama_matakuliah);
                          $('#sifat_matakuliah  option[value="'+sifat_matakuliah+'"]').prop("selected", true);
                          $('#jenis_matakuliah  option[value="'+jenis_matakuliah+'"]').prop("selected", true);
                          $('#sks').val(sks);
                          $('#kode_prodi  option[value="'+kode_prodi+'"]').prop("selected", true);
                          $('#semester').val(semester);
                        
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                type: 'PUT',
                                data: $("#form-data").serialize(),
                                url: "{{ url('matakuliah/update') }}/"+id,
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
                                    url:"{{ url('matakuliah/delete') }}/"+id,
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
                                    url:"{{route('matakuliah.datatable')}}",
                                    type: "GET"
                                },
                                
                                columns: [
                                    { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'kode_matakuliah',
                                        "className": "text-center"                                        
                                    },     
                                    {
                                        data: 'nama_matakuliah',
                                        "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'sifat_matakuliah',
                                        "className": "text-center"                                        
                                    },  
                                    {
                                        data: 'jenis_matakuliah',
                                        "className": "text-center"                                        
                                    },  
                                    {
                                        data: 'sks',
                                        "className": "text-center"                                        
                                    },   
                                    {
                                        data: 'prodi',
                                        "className": "text-center"                                        
                                    }, 
                                    {
                                        data: 'semester',
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
                        $( '#kode-matakuliah-error' ).html('');
                        $( '#nama-matakuliah-error' ).html('');
                        $( '#sifat-matakuliah-error' ).html('');
                        $( '#jenis-matakuliah-error' ).html('');
                        $( '#sks-error' ).html('');
                        $( '#kode-prodi-error' ).html('');
                        $( '#semester-error' ).html('');
                    }

                    function reset_model_value(){
                        $('#kode_matakuliah').val('');
                        $('#nama_matakuliah').val('');
                        $('#sks').val('');
                        $('#semester').val('');

                      }
                     

                    function error_message(datas){
                       
                        if(datas.kode_matakuliah){
                            $( '#kode-matakuliah-error' ).html( datas.kode_matakuliah[0] );
                        }
                        if(datas.nama_matakuliah){
                            $( '#nama-matakuliah-error' ).html( datas.nama_matakuliah[0] );
                        }
                        if(datas.sifat_matakuliah){
                            $( '#sifat-matakuliah-error' ).html( datas.sifat_matakuliah[0] );
                        }
                        if(datas.jenis_matakuliah){
                            $( '#jenis-matakuliah-error' ).html( datas.jenis_matakuliah[0] );
                        }
                        if(datas.sks){
                            $( '#sks-error' ).html( datas.sks[0] );
                        }
                        if(datas.kode_prodi){
                            $( '#kode-prodi-error' ).html( datas.kode_prodi[0] );
                        }
                        if(datas.semester){
                            $( '#semester-error' ).html( datas.semester[0] );
                        }
                                    
                     }  
            });


                 
    </script>
@endsection



















