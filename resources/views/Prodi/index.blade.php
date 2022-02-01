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
                  <th>KODE PRODI</th>
                  <th>NAMA PRODI</th>
                  <th>JENJANG</th>
                  <th>KAPRODI</th>
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
                    <label for="kode_prodi" class="form-control-label">Kode Prodi <span style="color: red">*</span></label>
                    <input id="kode-prodi" name="kode_prodi" type="text" placeholder="masukkan kode prodi" class="form-control">
                    <span><small class="text-danger kode-prodi-error" id="kode-prodi-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="nama_prodi" class="form-control-label">Nama Prodi <span style="color: red">*</span></label>
                    <input id="nama-prodi" name="nama_prodi" type="text" placeholder="masukkan nama prodi" class="form-control">
                    <span><small class="text-danger nama-prodi-error" id="nama-prodi-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="jenjang" class="form-control-label">Jenjang <span style="color: red">*</span></label>
                    <select name="jenjang" id="jenjang" class="form-control">
                      <option value="D3">D3</option>
                      <option value="S1">S1</option>
                    </select>
                    <span><small class="text-danger jenjang-error" id="jenjang-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="kaprodi" class="form-control-label">Kepala Prodi</label>
                    <select name="kaprodi" id="kaprodi" class="form-control">
                      @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->nik }}">{{ $dosen->nama }}</option>
                      @endforeach
                    </select>
                    <span><small class="text-danger kaprodi-error" id="kaprodi-error"></small></span>
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

                      //event ketika tambah data prodi
                      $('#tambah').on('click',function(e){
                          $('#Modal').modal();
                          $('#modal-label').html('Tambah Data Prodi');
                          $('#submit-data').html('Simpan');
                          reset_model_value()
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                  type: 'POST',
                                  data: $("#form-data").serialize(),
                                  url: "{{ route('prodi.store') }}",
                                  success : function(data){
                                    if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Prodi berhasil ditambahkan","success").then((val)=>{
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

                      //event ketika edit data prodi
                      $('#dataTable tbody').on('click', '.edit', function () {
                          $('#Modal').modal();
                          $('#modal-label').html('Edit Data Prodi');
                          $('#submit-data').html('Update Prodi');
                          reset_model_value()
                         
                          var id                = $(this).data('id');
                          var nama_prodi        = $(this).data('nama_prodi');
                          var jenjang           = $(this).data('jenjang');
                          var kaprodi           = $(this).data('kaprodi');
                        
                          $('#kode-prodi').val(id);
                          $('#nama-prodi').val(nama_prodi);
                          $('#jenjang  option[value="'+jenjang+'"]').prop("selected", true);
                          $('#kaprodi  option[value="'+kaprodi+'"]').prop("selected", true);
                        
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                type: 'PUT',
                                data: $("#form-data").serialize(),
                                url: "{{ url('prodi/update') }}/"+id,
                                success : function(data){
                                  if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Prodi berhasil diupdate","success").then((val)=>{
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
                          swal.fire({
                            text: "Data yang sudah dihapus tidak dapat dikembalikan lagi !",
                            title: "Anda yakin ingin menghapus data ini ?",
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonColor: "#D4112E",
                            cancelButtonText: "Batal"
                          }).then((result)=>{
                            if (result.value == true) {
                              $.ajax({
                                    url:"{{ url('prodi/delete') }}/"+id,
                                    data:{
                                      "_token": "{{ csrf_token() }}"
                                    },
                                    type:"DELETE",
                                    success : function(data){
                                      if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Prodi berhasil dihapus","success").then((val)=>{
                                          location.reload();
                                        });
                                      }
                                    },
                                    error:function(XMLHttpRequest){
                                      toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                                    }
                                });
                            } else {
                                Swal.fire('Changes are not saved', '', 'info').then((val)=>{
                                    location.reload();
                                });
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
                                    url:"{{route('prodi.datatable')}}",
                                    type: "GET"
                                },
                                
                                columns: [
                                    { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'kode_prodi',
                                        "className": "text-center"                                        
                                    },     
                                    {
                                        data: 'nama_prodi',
                                        "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'jenjang',
                                        "className": "text-center"                                        
                                    },  
                                    {
                                        data: 'kaprodi',
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
                        $( '#kode-prodi-error' ).html('');
                        $( '#nama-prodi-error' ).html('');
                        $( '#jenjang-error' ).html('');
                        $( '#kaprodi-error' ).html('');
                    }

                    function reset_model_value(){
                        $('#kode-prodi').val('');
                        $('#nama-prodi').val('');
                        

                      }
                     

                    function error_message(datas){
                       
                        if(datas.kode_prodi){
                            $( '#kode-prodi-error' ).html( datas.kode_prodi[0] );
                        }
                        if(datas.nama_prodi){
                            $( '#nama-prodi-error' ).html( datas.nama_prodi[0] );
                        }

                        if(datas.jenjang){
                            $( '#jenjang-error' ).html( datas.jenjang[0] );
                        }

                        if(datas.kaprodi){
                            $( '#kaprodi-error' ).html( datas.kaprodi[0] );
                        }
                        
                                    
                     }  
            });


                 
    </script>
@endsection



















