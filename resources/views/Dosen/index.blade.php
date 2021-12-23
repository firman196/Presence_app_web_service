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
                  <th></th>
                  <th>NIP</th>
                  <th>NAMA</th>
                  <th>PRODI</th>
                  <th>EMAIL</th>
                  <th>NO. TELP</th>
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
                  <div class="col-md-4 pl-auto pr-auto">
                    <div class="logoset">
                      <div class="logo">
                        <input type="hidden" name="oldfoto" id="icon-old" value="">
                        <input type="file" name="foto" id="iconUpload" style="display:none;" accept="image/x-png,image/jpeg,image/jpg,image/svg" >
                        <div class="title">Foto<span style="color: red">*</span> </div>
                        <img id="logo" src="{{ url('assets/img/icons/image.png') }}" />
                        <button type="button" class="btn btn-sm btn-secondary btn-block logouploadbtn" onclick="$('#iconUpload').trigger('click')"> Ganti</button>
                        <div class="progress progreslogo" style="display:none;">
                          <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                    <span><small class="text-danger foto-error" id="foto-error"></small></span>
                  </div>
                  <div class="col-md-8 pl-auto pr-auto">
                    <h5>Keterangan :</h5>
                    <div class="mt-2">
                      <p class="mt-0 mb-0"><small>1. Foto wajib di isi</small></p>
                      <p class="mt-0 mb-0"><small>2. Extensi yang disupport hanya jpg,png,jpeg dan svg</small></p>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="nik" class="form-control-label">Nik <span style="color: red">*</span></label>
                    <input id="nik" name="nik" type="text" placeholder="masukkan nik dosen" class="form-control">
                    <span><small class="text-danger nik-error" id="nik-error"></small></span>
                  </div>

                  <div class="col-md-12">
                    <label for="nip" class="form-control-label">Nip <span style="color: red">*</span></label>
                    <input id="nip" name="nip" type="text" placeholder="masukkan nip dosen" class="form-control">
                    <span><small class="text-danger nip-error" id="nip-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="nama" class="form-control-label">Nama <span style="color: red">*</span></label>
                    <input id="nama" name="nama" type="text" placeholder="masukkan nama dosen" class="form-control">
                    <span><small class="text-danger nama-error" id="nama-error"></small></span>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                      <label for="jenjang-pendidikan" class="form-control-label">Jenjang Pendidikan <span style="color: red">*</span></label>
                      <input id="jenjang-pendidikan" name="jenjang_pendidikan" type="text" placeholder="jenjang pendidikan dosen" class="form-control">
                      <span><small class="text-danger jenjang-pendidikan-error" id="jenjang-pendidikan-error"></small></span>
                    </div>
                    <div class="col-md-4">
                        <label for="gelar-depan" class="form-control-label">Gelar Depan </label>
                        <input id="gelar-depan" name="gelar_depan" type="text" placeholder="gelar depan dosen" class="form-control">
                        <span><small class="text-danger gelar-depan-error" id="gelar-depan-error"></small></span>
                    </div>
                    <div class="col-md-4">
                      <label for="gelar-belakang" class="form-control-label">Gelar Belakang </label>
                        <input id="gelar-belakang" name="gelar_belakang" type="text" placeholder="gelar belakang dosen" class="form-control">
                        <span><small class="text-danger gelar-belakang-error" id="gelar-belakang-error"></small></span>
                      </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                      <label for="kode-prodi" class="form-control-label">Prodi <span style="color: red">*</span></label>
                      <select name="kode_prodi" id="kode-prodi" class="form-control">
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                       @endforeach
                      </select>
                      <span><small class="text-danger kode-prodi-error" id="kode-prodi-error"></small></span>
                    </div>
                  </div>
               

                <div class="form-group row">
                    <div class="col-md-4">
                      <label for="telp" class="form-control-label">No Telp <span style="color: red">*</span></label>
                      <input id="telp" name="telp" type="text" placeholder="masukkan nomor telepon" class="form-control">
                      <span><small class="text-danger telp-error" id="telp-error"></small></span>
                    </div>
                    <div class="col-md-4">
                      <label for="email" class="form-control-label">Email <span style="color: red">*</span></label>
                        <input id="email" name="email" type="email" placeholder="masukkan email" class="form-control">
                        <span><small class="text-danger email-error" id="email-error"></small></span>
                    </div>
                    <div class="col-md-4">
                        <label for="password" class="form-control-label">Password <span style="color: red">*</span></label>
                        <input id="password" name="password" type="password" placeholder="masukkan password" class="form-control">
                        <span><small class="text-danger password-error" id="password-error"></small></span>
                    </div>
                </div>
               
                <div class="form-group row">
                   
                    <div class="col-md-6">
                      <label for="status" class="form-control-label">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="0">Aktif</option>
                        <option value="1">Non Aktif</option>
                      </select>
                      <span><small class="text-danger status-error" id="status-error"></small></span>
                    </div>
                </div>
                <div class="text-right">
                    <a href="#"id="submit-data" class="submit-data btn btn-primary ">Simpan</a>
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

                      $('#iconUpload').on('change', function(){ 
                        if (window.File && window.FileReader && window.FileList && window.Blob) 
                        {
                            var data = $(this)[0].files; 
                            var image = data[0];
                            var fRead = new FileReader(); 
                            fRead.onload = (function(image){ 
                              return function(e) {
                                  $('#logo').attr('src', e.target.result); 
                              };
                            })(image);
                            fRead.readAsDataURL(image); 
                            }else{
                              alert("browser anda tidak disupport !!"); 
                            }
                      });

                      $('#tambah').on('click',function(e){
                          $('#Modal').modal();
                          $('#modal-label').html('Tambah Data Dosen');
                          reset_model_value()
                          $('#submit-data').on('click',function(e){
                            reset_error()
                            e.preventDefault();
                            $(this).attr('disabled','disabled');
                            var form = $(this).closest('#form-data');
                                $.ajax({
                                  type: 'POST',
                                  processData: false,
                                  contentType: false,
                                  data: new FormData(form[0]),
                                  url: "{{ route('dosen.store') }}",
                                  enctype: 'multipart/form-data',
                                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                  success : function(data){
                                      if(JSON.parse(data.meta.code) == 200){
                                        $('#Modal').modal('hide');
                                        swal.fire("Selesai","Dosen berhasil ditambahkan","success").then((val)=>{
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
                          $('#modal-label').html('Edit Data Dosen');
                          $('#submit-user').html('Update Dosen');
                          reset_model_value()
                         
                          var nik             = $(this).data('nik');
                          var id              = $(this).data('id');
                          var nip             = $(this).data('nip');
                          var nama            = $(this).data('nama');
                          var kode_prodi      = $(this).data('kode_prodi');
                          var jenjang_pendidikan =  $(this).data('pendidikan');
                          var gelar_depan     =  $(this).data('gelar_depan');
                          var gelar_belakang  =  $(this).data('gelar_belakang');
                          var telp            = $(this).data('telp');
                          var email           = $(this).data('email');
                          var dosen           = $(this).data('dosen');
                          var foto            = $(this).data('foto');
                          var url             = $(this).data('url');
                          var status          = $(this).data('status');

                          if(foto != ''){
                            $('#logo').attr('src', url); 
                          }
                          $('#icon-old').val(foto);
                          $('#nik').val(nik);
                          $('#nip').val(nip);
                          $('#nama').val(nama);
                          $('#jenjang-pendidikan').val(jenjang_pendidikan);
                          $('#gelar-depan').val(gelar_depan);
                          $('#gelar-belakang').val(gelar_belakang);
                          $('#prodi  option[value="'+kode_prodi+'"]').prop("selected", true);
                          $('#telp').val(telp);
                          $('#email').val(email);
                         // $('#password').val(password);
                          $('#dosen  option[value="'+dosen+'"]').prop("selected", true);
                          $('#status  option[value="'+status+'"]').prop("selected", true);

                          $('#submit-data').on('click',function(e){
                            reset_error()
                            e.preventDefault();
                            $(this).attr('disabled','disabled');
                            var form = $(this).closest('#form-data');
                          
                                $.ajax({
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                data: new FormData(form[0]),
                                url: "{{ url('dosen/update') }}/"+id,
                                enctype: 'multipart/form-data',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                success : function(data){
                                  if(JSON.parse(data.meta.code) == 200){
                                    $('#Modal').modal('hide');
                                    swal.fire("Selesai","Dosen berhasil dirubah","success").then((val)=>{
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
                          });
                            

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
                                    url:"{{ url('dosen/delete') }}/"+id,
                                    data:{
                                      "_token": "{{ csrf_token() }}"
                                    },
                                    type:"DELETE",
                                    success : function(data){
                                        if(data.success == true){
                                          fetch_data()
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
                                    url:"{{route('dosen.datatable')}}",
                                    type: "GET"
                                },
                                
                                columns: [
                                    { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'gambar',
                                        "className": "text-center"                                        
                                    },
                                    {
                                        data: 'nip',
                                        "className": "text-center"                                        
                                    },
                                    {
                                        data: 'nama_dosen',
                                        "className": "text-center"      
                                      
                                    },
                                    {
                                        data: 'prodi',
                                        "className": "text-center"      
                                    },
                                    {
                                        data: 'email',
                                        "className": "text-center"      
                                    },
                                    {
                                        data: 'telp',
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
                        $( '#nip-error' ).html('');
                        $( '#nik-error' ).html('');
                        $( '#nama-error' ).html('');
                        $( '#jenjang-pendidikan-error' ).html('');
                        $( '#gelar-depan-error' ).html('');
                        $( '#gelar-belakang-error' ).html('');
                        $( '#kode-prodi-error' ).html('');
                        $( '#telp-error' ).html('');
                        $( '#email-error' ).html('');
                        $( '#password-error' ).html('');
                        $( '#status-error' ).html('');
                        $( '#foto-error' ).html('');
                      }

                    function reset_model_value(){
                        $('#nim').val('');
                        $('#nik').val('');
                        $('#nama').val('');
                        $('#angkatan').val('');
                        $('#agama').val('');
                        $('#jenis_kelamin').val('');
                        $('#telp').val('');
                        $('#email').val('');
                      }
                     

                    function error_message(datas){
                        if(datas.foto){
                            $( '#foto-error' ).html( datas.foto[0] );
                        }
                        if(datas.nik){
                            $( '#nik-error' ).html( datas.nik[0] );
                        }
                        if(datas.nip){
                            $( '#nip-error' ).html( datas.nip[0] );
                        }
                        if(datas.nama){
                            $( '#nama-error' ).html( datas.nama[0] );
                        }
                        if(datas.jenjang_pendidikan){
                            $( '#jenjang-pendidikan-error' ).html( datas.jenjang_pendidikan[0] );
                        }
                        if(datas.gelar_depan){
                            $( '#gelar-depan-error' ).html( datas.gelar_depan[0] );
                        }
                        if(datas.gelar_belakang){
                            $( '#gelar-belakang-error' ).html( datas.gelar_belakang[0] );
                        }
                        if(datas.kode_prodi){
                            $( '#kode-prodi-error' ).html( datas.kode_prodi[0] );
                        }
                        if(datas.telp){
                            $( '#telp-error' ).html( datas.telp[0] );
                        }
                        if(datas.email){
                            $( '#email-error' ).html( datas.email[0] );
                        }
                        if(datas.password){
                            $( '#password-error' ).html( datas.password[0] );
                        }     
                        if(datas.server){
                            toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                        }                  
                     }  
                     });


                 
               </script>
            @endsection



















