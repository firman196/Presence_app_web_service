@extends('Master.master-dashboard')
@section('page-content')

 <!-- Header -->
  <div class="header bg-primary">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item">{{ $breadcrumb }}</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
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
          <div class="card-header border-0 mb--5">
            <div class="nav tabs p-lr-15 col-md-10">
              <a data-toggle="tab" href="#profil" class="tabs-item active" role="tab" aria-controls="profil" aria-selected="true">
                <i class="fas fa-user"></i> Profil
              </a>
                   
            </div>
            <hr>
          </div>
          <!-- Light table -->
          <div class="card-body ">
            @if( Session::get('status') == 'success')
              <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
            @elseif(Session::get('status')== 'error')
              <div class="alert alert-danger" role="alert">{{Session::get('message')}}</div>
            @endif
            <div class="tab-content">
              <div id="profil" class="tab-pane active">
                @if(Auth::guard('toko')->check())
                  <form id="form-data" action="profil/update/{{ \Crypt::encrypt($profil->nik) }}" method="POST" enctype="multipart/form-data">
                @else
                  <form id="form-data" action="update/{{ \Crypt::encrypt($profil->nik) }}" method="POST" enctype="multipart/form-data">
                @endif
                    @method('PUT')
                    @csrf

                    <div class="form-group row">
                      <div class="col-md-2 d-flex align-items-center ">
                        <label for="telp_pemilik" class="form-control-label">Foto Profil</label>
                      </div>
                      <div class="col-md-4 pl-auto pr-auto">
                        <div class="logoset">
                          <div class="logo">
                            <input type="hidden" name="foto_old" id="foto-old" value="{{ $profil->foto }}">
                            <input type="file" name="foto" id="iconUpload" style="display:none;" accept="image/x-png,image/jpeg,image/jpg,image/svg" >
                            <div class="title">Upload Foto</div>
                            @if(isset($profil->foto))
                              <img id="logo" src="{{ config('services.storage.baseUrl').$profil->foto }}" />
                            @else
                              <img id="logo" src="{{ url('assets/img/icons/add-product.png') }}" />
                            @endif
                            <button type="button" class="btn btn-sm btn-secondary btn-block logouploadbtn" onclick="$('#iconUpload').trigger('click')"> Ganti</button>
                            <div class="progress progreslogo" style="display:none;">
                              <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                        <span><small class="text-danger icon-error" id="icon-error"></small></span>
                      </div>
                      <div class="col-md-6 pl-auto pr-auto">
                        <h5>Keterangan :</h5>
                        <div class="mt-2">
                          <p class="mt-0 mb-0"><small>1. Foto profil tidak wajib di isi</small></p>
                          <p class="mt-0 mb-0"><small>2. Extensi yang disupport hanya jpg,png,jpeg dan svg</small></p>
                        </div>
                      </div>
                    </div>
                   
                    <div class="form-group row">
                      <div class="col-md-2 d-flex align-items-center ">
                        <label for="nama_produk" class="form-control-label">Nama Penjual <span style="color: red">*</span></label>
                      </div>
                      <div class="col-md-10">
                        <input id="nama_penjual" type="text" class="form-control" name="nama_penjual" value="{{ $profil->nama_penjual }}">
                        @if ($errors->has('nama_penjual'))
                          <span class="help-block text-red">
                            <strong><small>{{ $errors->first('nama_penjual') }}</small></strong>
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 d-flex align-items-center ">
                          <label for="notelp_penjual" class="form-control-label">No Telp Penjual <span style="color: red">*</span></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">+62</span>
                                </div>
                                <input id="notelp_penjual" type="number" class="form-control" name="notelp_penjual" value="{{ substr($profil->notelp_penjual,2) }}">
                            </div>
                          @if ($errors->has('notelp_penjual'))
                            <span class="help-block text-red">
                              <strong><small>{{ $errors->first('notelp_penjual') }}</small></strong>
                            </span>
                          @endif
                        </div>
                        <div class="col-md-2 d-flex align-items-center ">
                            <label for="email" class="form-control-label">Email Penjual <span style="color: red">*</span></label>
                          </div>
                        <div class="col-md-4">
                            <input id="email" type="text" class="form-control" name="email" value="{{ $profil->email }}">
                            @if ($errors->has('email'))
                              <span class="help-block text-red">
                                <strong><small>{{ $errors->first('email') }}</small></strong>
                              </span>
                            @endif
                        </div>
                      </div>
                    <div class="form-group row">
                      <div class="col-md-2 d-flex align-items-center ">
                        <label for="alamat_penjual" class="form-control-label">Alamat <span style="color: red">*</span></label>
                      </div>
                      <div class="col-md-10">
                        <textarea id="alamat_penjual" cols="2" rows="4" class="form-control" name="alamat_penjual" >{{ $profil->alamat_penjual }}</textarea>
                        @if ($errors->has('alamat_penjual'))
                          <span class="help-block text-red">
                            <strong><small>{{ $errors->first('alamat_penjual') }}</small></strong>
                          </span>
                        @endif
                      </div>
                    </div>
                    

                    <div class="ml-4 float-right mt-4">
                      <button id="submit" type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </form>
              </div>
              
            </div>
          </div>
          <!-- Card footer -->
        </div>
      </div>
    </div>
    <!-- Modal -->
 
    @endsection
    @section('page-script')
    <script>
          $(document).ready(function(){
            $('.pop-up').html('');
            toastr.options = {
              "debug": false,
              "positionClass": "toast-bottom-full-width",
              "onclick": null,
              "fadeIn": 300,
              "fadeOut": 1000,
              "timeOut": 5000,
              "extendedTimeOut": 1000
            }
            var id = $('#toko-id').val();
          //  showRekening(id);
           
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
          
                       //get data provinsi
                       $('#kabupaten_id').prop("disabled","disabled");
                       $('#kecamatan_id').prop("disabled","disabled");
                        $.ajax({
                          url:"{{ route('provinsi') }}",
                                    type:"GET",
                                    success : function(data){
                                      if(JSON.parse(data) != null){
                                          $.each(JSON.parse(data), function(key, dt){
                                                var option = '<option value="'+dt.id+'">'+dt.name+' </option>';
                                                $('#provinsi_id').append(option)
                                                
                                          })
                                      }
                                    },
                                    error:function(XMLHttpRequest){
                                      toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                                    }
                                });  
                      $('#provinsi_id').change(function() {
                            $('#kabupaten_id').prop("disabled",false);
                            $('#kabupaten_id').empty();
                            $('#kecamatan_id').empty()
                            $('#kecamatan_id').append('<option value="">Pilih Kecamatan</option>');
                            $('#kabupaten_id').append('<option value="">Pilih Kabupaten</option>');
                  
                            var province     = $("#provinsi_id option:selected").attr("value");
                           
                            $.ajax({
                            url:"{{ url('kabupaten') }}/"+province,
                                      type:"GET",
                                      success : function(data){
                                        if(JSON.parse(data) != null){
                                            $.each(JSON.parse(data), function(key, dt){
                                              
                                                  var option = '<option value="'+dt.id+'">'+dt.name+'</option>';
                                                  $('#kabupaten_id').append(option)
                                            })
                                        }
                                      },
                                      error:function(XMLHttpRequest){
                                        toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                                      }
                            });  
                        });
                        $('#kabupaten_id').change(function() {
                            $('#kecamatan_id').prop("disabled",false);
                            $('#kecamatan_id').empty()
                            $('#kecamatan_id').append('<option value="">Pilih Kecamatan</option>');
                            var city     = $("#kabupaten_id option:selected").attr("value");
                            
                            $.ajax({
                              url:"{{ url('kecamatan') }}/"+city,
                              type:"GET",
                              success : function(data){
                                if(JSON.parse(data) != null){
                                    $.each(JSON.parse(data), function(key, dt){
                                        var option = '<option value="'+dt.id+'">'+dt.name+'</option>';
                                        $('#kecamatan_id').append(option)
                                    })
                                }
                              },
                              error:function(XMLHttpRequest){
                                toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                              }
                            });  
                       });
           
           /* $('#tambah-pembayaran').on('click',function(){
                  $('#Modal').modal();
                  $('#submit-rekening').one('click',function(){
                  $.ajax({
                        url:"{{ route('rekening.toko') }}",
                        data:$("#form-kategori").serialize(),
                        type:"POST",
                        success : function(data){
                          console.log(data)
                        //validasi modal
                          if(data.errors) {
                            if(data.errors.rekening_bank_id){
                                $( '.id-bank-error' ).html( data.errors.rekening_bank_id[0] );
                            }
                            if(data.errors.atas_nama){
                                $( '.atas-nama-error' ).html( data.errors.atas_nama[0] );
                            }
                            if(data.errors.nomor_rekening){
                                $( '.nomor-rekening-error' ).html( data.errors.nomor_rekening[0] );
                            }
                          }
                          if(data.success== true){
                            var id = $('#toko-id').val();
                            $('#Modal').modal('hide');
                            swal.fire("Selesai","Rekening toko berhasil disimpan","success").then((val)=>{
                                    var id = $('#toko-id').val();
                                    showRekening(id);
                                   
                              });
                          }
                        },
                        error:function(XMLHttpRequest){
                            toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                        }
                    });
                  });
               });
               $("#rekening-data").on("click", ".edit", function(){
               
                    $('#Modal').modal();
                    $('#modal-label').html('Edit Rekening');
                    $('#submit-user').html('Simpan');
                  
                    var id              = $(this).data('id');
                    var rekening_id     = $(this).data('rekening');
                    var atas_nama       = $(this).data('nama');
                    var nomor_rekening  = $(this).data('nomorrekening');
                   
                    $("#id-bank option[value='"+rekening_id+"']").attr('selected','selected');
                    $('#atas-nama').val(atas_nama);
                    $('#nomor-rekening').val(nomor_rekening);
                    $('.submit-rekening').on('click',function(e){
                       
                        $.ajax({
                          url:"{{ url('rekening/update') }}/"+id,
                          data:$("#form-kategori").serialize(),
                          type:"PUT",
                          success : function(data){
                          //validasi modal
                            if(data.errors) {
                              if(data.errors.rekening_bank_id){
                                  $( '.id-bank-error' ).html( data.errors.rekening_bank_id[0] );
                              }
                              if(data.errors.atas_nama){
                                  $( '.atas-nama-error' ).html( data.errors.atas_nama[0] );
                              }
                              if(data.errors.nomor_rekening){
                                  $( '.nomor-rekening-error' ).html( data.errors.nomor_rekening[0] );
                              }
                            }
                            if(data.success== true){    
                              $('#Modal').modal('hide');                          
                              swal.fire("Selesai","Rekening toko berhasil diupdate","success").then((val)=>{
                                    var id = $('#toko-id').val();
                                    showRekening(id);
                                   
                              });
                            }
                          },
                          error:function(XMLHttpRequest){
                              toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                          }
                      });                     
                    })
                 });
                  $('#rekening-data').on('click','.hapus', function () {
                      var id          = $(this).data('id');
                      $.ajax({
                        url:"{{ url('rekening/delete') }}/"+id,
                        data:{
                            "_token": "{{ csrf_token() }}"
                        },
                        type:"DELETE",
                        success : function(data){
                        if(data.success){
                              swal.fire("Selesai","Rekening Toko berhasil dihapus","success").then((val)=>{
                                    var id_toko = $('#toko-id').val();
                                    showRekening(id_toko);
                                    $('#Modal').modal('hide');
                                  });
                                }
                              },
                              error:function(XMLHttpRequest){
                                toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                              }
                        });
                  });
               function showRekening(id){
                  $.ajax({
                        url:"{{ url('rekening') }}/"+id,
                        type:"GET",
                        success : function(data){
                           //validasi modal
                          if(data.errors == false) {
                            toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                          }
                          if(data.success == true){
                              $('#rekening-data').html(data.html)
                          }
                        },
                        error:function(XMLHttpRequest){
                            toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                        }
                    });
               }
*/
              if($("#kabupaten_id option:selected").attr("value") != null){
                $('#kabupaten_id').prop("disabled",false);
              }
              if($("#kecamatan_id option:selected").attr("value") != null){
                $('#kecamatan_id').prop("disabled",false);
              }
            
              
        });                 
   </script>
@endsection
