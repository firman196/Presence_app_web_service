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
                  <th>KODE JENIS IZIN</th>
                  <th>KETERANGAN</th>
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
              <input type="hidden" value="" name="id" id="id"/>
              <div class="modal-body">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="kode" class="form-control-label">Kode Jenis Izin <span style="color: red">*</span></label>
                    <input id="kode-jenis-izin" name="kode" type="text" placeholder="masukkan jenis izin" class="form-control">
                    <span><small class="text-danger kode-jenis-izin-error" id="kode-jenis-izin-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="keterangan" class="form-control-label">Keterangan <span style="color: red">*</span></label>
                    <input id="keterangan" name="keterangan" type="text" placeholder="masukkan keterangan" class="form-control">
                    <span><small class="text-danger keteranagn-error" id="keterangan-error"></small></span>
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


                      //event tambah dosen
                      $('#tambah').on('click',function(e){
                          $('#Modal').modal();
                          $('#modal-label').html('Tambah Data Jenis Izin');
                          $('#submit-data').html('Simpan');
                          reset_model_value()
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                  type: 'POST',
                                  data: $("#form-data").serialize(),
                                  url: "{{ route('jenis-izin.store') }}",
                                  success : function(data){
                                    if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Jenis Izin berhasil ditambahkan","success").then((val)=>{
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

                      //event edit dosen
                      $('#dataTable tbody').on('click', '.edit', function () {
                          $('#Modal').modal();
                          $('#modal-label').html('Edit Data Jenis Izin');
                          $('#submit-data').html('Update Jenis Izin');
                          reset_model_value()
                         
                          var id                = $(this).data('id');
                          var kode              = $(this).data('kode');
                          var keterangan        = $(this).data('keterangan');
                        
                          $('#keterangan').val(keterangan);
                          $('#kode-jenis-izin').val(kode);
                          $('#id').val(id);
                        
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            $.ajax({
                                type: 'PUT',
                                data: $("#form-data").serialize(),
                                url: "{{ url('jenis-izin') }}/"+id,
                                success : function(data){
                                  console.log(data)
                                  if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Jenis Izin berhasil dirubah","success").then((val)=>{
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

                      //event hapus dosen
                      $('#dataTable tbody').on('click', '.hapus', function () {
                          var id          = $(this).data('id');
                         
                          $.ajax({
                              url:"{{ url('jenis-izin') }}/"+id,
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
                                    url:"{{route('data.jenis-izin')}}",
                                    type: "GET"
                                },
                                
                                columns: [
                                    { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'kode',
                                        "className": "text-center"                                        
                                    }, 
                                    {
                                        data: 'keterangan',
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
                        $( '#kode-jenis-izin-error' ).html('');
                        $( '#keterangan-error' ).html('');
                    }

                    function reset_model_value(){
                        $('#kode-jenis-izin').val('');
                        $('#keterangan').val('');
                       
                      }
                     

                    function error_message(datas){
                        if(datas.kode){
                            $( '#kode-jenis-izin-error' ).html( datas.kode[0] );
                        }

                        if(datas.keterangan){
                            $( '#keterangan-error' ).html( datas.keterangan[0] );
                        }

                        if(datas.server){
                            toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                        }   
                                    
                     }  
            });


                 
    </script>
@endsection



















